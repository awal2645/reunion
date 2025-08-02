<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'blood_group' => ['nullable', 'string', 'max:10'],
            'session' => ['required', 'string', 'max:255'],
            'batch_year' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255','unique:users,contact_number'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'facebook_profile' => ['nullable', 'string', 'url', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:255'],
            'present_address' => ['required', 'string'],
            'permanent_address' => ['required', 'string'],
            'country_of_residence' => ['required', 'string', 'max:255'],
            'city_of_residence' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'work_location' => ['nullable', 'string', 'max:255'],
            'photo' => ['required', 'image', 'max:2048'], // Max 2MB
            'favorite_memory' => ['nullable', 'string'],
            'accompanying_guests' => ['nullable', 'integer', 'min:0'],
            'tshirt_size' => ['required', 'string', 'in:XS,S,M,L,XL,XXL,XXXL'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile-photos', 'public');
        }

        // Ensure number_of_children is never null
        $numberOfChildren = $request->number_of_children;
        if ($numberOfChildren === null || $numberOfChildren === '') {
            $numberOfChildren = 0;
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'blood_group' => $request->blood_group,
            'session' => $request->session,
            'batch_year' => $request->batch_year,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'facebook_profile' => $request->facebook_profile,
            'whatsapp_number' => $request->whatsapp_number,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'country_of_residence' => $request->country_of_residence,
            'city_of_residence' => $request->city_of_residence,
            'occupation' => $request->occupation,
            'organization_name' => $request->organization_name,
            'designation' => $request->designation,
            'work_location' => $request->work_location,
            'marital_status' => $request->marital_status,
            'spouse_name' => $request->spouse_name,
            'number_of_children' => $numberOfChildren,
            'photo_path' => $photoPath,
            'favorite_memory' => $request->favorite_memory,
            'accompanying_guests' => $request->accompanying_guests,
            'tshirt_size' => $request->tshirt_size,
            'willing_to_volunteer' => $request->willing_to_volunteer ?? false,
            'password' => Hash::make($request->password),
        ]);

        // Handle children if provided
        if ($request->has('children')) {
            foreach ($request->children as $child) {
                $user->children()->create([
                    'name' => $child['name'],
                    'age' => $child['age']
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }
}
