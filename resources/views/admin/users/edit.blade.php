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
