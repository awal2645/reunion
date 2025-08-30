<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of users with search and filters
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhere('whatsapp_number', 'like', "%{$search}%")
                  ->orWhere('present_district', 'like', "%{$search}%")
                  ->orWhere('permanent_district', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%");
            });
        }

        // Batch year filter


        // Session filter
        if ($request->filled('session')) {
            $query->where('session', $request->session);
        }

        // District filter
        if ($request->filled('district')) {
            $query->where(function($q) use ($request) {
                $q->where('present_district', $request->district)
                  ->orWhere('permanent_district', $request->district);
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'paid') {
                $query->whereHas('orders', function($q) {
                    $q->where('status', 'paid');
                });
            } elseif ($request->status === 'pending') {
                $query->whereHas('orders', function($q) {
                    $q->whereIn('status', ['pending', 'paid']);
                });
            } elseif ($request->status === 'unpaid') {
                $query->whereDoesntHave('orders', function($q) {
                    $q->whereIn('status', ['paid', 'pending']);
                });
            }
        }

        // Get paginated results with eager loading
        $users = $query->with(['orders' => function($q) {
            $q->latest();
        }])->orderBy('created_at', 'desc')->paginate(15);

        // Get unique districts for filter dropdown
        $districts = User::where('role', 'user')
            ->whereNotNull('present_district')
            ->orWhereNotNull('permanent_district')
            ->pluck('present_district')
            ->merge(User::where('role', 'user')->pluck('permanent_district'))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.users', compact('users', 'districts'));
    }

    /**
     * Get user statistics for admin dashboard
     */
    public function getStats()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'users_this_month' => User::where('role', 'user')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'users_by_district' => User::where('role', 'user')
                ->whereNotNull('present_district')
                ->selectRaw('present_district, COUNT(*) as count')
                ->groupBy('present_district')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get(),
            'users_by_session' => User::where('role', 'user')
                ->whereNotNull('session')
                ->selectRaw('session, COUNT(*) as count')
                ->groupBy('session')
                ->orderBy('session', 'desc')
                ->limit(10)
                ->get(),

        ];

        return response()->json($stats);
    }

    /**
     * Show user details in modal
     */
    public function show(User $user)
    {
        $user->load('orders');
        
        $html = view('admin.partials.user-details', compact('user'))->render();
        
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->all();

        // Handle password update if provided
        if ($request->filled('password') && $request->filled('password_confirmation')) {
            // Check if current password is provided and correct
            if ($request->filled('current_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'Current password is incorrect');
                }
            }
            
            if ($request->password === $request->password_confirmation) {
                $validated['password'] = Hash::make($request->password);
                // Log for debugging
                Log::info('Password updated for user: ' . $user->id);
            } else {
                return redirect()->back()->with('error', 'Password and Confirm Password do not match');
            }
        } else {
            // If password fields are empty, remove them from validation
            unset($validated['password']);
        }

        // Remove password confirmation and current password from data
        unset($validated['password_confirmation']);
        unset($validated['current_password']);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
                Storage::disk('public')->delete($user->photo_path);
            }

            // Store new photo
            $photoPath = $request->file('photo')->store('profile-photos', 'public');
            $validated['photo_path'] = $photoPath;
            
            Log::info('Photo updated for user: ' . $user->id);
        }

        // Handle address fields - if structured address is provided, clear old address fields
        if ($request->filled('present_vill') || $request->filled('present_post_office') || 
            $request->filled('present_thana') || $request->filled('present_district')) {
            $validated['present_address'] = null; // Clear old address field
        }
        
        if ($request->filled('permanent_vill') || $request->filled('permanent_post_office') || 
            $request->filled('permanent_thana') || $request->filled('permanent_district')) {
            $validated['permanent_address'] = null; // Clear old address field
        }

        // Handle checkbox fields
        $validated['willing_to_volunteer'] = $request->has('willing_to_volunteer');

        // Clean up empty fields
        $validated = array_filter($validated, function($value) {
            return $value !== null && $value !== '';
        });

        $user->update($validated);

        return redirect()->back()
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        try {
            // Delete user's photo if exists
            if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
                Storage::disk('public')->delete($user->photo_path);
            }

            // Delete user's orders
            $user->orders()->delete();

            // Delete the user
            $user->delete();

            return redirect()->route('admin.users')
                ->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')
                ->with('error', 'Error deleting user. Please try again.');
        }
    }
}
