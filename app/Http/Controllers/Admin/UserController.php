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
                  ->orWhere('whatsapp_number', 'like', "%{$search}%");
            });
        }

        // Batch year filter
        if ($request->filled('batch_year')) {
            $query->where('batch_year', $request->batch_year);
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

        // Get paginated results
        $users = $query->with('orders')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users', compact('users'));
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
