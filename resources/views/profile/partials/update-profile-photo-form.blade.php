<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Photo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your profile photo.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Current Photo Display -->
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                @if($user->hasProfilePhoto())
                    <img class="h-20 w-20 rounded-full object-cover" 
                         src="{{ $user->profile_photo_url }}" 
                         alt="{{ $user->full_name }}'s profile photo">
                @else
                    <div class="h-20 w-20 rounded-full bg-gray-300 flex items-center justify-center">
                        <svg class="h-10 w-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
            </div>
            
            <div class="flex-1">
                <h3 class="text-sm font-medium text-gray-900">{{ $user->full_name }}</h3>
                <p class="text-sm text-gray-500">
                    @if($user->hasProfilePhoto())
                        {{ __('Current photo') }}
                    @else
                        {{ __('No photo uploaded') }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Photo Upload -->
        <div>
            <x-input-label for="photo" :value="__('New Photo')" />
            <div class="mt-1 flex items-center">
                <x-file-input id="photo" name="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            </div>
            <p class="mt-2 text-sm text-gray-500">
                {{ __('Upload a new profile photo. Supported formats: JPEG, PNG, JPG, GIF. Maximum size: 2MB.') }}
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update Photo') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Photo updated.') }}</p>
            @endif
        </div>
    </form>
</section>
