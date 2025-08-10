<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>404 - Page Not Found</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full text-center">
            <!-- 404 Illustration -->
            <div class="mb-8">
                <div class="relative">
                    <!-- Large 404 Text -->
                    <div class="text-9xl font-bold text-blue-600/20 leading-none">404</div>
                    
                    <!-- Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-xl">
                            <i class="fas fa-search text-white text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Page Not Found</h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Oops! The page you're looking for seems to have wandered off. 
                    It might have been moved, deleted, or never existed.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4 mb-8">
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-home mr-2"></i>
                    Go to Dashboard
                </a>
                
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center justify-center w-full px-6 py-3 bg-white text-blue-600 font-semibold rounded-xl border-2 border-blue-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>

            <!-- Helpful Links -->
            <div class="border-t border-gray-200 pt-6">
                <p class="text-sm text-gray-500 mb-4">Try these helpful links:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                        <i class="fas fa-sign-in-alt mr-1"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                        <i class="fas fa-user-plus mr-1"></i>Register
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                        <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                    </a>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-16 h-16 bg-blue-300 rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-5 w-8 h-8 bg-blue-100 rounded-full opacity-30 animate-bounce"></div>
            <div class="absolute top-1/2 right-5 w-6 h-6 bg-blue-200 rounded-full opacity-30 animate-bounce" style="animation-delay: 0.5s;"></div>
        </div>
    </div>

    <!-- Floating Navigation -->
    <div class="fixed top-4 left-4">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm text-gray-700 rounded-lg shadow-lg hover:bg-white transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="hidden sm:inline">Back</span>
        </a>
    </div>
</body>
</html>
