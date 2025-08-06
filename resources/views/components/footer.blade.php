 <!-- Footer -->
 <footer class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 text-blue-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2  items-start" style="gap: 38rem;">

            <!-- Logo & Description -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                   <img src="{{ asset('images/statistics-alumni-logo.png') }}" alt="Statistics Alumni Association Logo"
                        class="w-40 h-32 object-contain">
                </div>
                <p class="text-blue-700 max-w-md leading-relaxed mb-6">
                    A heartfelt gathering to honor our shared legacy and lifelong connections.
                </p>
                <div class="flex space-x-3">
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white hover:bg-blue-100 flex items-center justify-center transition">
                        <i class="fab fa-facebook-f text-blue-800 text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white hover:bg-blue-100 flex items-center justify-center transition">
                        <i class="fab fa-linkedin-in text-blue-800 text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white hover:bg-blue-100 flex items-center justify-center transition">
                        <i class="fab fa-twitter text-blue-800 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-blue-900">Contact</h3>
                <ul class="space-y-3 text-blue-700 text-sm">
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-blue-500"></i>
                        <span>reunion@Statistics.com</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-blue-500"></i>
                        <span>(555) 123-4567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt text-blue-500"></i>
                        <span>Downtown Convention Center</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-blue-300/40 mt-12 pt-6 text-sm text-blue-600 text-center">
            <p> {{ date('Y') }} Statistics Alumni Association </p>
        </div>
    </div>
</footer>
