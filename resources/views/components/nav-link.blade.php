<!-- Navbar -->
<nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 ">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/statistics-alumni-logo.png') }}" alt="Statistics Alumni Association Logo"
                        class="w-36 h-28 sm:w-40 sm:h-32 object-contain">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-2 lg:space-x-4">
                <a href="/"
                    class="nav-link px-4 py-2 rounded-xl font-semibold text-blue-900 hover:bg-blue-100 hover:text-blue-800 transition-all duration-200 text-sm lg:text-base">Home</a>
                <a href="#about"
                    class="nav-link px-4 py-2 rounded-xl font-semibold text-blue-900 hover:bg-blue-100 hover:text-blue-800 transition-all duration-200 text-sm lg:text-base">About</a>
                <a href="#details"
                    class="nav-link px-4 py-2 rounded-xl font-semibold text-blue-900 hover:bg-blue-100 hover:text-blue-800 transition-all duration-200 text-sm lg:text-base">Details</a>
                <a href="#schedule"
                    class="nav-link px-4 py-2 rounded-xl font-semibold text-blue-900 hover:bg-blue-100 hover:text-blue-800 transition-all duration-200 text-sm lg:text-base">Schedule</a>
                <a href="#memories"
                    class="nav-link px-4 py-2 rounded-xl font-semibold text-blue-900 hover:bg-blue-100 hover:text-blue-800 transition-all duration-200 text-sm lg:text-base">Memories</a>
                
                @guest
                    <div class="flex items-center space-x-2 lg:space-x-3 ml-4">
                        <a href="/login"
                        class="nav-link px-4 py-2 rounded-xl font-semibold bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-md hover:scale-105 hover:shadow-lg transition-all duration-200 text-sm lg:text-base">Login</a>
                        <a href="/register"
                        class="nav-link px-4 py-2 rounded-xl font-semibold bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-md hover:scale-105 hover:shadow-lg transition-all duration-200 text-sm lg:text-base">Register</a>
                    </div>
                @endguest
            </div>

           
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white/95 backdrop-blur-sm shadow-xl border-t border-gray-200 hidden">
        <div class="px-6 py-4 space-y-3">
            <a href="/" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">Home</a>
            <a href="#about" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">About</a>
            <a href="#details" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">Details</a>
            <a href="#schedule" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">Schedule</a>
            <a href="#memories" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">Memories</a>
            
            @guest
                <div class="pt-4 border-t border-gray-200 mt-4">
                    <a href="/login" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">Login</a>
                    <a href="/register" class="block py-3 px-4 rounded-xl text-blue-900 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 font-medium">Register</a>
                </div>
            @endguest
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideMenu = mobileMenu.contains(event.target);
        const isClickOnToggle = mobileMenuToggle.contains(event.target);
        
        if (!isClickInsideMenu && !isClickOnToggle && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
        }
    });
});
</script>