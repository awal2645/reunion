@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-indigo-100 py-32 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Forgot Password Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-8 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-envelope-open text-white text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Forgot Password</h2>
                <p class="text-purple-100 text-sm">We'll send you a reset link</p>
            </div>

            <!-- Form Section -->
            <div class="px-8 py-8">
                <!-- Description -->
                <div class="mb-6 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-question-circle text-purple-600 text-2xl"></i>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-3">
                        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                    </p>
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded-r-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2"></i>
                            <p class="text-blue-700 text-xs">
                                <strong>Pro tip:</strong> Check your spam/junk folder if you don't receive the email within a few minutes.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-purple-500 mr-2"></i>
                            Email Address
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                autocomplete="username"
                                placeholder="Enter your email address"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-purple-500 transition-all duration-300 pl-12"
                            />
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-purple-600 to-purple-700 text-white py-3 px-6 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Remember your password?</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <a 
                        href="{{ route('login') }}" 
                        class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-800 font-semibold transition-colors"
                    >
                        <i class="fas fa-sign-in-alt"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 text-center">
            <div class="text-sm text-gray-500">
                <i class="fas fa-shield-alt text-purple-500 mr-1"></i>
                We'll send you a secure password reset link
            </div>
        </div>
    </div>
</div>
@endsection
