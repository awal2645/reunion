<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>500 - Server Error</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full text-center">
            <!-- 500 Illustration -->
            <div class="mb-8">
                <div class="relative">
                    <!-- Large 500 Text -->
                    <div class="text-9xl font-bold text-red-600/20 leading-none">500</div>
                    
                    <!-- Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center shadow-xl">
                            <i class="fas fa-exclamation-triangle text-white text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Server Error</h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Oops! Something went wrong on our end. 
                    Our team has been notified and is working to fix this issue.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4 mb-8">
                <button onclick="window.location.reload()" 
                   class="inline-flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-redo mr-2"></i>
                    Try Again
                </button>
                
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center justify-center w-full px-6 py-3 bg-white text-red-600 font-semibold rounded-xl border-2 border-red-200 hover:border-red-300 hover:bg-red-50 transition-all duration-300">
                    <i class="fas fa-home mr-2"></i>
                    Go to Home
                </a>
            </div>

            <!-- Helpful Links -->
            <div class="border-t border-gray-200 pt-6">
                <p class="text-sm text-gray-500 mb-4">While we fix this, try:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 hover:underline">
                        <i class="fas fa-sign-in-alt mr-1"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="text-red-600 hover:text-red-700 hover:underline">
                        <i class="fas fa-user-plus mr-1"></i>Register
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-red-600 hover:text-red-700 hover:underline">
                        <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                    </a>
                </div>
            </div>

            <!-- Status Information -->
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-center text-yellow-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    <span class="text-sm">
                        <strong>Error Code:</strong> 500 - Internal Server Error
                    </span>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-red-200 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-16 h-16 bg-red-300 rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-5 w-8 h-8 bg-red-100 rounded-full opacity-30 animate-bounce"></div>
            <div class="absolute top-1/2 right-5 w-6 h-6 bg-red-200 rounded-full opacity-30 animate-bounce" style="animation-delay: 0.5s;"></div>
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

    <!-- Auto-refresh Timer -->
    <div class="fixed bottom-4 right-4">
        <div class="bg-white/80 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg">
            <div class="text-sm text-gray-600">
                <i class="fas fa-clock mr-2"></i>
                Auto-refresh in <span id="countdown">30</span>s
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh countdown
        let timeLeft = 30;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            timeLeft--;
            countdownElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                window.location.reload();
            }
        }, 1000);
    </script>
</body>
</html>
