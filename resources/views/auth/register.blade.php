@extends('layouts.app')
@section('content')
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-20 px-4 sm:px-6 lg:px-8">
    <!-- Full-width Event Banner -->
    <div class="mb-10">
        <img src="{{ asset('images/banner.jpg') }}" alt="Event Banner"
             class="w-full max-w-6xl mx-auto h-auto rounded-2xl shadow-2xl border border-gray-100 object-contain bg-white" />
    </div>
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 text-white text-2xl shadow-lg mb-6">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Alumni Registration</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join us for the reunion celebration! Please fill out the form below to register.</p>
        </div>


        <!-- Registration Form -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="p-8">
        @csrf

                <!-- Basic Information -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white font-bold">1</div>
                        <h2 class="text-2xl font-bold text-gray-900">Basic Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="lg:col-span-2">
                            <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-blue-500 mr-2"></i>Full Name
                            </label>
                            <input id="full_name" name="full_name" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('full_name') }}" required autofocus autocomplete="name" 
                                placeholder="Enter your full name" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <!-- Nickname -->
                        <div>
                            <label for="nickname" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag text-blue-500 mr-2"></i>Nickname (if any)
                            </label>
                            <input id="nickname" name="nickname" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('nickname') }}" 
                                placeholder="Your preferred nickname" />
                            <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
                        </div>

                        <!-- Blood Group -->
                        <div>
                            <label for="blood_group" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tint text-red-500 mr-2"></i>Blood Group
                            </label>
                            <select id="blood_group" name="blood_group" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                                <option value="">Select Blood Group</option>
                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>
                            <x-input-error :messages="$errors->get('blood_group')" class="mt-2" />
                        </div>

                        <!-- Session -->
                        <div>
                            <label for="session" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar text-blue-500 mr-2"></i>Session
                            </label>
                            <select id="session" name="session" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" required>
                                <option value="">Select Session</option>
                                @for($year = 1887; $year <= 2024; $year++)
                                    <option value="{{ $year }}-{{ $year + 1 }}" {{ old('session') == $year . '-' . ($year + 1) ? 'selected' : '' }}>
                                        {{ $year }}-{{ $year + 1 }}
                                    </option>
                                @endfor
                            </select>
                            <p class="mt-1 text-xs text-red-500">
                                <i class="fas fa-info-circle text-red-500 mr-1"></i>
                                BSc Hons session is required
                            </p>
                            <x-input-error :messages="$errors->get('session')" class="mt-2" />
                        </div>

                        <!-- Course Completion -->
                        <div>
                            <label for="courses_completed" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>Which courses did you complete at Rajshahi College?
                            </label>
                            <select id="courses_completed" name="courses_completed" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                                <option value="">Select Course</option>
                                <option value="bsc" {{ old('courses_completed') == 'bsc' ? 'selected' : '' }}>BSc</option>
                                <option value="msc" {{ old('courses_completed') == 'msc' ? 'selected' : '' }}>MSc</option>
                                <option value="both" {{ old('courses_completed') == 'both' ? 'selected' : '' }}>Both BSc and MSc</option>
                            </select>
                            <x-input-error :messages="$errors->get('courses_completed')" class="mt-2" />
                        </div>



                        <!-- Contact Numbers -->
                        <div>
                            <label for="contact_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-blue-500 mr-2"></i>Contact Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500">+880</span>
                                </div>
                                <input id="contact_number" name="contact_number" type="tel" 
                                    class="w-full pl-16 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    value="{{ old('contact_number') }}" required 
                                    placeholder="1XXXXXXXXX" maxlength="11" />
                            </div>
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                        </div>

        <div>
                            <label for="whatsapp_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fab fa-whatsapp text-green-500 mr-2"></i>WhatsApp Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500">+880</span>
                                </div>
                                <input id="whatsapp_number" name="whatsapp_number" type="tel" 
                                    class="w-full pl-16 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    value="{{ old('whatsapp_number') }}" 
                                    placeholder="1XXXXXXXXX" maxlength="11" />
                            </div>
                            <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2" />
        </div>

                        <!-- Email -->
                        <div class="lg:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-blue-500 mr-2"></i>Email Address
                            </label>
                            <input id="email" name="email" type="email" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('email') }}" required 
                                placeholder="your.email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

                        <!-- Facebook Profile -->
                        <div class="lg:col-span-2">
                            <label for="facebook_profile" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook Profile Link (optional)
                            </label>
                            <input id="facebook_profile" name="facebook_profile" type="url" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('facebook_profile') }}" 
                                placeholder="https://facebook.com/your.profile" />
                            <x-input-error :messages="$errors->get('facebook_profile')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Current Address Details -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-600 to-green-700 flex items-center justify-center text-white font-bold">2</div>
                        <h2 class="text-2xl font-bold text-gray-900">Current Address Details</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="present_vill" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-home text-red-500 mr-2"></i>Vill/Area
                            </label>
                            <input id="present_vill" name="present_vill" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('present_vill') }}" required 
                                placeholder="Enter your village/area" />
                            <x-input-error :messages="$errors->get('present_vill')" class="mt-2" />
                        </div>

                        <div>
                            <label for="present_post_office" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-mailbox text-blue-500 mr-2"></i>Post Office
                            </label>
                            <input id="present_post_office" name="present_post_office" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('present_post_office') }}" required 
                                placeholder="Enter post office" />
                            <x-input-error :messages="$errors->get('present_post_office')" class="mt-2" />
                        </div>

                        <div>
                            <label for="present_thana" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>Thana/Upazila
                            </label>
                            <input id="present_thana" name="present_thana" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('present_thana') }}" required 
                                placeholder="Enter thana/upazila" />
                            <x-input-error :messages="$errors->get('present_thana')" class="mt-2" />
                        </div>

                        <div>
                            <label for="present_district" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-city text-purple-500 mr-2"></i>District
                            </label>
                            <input id="present_district" name="present_district" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('present_district') }}" required 
                                placeholder="Enter district" />
                            <x-input-error :messages="$errors->get('present_district')" class="mt-2" />
                        </div>

                        <div>
                            <label for="country_of_residence" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-globe text-blue-500 mr-2"></i>Country of Residence
                            </label>
                            <input id="country_of_residence" name="country_of_residence" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('country_of_residence') }}" required 
                                placeholder="Enter your country of residence" />
                            <x-input-error :messages="$errors->get('country_of_residence')" class="mt-2" />
                        </div>

                        <div>
                            <label for="city_of_residence" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-city text-blue-500 mr-2"></i>City of Residence
                            </label>
                            <input id="city_of_residence" name="city_of_residence" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('city_of_residence') }}" required 
                                placeholder="Enter your city of residence" />
                            <x-input-error :messages="$errors->get('city_of_residence')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Permanent Address Details -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-600 to-indigo-700 flex items-center justify-center text-white font-bold">3</div>
                            <h2 class="text-2xl font-bold text-gray-900">Permanent Address Details</h2>
                        </div>
                        
                        <!-- Copy Address Button and Checkbox -->
                        <div class="flex items-center gap-4">
                            <button type="button " onclick="copyCurrentAddress()"  
                                    class="inline-flex  hidden items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-copy mr-1"></i>
                                Copy Current Address
                            </button>
                            
                            <label for="same_as_current" class="inline-flex items-center p-3 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors cursor-pointer border border-indigo-200">
                                <input id="same_as_current" type="checkbox" name="same_as_current" value="1" 
                                       class="rounded border-indigo-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                       onchange="toggleAddressSync()">
                                <span class="ml-3 text-indigo-700 font-medium text-sm">
                                    <i class="fas fa-link text-indigo-500 mr-2"></i>
                                    Same as Current Address
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="permanent_vill" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-home text-red-500 mr-2"></i>Vill/Area
                            </label>
                            <input id="permanent_vill" name="permanent_vill" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('permanent_vill') }}" required 
                                placeholder="Enter your village/area" />
                            <x-input-error :messages="$errors->get('permanent_vill')" class="mt-2" />
                        </div>

                        <div>
                            <label for="permanent_post_office" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-mailbox text-blue-500 mr-2"></i>Post Office
                            </label>
                            <input id="permanent_post_office" name="permanent_post_office" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('permanent_post_office') }}" required 
                                placeholder="Enter post office" />
                            <x-input-error :messages="$errors->get('permanent_post_office')" class="mt-2" />
                        </div>

                        <div>
                            <label for="permanent_thana" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>Thana/Upazila
                            </label>
                            <input id="permanent_thana" name="permanent_thana" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('permanent_thana') }}" required 
                                placeholder="Enter thana/upazila" />
                            <x-input-error :messages="$errors->get('permanent_thana')" class="mt-2" />
                        </div>

                        <div>
                            <label for="permanent_district" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-city text-purple-500 mr-2"></i>District
                            </label>
                            <input id="permanent_district" name="permanent_district" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('permanent_district') }}" required 
                                placeholder="Enter district" />
                            <x-input-error :messages="$errors->get('permanent_district')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-purple-700 flex items-center justify-center text-white font-bold">4</div>
                        <h2 class="text-2xl font-bold text-gray-900">Professional Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label for="occupation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-briefcase text-blue-500 mr-2"></i>Current Occupation/Profession
                            </label>
                            <input id="occupation" name="occupation" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('occupation') }}" required 
                                placeholder="Enter your current occupation" />
                            <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                        </div>

                        <div class="lg:col-span-2">
                            <label for="organization_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-building text-blue-500 mr-2"></i>Organization Name
                            </label>
                            <input id="organization_name" name="organization_name" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('organization_name') }}" 
                                placeholder="Enter your organization name" />
                            <x-input-error :messages="$errors->get('organization_name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="designation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-id-badge text-blue-500 mr-2"></i>Designation/Position
                            </label>
                            <input id="designation" name="designation" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('designation') }}" 
                                placeholder="Enter your designation" />
                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                        </div>

                        <div>
                            <label for="work_location" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-pin text-blue-500 mr-2"></i>Work Location
                            </label>
                            <input id="work_location" name="work_location" type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('work_location') }}" 
                                placeholder="Enter your work location" />
                            <x-input-error :messages="$errors->get('work_location')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-600 to-orange-700 flex items-center justify-center text-white font-bold">5</div>
                        <h2 class="text-2xl font-bold text-gray-900">Additional Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Photo Upload -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-camera text-blue-500 mr-2"></i>Upload a Recent Photo
                            </label>
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-500 transition-colors duration-200 bg-gray-50">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="photo" name="photo" type="file" accept="image/*" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 4MB</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- Favorite Memory -->
                        <div class="lg:col-span-2">
                            <label for="favorite_memory" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heart text-red-500 mr-2"></i>Favorite Memory from the Department
                            </label>
                            <textarea id="favorite_memory" name="favorite_memory" rows="4" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                placeholder="Share your favorite memory">{{ old('favorite_memory') }}</textarea>
                            <x-input-error :messages="$errors->get('favorite_memory')" class="mt-2" />
                        </div>

                        <!-- Accompanying Guests -->
                        <div>
                            <label for="accompanying_guests" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-blue-500 mr-2"></i>Number of Accompanying Guests
                            </label>
                            <input id="accompanying_guests" name="accompanying_guests" type="number" min="0" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                value="{{ old('accompanying_guests') }}" 
                                placeholder="Enter number of guests" />
                            <x-input-error :messages="$errors->get('accompanying_guests')" class="mt-2" />
                        </div>

                        <!-- T-shirt Size -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label for="tshirt_size" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-tshirt text-blue-500 mr-2"></i>T-shirt Size
                                </label>
                                <button type="button" 
                                    onclick="document.getElementById('size-guide-modal').classList.remove('hidden')"
                                    class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i>Size Guide
                                </button>
                            </div>
                            <select id="tshirt_size" name="tshirt_size" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" required>
                                <option value="">Select Size</option>
                                <option value="XS" {{ old('tshirt_size') == 'XS' ? 'selected' : '' }}>XS - Chest: 34" | Length: 24" | Sleeve: 7.5"</option>
                                <option value="S" {{ old('tshirt_size') == 'S' ? 'selected' : '' }}>S - Chest: 36" | Length: 25" | Sleeve: 8"</option>
                                <option value="M" {{ old('tshirt_size') == 'M' ? 'selected' : '' }}>M - Chest: 38" | Length: 26" | Sleeve: 8"</option>
                                <option value="L" {{ old('tshirt_size') == 'L' ? 'selected' : '' }}>L - Chest: 40" | Length: 27" | Sleeve: 8.5"</option>
                                <option value="XL" {{ old('tshirt_size') == 'XL' ? 'selected' : '' }}>XL - Chest: 42" | Length: 28" | Sleeve: 8.5"</option>
                                <option value="XXL" {{ old('tshirt_size') == 'XXL' ? 'selected' : '' }}>2XL - Chest: 44" | Length: 29" | Sleeve: 9"</option>
                                <option value="XXXL" {{ old('tshirt_size') == 'XXXL' ? 'selected' : '' }}>3XL - Chest: 46" | Length: 30" | Sleeve: 10"</option>
                            </select>
                            <x-input-error :messages="$errors->get('tshirt_size')" class="mt-2" />
                        </div>

                        <!-- Volunteer Checkbox -->
                        <div class="lg:col-span-2">
                            <label for="willing_to_volunteer" class="inline-flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer">
                                <input id="willing_to_volunteer" type="checkbox" name="willing_to_volunteer" value="1" 
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                                    {{ old('willing_to_volunteer') ? 'checked' : '' }}>
                                <span class="ml-3 text-gray-700 font-medium">
                                    <i class="fas fa-hands-helping text-blue-500 mr-2"></i>
                                    Willing to Volunteer?
                                </span>
                            </label>
                            <x-input-error :messages="$errors->get('willing_to_volunteer')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Account Security -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-red-700 flex items-center justify-center text-white font-bold">6</div>
                        <h2 class="text-2xl font-bold text-gray-900">Account Security</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-500 mr-2"></i>Password
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" 
                                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    required autocomplete="new-password" placeholder="Enter your password" />
                                <button type="button" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors"
                                    onclick="togglePasswordVisibility('password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </button>
                            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-500 mr-2"></i>Confirm Password
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" type="password" 
                                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" 
                                    required autocomplete="new-password" placeholder="Confirm your password" />
                                <button type="button" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors"
                                    onclick="togglePasswordVisibility('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation-eye"></i>
                                </button>
                            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200">
                    <a class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                        href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt mr-1"></i>Already registered?
                    </a>

                    <button type="submit" 
                        class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-user-plus mr-2"></i>Complete Registration
                    </button>
                </div>
            </form>
        </div>

        <!-- Size Guide Modal -->
        <div id="size-guide-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto z-50 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-2xl">
                <div class="absolute -top-4 -right-4 z-50">
                    <button type="button" 
                        onclick="document.getElementById('size-guide-modal').classList.add('hidden')"
                        class="bg-white rounded-full p-3 shadow-lg text-gray-500 hover:text-gray-700 focus:outline-none transform transition hover:scale-110">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">T-Shirt Size Guide</h3>
                    
                    <div class="relative bg-gray-50 rounded-xl p-6 mb-6">
                        <div class="max-h-[400px] overflow-y-auto">
                            <img src="{{ asset('images/tshirt/size.jpeg') }}" 
                                alt="T-shirt Size Chart" 
                                class="w-full h-auto object-contain rounded-lg mx-auto"
                                style="max-height: 350px;">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            onclick="document.getElementById('size-guide-modal').classList.add('hidden')"
                            class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                            Close
                        </button>
                        <button type="button"
                            onclick="document.getElementById('size-guide-modal').classList.add('hidden')"
                            class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                            Got It
                        </button>
                    </div>
                </div>
            </div>
            <div class="fixed inset-0 z-40" onclick="document.getElementById('size-guide-modal').classList.add('hidden')"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image Preview Handler
            const photoInput = document.getElementById('photo');
            const uploadContainer = photoInput.closest('.border-dashed');
            
            // Create and append preview elements
            const previewContainer = document.createElement('div');
            previewContainer.className = 'hidden mt-4 relative mx-auto max-w-xs';
            previewContainer.innerHTML = `
                <img id="preview-img" class="mx-auto max-h-48 rounded-xl shadow-lg" />
                <button type="button" id="remove-image" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-2 shadow-lg hover:bg-red-600 focus:outline-none transition-all duration-300">
                    <i class="fas fa-times"></i>
                </button>
            `;
            uploadContainer.parentNode.insertBefore(previewContainer, uploadContainer.nextSibling);

            const previewImg = document.getElementById('preview-img');
            const removeButton = document.getElementById('remove-image');
            const uploadIcon = uploadContainer.querySelector('svg');
            const uploadText = uploadContainer.querySelector('label span');

            // Handle file selection
            photoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please select a valid image file (PNG, JPG, or GIF)');
                        this.value = '';
                        return;
                    }

                    // Validate file size (4MB)
                    if (file.size > 4 * 1024 * 1024) {
                        alert('Image size should be less than 4MB');
                        this.value = '';
                        return;
                    }

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        uploadContainer.classList.add('opacity-50');
                        uploadText.textContent = 'Change photo';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle remove button click
            removeButton.addEventListener('click', function() {
                photoInput.value = '';
                previewContainer.classList.add('hidden');
                uploadContainer.classList.remove('opacity-50');
                uploadText.textContent = 'Upload a file';
                previewImg.src = '';
            });

            // Handle drag and drop
            uploadContainer.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('border-blue-500', 'bg-blue-50');
            });

            uploadContainer.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('border-blue-500', 'bg-blue-50');
            });

            uploadContainer.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('border-blue-500', 'bg-blue-50');
                
                const file = e.dataTransfer.files[0];
                if (file) {
                    photoInput.files = e.dataTransfer.files;
                    photoInput.dispatchEvent(new Event('change'));
                }
            });
        });

        // Password visibility toggle
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(`${inputId}-eye`);
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Copy current address to permanent address
        function copyCurrentAddress() {
            const currentVill = document.getElementById('present_vill').value;
            const currentPostOffice = document.getElementById('present_post_office').value;
            const currentThana = document.getElementById('present_thana').value;
            const currentDistrict = document.getElementById('present_district').value;
            
            if (!currentVill || !currentPostOffice || !currentThana || !currentDistrict) {
                alert('Please fill in all current address fields first before copying.');
                return;
            }
            
            document.getElementById('permanent_vill').value = currentVill;
            document.getElementById('permanent_post_office').value = currentPostOffice;
            document.getElementById('permanent_thana').value = currentThana;
            document.getElementById('permanent_district').value = currentDistrict;
            
            // Show success message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Address copied successfully!',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        }

        // Toggle address synchronization
        function toggleAddressSync() {
            const sameAsCurrent = document.getElementById('same_as_current');
            const permanentFields = [
                'permanent_vill',
                'permanent_post_office', 
                'permanent_thana',
                'permanent_district'
            ];
            
            if (sameAsCurrent.checked) {
                // Enable auto-sync
                permanentFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    field.addEventListener('input', syncAddressFields);
                    field.addEventListener('change', syncAddressFields);
                });
                
                // Copy current values
                copyCurrentAddress();
                
                // Disable permanent address fields
                permanentFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    field.disabled = true;
                    field.classList.add('bg-gray-100', 'cursor-not-allowed');
                });
                
            } else {
                // Disable auto-sync
                permanentFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    field.removeEventListener('input', syncAddressFields);
                    field.removeEventListener('change', syncAddressFields);
                });
                
                // Enable permanent address fields
                permanentFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    field.disabled = false;
                    field.classList.remove('bg-gray-100', 'cursor-not-allowed');
                });
            }
        }

        // Sync address fields when current address changes
        function syncAddressFields() {
            const sameAsCurrent = document.getElementById('same_as_current');
            if (sameAsCurrent.checked) {
                copyCurrentAddress();
            }
        }
    </script>
@endsection
