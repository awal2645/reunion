@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gray-50 pt-32 md:px-32">    
    @include('components.aside')
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-600 to-green-700 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-1">Edit User</h1>
                            <p class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-user-cog text-green-500"></i>
                                Update user information
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
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Basic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">Nickname (Optional)</label>
                                <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $user->nickname) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('nickname')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="blood_group" class="block text-sm font-medium text-gray-700 mb-2">Blood Group *</label>
                                <select name="blood_group" id="blood_group" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                    <option value="">Select Blood Group</option>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                        <option value="{{ $group }}" {{ old('blood_group', $user->blood_group) == $group ? 'selected' : '' }}>
                                            {{ $group }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('blood_group')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="session" class="block text-sm font-medium text-gray-700 mb-2">Session *</label>
                                <input type="text" name="session" id="session" value="{{ old('session', $user->session) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('session')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="batch_year" class="block text-sm font-medium text-gray-700 mb-2">Batch Year *</label>
                                <select name="batch_year" id="batch_year" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                    <option value="">Select Batch Year</option>
                                    @for($year = 2025; $year >= 1990; $year--)
                                        <option value="{{ $year }}" {{ old('batch_year', $user->batch_year) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('batch_year')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Contact Number *</label>
                                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $user->contact_number) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('contact_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="facebook_profile" class="block text-sm font-medium text-gray-700 mb-2">Facebook Profile (Optional)</label>
                                <input type="url" name="facebook_profile" id="facebook_profile" value="{{ old('facebook_profile', $user->facebook_profile) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('facebook_profile')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number (Optional)</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $user->whatsapp_number) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('whatsapp_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Address Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="present_address" class="block text-sm font-medium text-gray-700 mb-2">Present Address *</label>
                                <textarea name="present_address" id="present_address" rows="3" required
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">{{ old('present_address', $user->present_address) }}</textarea>
                                @error('present_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="permanent_address" class="block text-sm font-medium text-gray-700 mb-2">Permanent Address *</label>
                                <textarea name="permanent_address" id="permanent_address" rows="3" required
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">{{ old('permanent_address', $user->permanent_address) }}</textarea>
                                @error('permanent_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="country_of_residence" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                <input type="text" name="country_of_residence" id="country_of_residence" value="{{ old('country_of_residence', $user->country_of_residence) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('country_of_residence')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="city_of_residence" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" name="city_of_residence" id="city_of_residence" value="{{ old('city_of_residence', $user->city_of_residence) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('city_of_residence')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Professional Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Current Occupation</label>
                                <input type="text" name="occupation" id="occupation" value="{{ old('occupation', $user->occupation) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('occupation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="organization_name" class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                                <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $user->organization_name) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('organization_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Designation/Position</label>
                                <input type="text" name="designation" id="designation" value="{{ old('designation', $user->designation) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('designation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="work_location" class="block text-sm font-medium text-gray-700 mb-2">Work Location</label>
                                <input type="text" name="work_location" id="work_location" value="{{ old('work_location', $user->work_location) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('work_location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Family Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Family Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">Marital Status *</label>
                                <select name="marital_status" id="marital_status" required onchange="toggleSpouseField()"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                    <option value="">Select Status</option>
                                    <option value="single" {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                @error('marital_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="spouseField" class="{{ old('marital_status', $user->marital_status) == 'married' ? '' : 'hidden' }}">
                                <label for="spouse_name" class="block text-sm font-medium text-gray-700 mb-2">Spouse Name</label>
                                <input type="text" name="spouse_name" id="spouse_name" value="{{ old('spouse_name', $user->spouse_name) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('spouse_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="number_of_children" class="block text-sm font-medium text-gray-700 mb-2">Number of Children *</label>
                                <input type="number" name="number_of_children" id="number_of_children" value="{{ old('number_of_children', $user->number_of_children) }}" min="0" max="10" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('number_of_children')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="children_names_ages" class="block text-sm font-medium text-gray-700 mb-2">Children Names and Ages (Optional)</label>
                                <textarea name="children_names_ages" id="children_names_ages" rows="3"
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">{{ old('children_names_ages', $user->children_names_ages) }}</textarea>
                                @error('children_names_ages')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Event Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Event Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="accompanying_guests" class="block text-sm font-medium text-gray-700 mb-2">Number of Accompanying Guests *</label>
                                <input type="number" name="accompanying_guests" id="accompanying_guests" value="{{ old('accompanying_guests', $user->accompanying_guests) }}" min="0" max="10" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                @error('accompanying_guests')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tshirt_size" class="block text-sm font-medium text-gray-700 mb-2">T-shirt Size</label>
                                <select name="tshirt_size" id="tshirt_size"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">
                                    <option value="">Select Size</option>
                                    @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $size)
                                        <option value="{{ $size }}" {{ old('tshirt_size', $user->tshirt_size) == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tshirt_size')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="favorite_memory" class="block text-sm font-medium text-gray-700 mb-2">Favorite Memory from the Department (Optional)</label>
                                <textarea name="favorite_memory" id="favorite_memory" rows="4"
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-green-500 transition-all duration-300">{{ old('favorite_memory', $user->favorite_memory) }}</textarea>
                                @error('favorite_memory')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="willing_to_volunteer" value="1" {{ old('willing_to_volunteer', $user->willing_to_volunteer) ? 'checked' : '' }}
                                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Willing to Volunteer? *</span>
                                </label>
                                @error('willing_to_volunteer')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Profile Photo</h3>
                        
                        <div class="space-y-6">
                            <!-- Current Photo Display -->
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
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-200">
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <i class="fas fa-info-circle text-green-500 mr-1"></i>
                                        Supported formats: JPEG, PNG, JPG, GIF. Maximum size: 2MB
                                    </p>
                                    @error('photo')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl shadow-lg hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-300">
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

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleSpouseField();
});
</script>
@endsection
