<!-- Footer -->
<footer class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 text-blue-800 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12 mb-8">
            
            <!-- Logo & Description -->
            <div class="text-center lg:text-left">
                <div class="flex items-center justify-center lg:justify-start gap-3 mb-6">
                    <img src="{{ asset('images/statistics-alumni-logo.png') }}" alt="Statistics Alumni Association Logo"
                         class="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48 object-contain">
                </div>
                <p class="text-blue-700 max-w-md mx-auto lg:mx-0 leading-relaxed mb-6 text-sm sm:text-base">
                    A heartfelt gathering to honor our shared legacy and lifelong connections. 
                    Join us in celebrating the bonds that last a lifetime.
                </p>
                
                <!-- Social Media Links -->
                <div class="flex items-center justify-center lg:justify-start gap-4">
                    <a href="https://www.facebook.com/StatisticsAlumniAssociation" 
                       class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" 
                       class="w-10 h-10 bg-green-600 hover:bg-green-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </a>
                    <a href="#" 
                       class="w-10 h-10 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                        <i class="fab fa-telegram text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="text-center lg:text-left">
                <h3 class="text-lg font-semibold mb-6 text-blue-900">Quick Links</h3>
                <ul class="space-y-3 text-blue-700 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-blue-900 transition-colors duration-300 flex items-center justify-center lg:justify-start gap-2">
                            <i class="fas fa-home text-blue-500"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="hover:text-blue-900 transition-colors duration-300 flex items-center justify-center lg:justify-start gap-2">
                            <i class="fas fa-user-plus text-blue-500"></i>
                            <span>Register</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:text-blue-900 transition-colors duration-300 flex items-center justify-center lg:justify-start gap-2">
                            <i class="fas fa-sign-in-alt text-blue-500"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="hover:text-blue-900 transition-colors duration-300 flex items-center justify-center lg:justify-start gap-2">
                            <i class="fas fa-tachometer-alt text-blue-500"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="text-center lg:text-left">
                <h3 class="text-lg font-semibold mb-6 text-blue-900">Contact Us</h3>
                <ul class="space-y-4 text-blue-700 text-sm">
                    <li class="flex flex-col sm:flex-row items-center lg:items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-blue-500 text-sm"></i>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="font-medium text-blue-900">Email</div>
                            <a href="mailto:info@rcstatreunion.com" class="hover:text-blue-900 transition-colors duration-300 break-all">
                                info@rcstatreunion.com
                            </a>
                        </div>
                    </li>
                    <li class="flex flex-col sm:flex-row items-center lg:items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-blue-500 text-sm"></i>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="font-medium text-blue-900">Phone</div>
                            <a href="tel:+8801577281779" class="hover:text-blue-900 transition-colors duration-300">
                                +880 1577 281779
                            </a>
                        </div>
                    </li>
                    <li class="flex flex-col sm:flex-row items-center lg:items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-blue-500 text-sm"></i>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="font-medium text-blue-900">Venue</div>
                            <span>Rajshahi College Ground</span>
                        </div>
                    </li>
                    <li class="flex flex-col sm:flex-row items-center lg:items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar text-blue-500 text-sm"></i>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="font-medium text-blue-900">Event Date</div>
                            <span>January 3, 2026</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-blue-300/40 pt-6 text-center">
            <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between gap-4">
                <p class="text-sm text-blue-600">
                    © {{ date('Y') }} Statistics Alumni Association.
                </p>
                <div class="flex items-center gap-4 sm:gap-6 text-sm text-blue-600">
                    <a href="#" class="hover:text-blue-900 transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-blue-900 transition-colors duration-300">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>
