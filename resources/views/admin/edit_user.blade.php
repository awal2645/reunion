@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gray-50 pt-32 md:px-32">    
    @include('components.aside')
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-1">Edit User: {{ $user->full_name }}</h1>
                            <p class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-user-cog text-blue-500"></i>
                                Update user information and settings
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:bg-gray-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Users
                    </a>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Basic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter full name">
                            </div>

                            <div>
                                <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">Nickname</label>
                                <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $user->nickname) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter nickname">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter email address">
                            </div>

                            <div>
                                <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Contact Number *</label>
                                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $user->contact_number) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter contact number">
                            </div>

                            <div>
                                <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $user->whatsapp_number) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter WhatsApp number">
                            </div>

                            <div>
                                <label for="blood_group" class="block text-sm font-medium text-gray-700 mb-2">Blood Group</label>
                                <select name="blood_group" id="blood_group" 
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" {{ $user->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $user->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $user->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $user->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ $user->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ $user->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ $user->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ $user->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Academic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="session" class="block text-sm font-medium text-gray-700 mb-2">Session *</label>
                                <input type="text" name="session" id="session" value="{{ old('session', $user->session) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter session">
                            </div>

                            <div>
                                <label for="batch_year" class="block text-sm font-medium text-gray-700 mb-2">Batch Year *</label>
                                <select name="batch_year" id="batch_year" 
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">Select Batch Year</option>
                                    @for($year = 2025; $year >= 1990; $year--)
                                        <option value="{{ $year }}" {{ $user->batch_year == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Address Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="present_address" class="block text-sm font-medium text-gray-700 mb-2">Present Address *</label>
                                <textarea name="present_address" id="present_address" rows="3"
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                          placeholder="Enter present address">{{ old('present_address', $user->present_address) }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label for="permanent_address" class="block text-sm font-medium text-gray-700 mb-2">Permanent Address *</label>
                                <textarea name="permanent_address" id="permanent_address" rows="3"
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                          placeholder="Enter permanent address">{{ old('permanent_address', $user->permanent_address) }}</textarea>
                            </div>

                            <div>
                                <label for="country_of_residence" class="block text-sm font-medium text-gray-700 mb-2">Country of Residence *</label>
                                <input type="text" name="country_of_residence" id="country_of_residence" value="{{ old('country_of_residence', $user->country_of_residence) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter country">
                            </div>

                            <div>
                                <label for="city_of_residence" class="block text-sm font-medium text-gray-700 mb-2">City of Residence *</label>
                                <input type="text" name="city_of_residence" id="city_of_residence" value="{{ old('city_of_residence', $user->city_of_residence) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter city">
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Professional Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                                <input type="text" name="occupation" id="occupation" value="{{ old('occupation', $user->occupation) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter occupation">
                            </div>

                            <div>
                                <label for="organization_name" class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                                <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $user->organization_name) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter organization name">
                            </div>

                            <div>
                                <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Designation</label>
                                <input type="text" name="designation" id="designation" value="{{ old('designation', $user->designation) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter designation">
                            </div>

                            <div>
                                <label for="work_location" class="block text-sm font-medium text-gray-700 mb-2">Work Location</label>
                                <input type="text" name="work_location" id="work_location" value="{{ old('work_location', $user->work_location) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter work location">
                            </div>
                        </div>
                    </div>

                    <!-- Family Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Family Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">Marital Status</label>
                                <select name="marital_status" id="marital_status" onchange="toggleSpouseField()"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">Select Marital Status</option>
                                    <option value="single" {{ $user->marital_status == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ $user->marital_status == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ $user->marital_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ $user->marital_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                            </div>

                            <div id="spouseField" class="{{ $user->marital_status == 'married' ? '' : 'hidden' }}">
                                <label for="spouse_name" class="block text-sm font-medium text-gray-700 mb-2">Spouse Name</label>
                                <input type="text" name="spouse_name" id="spouse_name" value="{{ old('spouse_name', $user->spouse_name) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter spouse name">
                            </div>

                            <div>
                                <label for="number_of_children" class="block text-sm font-medium text-gray-700 mb-2">Number of Children</label>
                                <input type="number" name="number_of_children" id="number_of_children" value="{{ old('number_of_children', $user->number_of_children) }}" min="0" max="10"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter number of children">
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Additional Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="facebook_profile" class="block text-sm font-medium text-gray-700 mb-2">Facebook Profile</label>
                                <input type="url" name="facebook_profile" id="facebook_profile" value="{{ old('facebook_profile', $user->facebook_profile) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter Facebook profile URL">
                            </div>

                            <div>
                                <label for="tshirt_size" class="block text-sm font-medium text-gray-700 mb-2">T-Shirt Size</label>
                                <select name="tshirt_size" id="tshirt_size" 
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">Select T-Shirt Size</option>
                                    <option value="XS" {{ $user->tshirt_size == 'XS' ? 'selected' : '' }}>XS</option>
                                    <option value="S" {{ $user->tshirt_size == 'S' ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ $user->tshirt_size == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="L" {{ $user->tshirt_size == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="XL" {{ $user->tshirt_size == 'XL' ? 'selected' : '' }}>XL</option>
                                    <option value="XXL" {{ $user->tshirt_size == 'XXL' ? 'selected' : '' }}>XXL</option>
                                    <option value="XXXL" {{ $user->tshirt_size == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                </select>
                            </div>

                            <div>
                                <label for="accompanying_guests" class="block text-sm font-medium text-gray-700 mb-2">Accompanying Guests</label>
                                <input type="number" name="accompanying_guests" id="accompanying_guests" value="{{ old('accompanying_guests', $user->accompanying_guests) }}" min="0" max="10
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                       placeholder="Enter number of guests">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="willing_to_volunteer" id="willing_to_volunteer" value="1" {{ $user->willing_to_volunteer ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="willing_to_volunteer" class="ml-2 block text-sm text-gray-900">
                                    Willing to volunteer at the reunion
                                </label>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="favorite_memory" class="block text-sm font-medium text-gray-700 mb-2">Favorite Memory</label>
                            <textarea name="favorite_memory" id="favorite_memory" rows="3"
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                      placeholder="Share your favorite memory from college">{{ old('favorite_memory', $user->favorite_memory) }}</textarea>
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Profile Photo</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-center space-x-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Current Photo</label>
                                    @if($user->hasProfilePhoto())
                                        <img class="h-24 w-24 rounded-full object-cover border-4 border-gray-200 shadow-lg" src="{{ $user->profile_photo_url }}" alt="Current Photo">
                                    @else
                                        <div class="h-24 w-24 bg-gray-300 rounded-full border-4 border-gray-200 flex items-center justify-center shadow-lg">
                                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Upload New Photo</label>
                                    <div class="flex items-center space-x-4">
                                        <input type="file" name="photo" id="photo" accept="image/*"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200">
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                        Supported formats: JPEG, PNG, JPG, GIF. Maximum size: 2MB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Update -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Update Password</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Password
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="current_password" 
                                           id="current_password"
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="Enter current password">
                                    <button type="button" 
                                            onclick="togglePasswordVisibility('current_password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="current_password_icon"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    New Password
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password" 
                                           id="password"
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="Enter new password">
                                    <button type="button" 
                                            onclick="togglePasswordVisibility('password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="password_icon"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm New Password
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password_confirmation" 
                                           id="password_confirmation"
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="Confirm new password">
                                    <button type="button" 
                                            onclick="togglePasswordVisibility('password_confirmation')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                    <h4 class="text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                                        <i class="fas fa-shield-alt text-blue-500"></i>
                                        Password Requirements
                                    </h4>
                                    <ul class="text-sm text-blue-600 space-y-1">
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-blue-500 text-xs"></i>
                                            At least 8 characters long
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-blue-500 text-xs"></i>
                                            Contains at least one uppercase letter
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-blue-500 text-xs"></i>
                                            Contains at least one lowercase letter
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-blue-500 text-xs"></i>
                                            Contains at least one number
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-save mr-2"></i>
                            Update User
                        </button>
                        
                        <a href="{{ route('admin.users') }}" 
                           class="inline-flex items-center justify-center px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:bg-gray-200 transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
function toggleSpouseField() {
    const maritalStatus = document.getElementById('marital_status').value;
    const spouseField = document.getElementById('spouseField');
    
    if (maritalStatus === 'married') {
        spouseField.classList.remove('hidden');
    } else {
        spouseField.classList.add('hidden');
        document.getElementById('spouse_name').value = '';
    }
}

function togglePasswordVisibility(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleSpouseField();
});
</script>
@endsection
