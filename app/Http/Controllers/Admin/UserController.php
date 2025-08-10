<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'blood_group' => 'required|string|max:10',
            'session' => 'required|string|max:255',
            'batch_year' => 'required|integer|min:1990|max:2025',
            'contact_number' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'facebook_profile' => 'nullable|url|max:255',
            'whatsapp_number' => 'nullable|string|max:255',
            'present_address' => 'required|string|max:500',
            'permanent_address' => 'required|string|max:500',
            'country_of_residence' => 'required|string|max:255',
            'city_of_residence' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'organization_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'work_location' => 'nullable|string|max:255',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'spouse_name' => 'nullable|string|max:255',
            'number_of_children' => 'required|integer|min:0|max:10',
            'children_names_ages' => 'nullable|string|max:1000',
            'favorite_memory' => 'nullable|string|max:1000',
            'accompanying_guests' => 'required|integer|min:0|max:10',
            'tshirt_size' => 'nullable|string|max:10',
            'willing_to_volunteer' => 'required|boolean',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Delete old photo if exists
            if ($user->photo_path && file_exists(storage_path('app/public/' . $user->photo_path))) {
                unlink(storage_path('app/public/' . $user->photo_path));
            }

            $photoPath = $request->file('photo')->store('profile-photos', 'public');
            $validated['photo_path'] = $photoPath;
        }

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        try {
            // Delete user's photo if exists
            if ($user->photo_path && file_exists(storage_path('app/public/' . $user->photo_path))) {
                unlink(storage_path('app/public/' . $user->photo_path));
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
