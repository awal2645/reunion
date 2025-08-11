@extends('layouts.app')
@section('content')

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Gradient Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/bg.jpeg') }}" alt="Rajshahi College Collage"
                class="w-full h-full object-cover object-center brightness-90" />
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/40 via-blue-800/30 to-blue-700/40"></div>
        </div>

        <!-- Three Logo Header -->
        <div class="absolute left-0 right-0 z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Rajshahi College Logo (Left) -->
                    <div class="flex items-center">
                        <img src="{{ asset('images/Rajshahi_College_Logo.svg') }}" alt="Rajshahi College Logo" 
                             class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
                    </div>
                    
                    <!-- Program Logo (Center) -->
                    <div class="flex items-center">
                        <img src="{{ asset('images/statistics-alumni-logo.png') }}" alt="Statistics Alumni Association Logo" 
                             class="w-32 h-32 sm:w-32 sm:h-32 object-contain">
                    </div>
                    
                    <!-- Association Logo (Right) -->
                    <div class="flex items-center">
                        <img src="{{ asset('images/assesion.png') }}" alt="Association Logo" 
                             class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
                    </div>
                </div>
            </div>
        </div>

        <!-- Foreground Content -->
        <div class="relative z-10 text-center text-white max-w-5xl mx-auto px-4" style="backdrop-filter: blur(1.2px);">
            <!-- Animated Glass Text Block -->
            <div class="fade-in py-8 mt-28">
                <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6 text-yellow-500">
                    <!-- Animated Letters -->
                    <span class="fade-letter" style="animation-delay: 0s;">D</span>
                    <span class="fade-letter" style="animation-delay: 0.1s;">E</span>
                    <span class="fade-letter" style="animation-delay: 0.2s;">P</span>
                    <span class="fade-letter" style="animation-delay: 0.3s;">A</span>
                    <span class="fade-letter" style="animation-delay: 0.4s;">R</span>
                    <span class="fade-letter" style="animation-delay: 0.5s;">T</span>
                    <span class="fade-letter" style="animation-delay: 0.6s;">M</span>
                    <span class="fade-letter" style="animation-delay: 0.7s;">E</span>
                    <span class="fade-letter" style="animation-delay: 0.8s;">N</span>
                    <span class="fade-letter" style="animation-delay: 0.9s;">T</span>
                    <span>&nbsp;</span>
                    <span class="fade-letter" style="animation-delay: 1.0s;">O</span>
                    <span class="fade-letter" style="animation-delay: 1.1s;">F</span>
                    <span>&nbsp;</span>
                    <span class="fade-letter" style="animation-delay: 1.2s;">S</span>
                    <span class="fade-letter" style="animation-delay: 1.3s;">T</span>
                    <span class="fade-letter" style="animation-delay: 1.4s;">A</span>
                    <span class="fade-letter" style="animation-delay: 1.5s;">T</span>
                    <span class="fade-letter" style="animation-delay: 1.6s;">I</span>
                    <span class="fade-letter" style="animation-delay: 1.7s;">S</span>
                    <span class="fade-letter" style="animation-delay: 1.8s;">T</span>
                    <span class="fade-letter" style="animation-delay: 1.9s;">I</span>
                    <span class="fade-letter" style="animation-delay: 2.0s;">C</span>
                    <span class="fade-letter" style="animation-delay: 2.1s;">S</span>
                </h1>

                <div
                    class="text-3xl font-bold text-white bg-gradient-to-r from-white to-white bg-clip-text text-transparent mb-4 tracking-wide">
                    Rajshahi College
                </div>

                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-8">
                    Reconnect, Reminisce, and Celebrate Our Journey Together
                </p>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                    <a href="/register"
                        class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 shadow-xl">
                        Register Now <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="/login"
                        class="border-2 border-white/80 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-700 transition-all duration-300">
                        Login Now <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Countdown Timer -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 mb-8 border border-white/20">
                    <h3 class="text-2xl font-bold text-white mb-6">Countdown to Reunion 2026</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Days -->
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 shadow-lg">
                                <div class="text-3xl md:text-4xl font-bold text-white" id="days">00</div>
                                <div class="text-sm text-blue-100 font-semibold">Days</div>
                            </div>
                        </div>
                        
                        <!-- Hours -->
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 shadow-lg">
                                <div class="text-3xl md:text-4xl font-bold text-white" id="hours">00</div>
                                <div class="text-sm text-green-100 font-semibold">Hours</div>
                            </div>
                        </div>
                        
                        <!-- Minutes -->
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-4 shadow-lg">
                                <div class="text-3xl md:text-4xl font-bold text-white" id="minutes">00</div>
                                <div class="text-sm text-yellow-100 font-semibold">Minutes</div>
                            </div>
                        </div>
                        
                        <!-- Seconds -->
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-4 shadow-lg">
                                <div class="text-3xl md:text-4xl font-bold text-white" id="seconds">00</div>
                                <div class="text-sm text-red-100 font-semibold">Seconds</div>
                            </div>
                        </div>
                    </div>
                    <p class="text-white/80 text-center mt-4 text-sm">3rd January 2026 • 8:00 AM</p>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="mt-10 animate-bounce text-blue-300 text-3xl text-end">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Countdown Timer JavaScript -->
    <script>
        // Set the date we're counting down to (December 16, 2025, 5:00 PM)
        const countDownDate = new Date("January 3, 2026 08:00:00").getTime();

        // Update the countdown every 1 second
        const x = setInterval(function() {
            // Get today's date and time
            const now = new Date().getTime();

            // Find the distance between now and the countdown date
            const distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the elements
            document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
            document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

            // If the countdown is finished, display a message
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
            }
        }, 1000);
    </script>


    <!-- About Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-white via-blue-50 to-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mb-6">About Our Reunion</h2>
                <p class="text-xl text-black max-w-3xl mx-auto leading-relaxed">
                    Join us for an unforgettable evening celebrating the bonds we've built and the memories we've
                    created together at Department of Statistics.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Step 1 -->
                <div class="flex items-center gap-4 p-6 rounded-2xl bg-blue-100 relative">
                  <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="Register" class="w-16 h-16 rounded-xl shadow" />
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">Register Online</h4>
                    <p class="text-gray-600 text-sm">Fill out the registration form to confirm your attendance.</p>
                  </div>
                  <span class="absolute top-2 right-4 text-5xl font-bold text-gray-300">01</span>
                </div>
          
                <!-- Step 2 -->
                <div class="flex items-center gap-4 p-6 rounded-2xl bg-yellow-100 relative">
                  <img src="https://cdn-icons-png.flaticon.com/512/2965/2965567.png" alt="Upload Memories" class="w-16 h-16 rounded-xl shadow" />
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">Share Your Memories</h4>
                    <p class="text-gray-600 text-sm">Upload photos, videos, or notes from your college days.</p>
                  </div>
                  <span class="absolute top-2 right-4 text-5xl font-bold text-gray-300">02</span>
                </div>
          
                <!-- Step 3 -->
                <div class="flex items-center gap-4 p-6 rounded-2xl bg-pink-100 relative">
                  <img src="https://cdn-icons-png.flaticon.com/512/869/869636.png" alt="Attend" class="w-16 h-16 rounded-xl shadow" />
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">Attend the Reunion</h4>
                    <p class="text-gray-600 text-sm">Join us at the venue for an unforgettable celebration.</p>
                  </div>
                  <span class="absolute top-2 right-4 text-5xl font-bold text-gray-300">03</span>
                </div>
          
                <!-- Step 4 -->
                <div class="flex items-center gap-4 p-6 rounded-2xl bg-green-100 relative">
                  <img src="https://cdn-icons-png.flaticon.com/512/3106/3106773.png" alt="Stay Connected" class="w-16 h-16 rounded-xl shadow" />
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">Stay Connected</h4>
                    <p class="text-gray-600 text-sm">Join our alumni group to stay in touch after the event.</p>
                  </div>
                  <span class="absolute top-2 right-4 text-5xl font-bold text-gray-300">04</span>
                </div>
              </div>
        </div>
    </section>

    <!-- Event Details -->
    <section id="details" class="py-20 bg-gradient-to-br from-blue-50 via-white to-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Header -->
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mb-4">Event Details</h2>
            <p class="text-xl text-blue-700">Mark your calendars for this special celebration</p>
          </div>
      
          <div class="grid md:grid-cols-2 gap-12 items-start">
            <!-- Left Info Grid -->
            <div class="space-y-8">
              <!-- Date -->
                              <div class="flex items-start gap-5 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-700 hover:shadow-xl transition">
                  <img src="https://cdn-icons-png.flaticon.com/512/747/747310.png" class="w-12 h-12" alt="Calendar Icon" />
                  <div>
                    <h3 class="text-xl font-bold text-blue-900 mb-1">Date</h3>
                    <p class="text-blue-700">Tuesday, January 3, 2026</p>
                  </div>
                </div>
      
              <!-- Time -->
              <div class="flex items-start gap-5 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-600 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/1827/1827504.png" class="w-12 h-12" alt="Clock Icon" />
                <div>
                  <h3 class="text-xl font-bold text-blue-900 mb-1">Time</h3>
                  <p class="text-blue-700">8:00 AM – 6:00 PM</p>
                </div>
              </div>
      
              <!-- Venue -->
              <div class="flex items-start gap-5 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="w-12 h-12" alt="Location Icon" />
                <div>
                  <h3 class="text-xl font-bold text-blue-900 mb-1">Venue</h3>
                  <p class="text-blue-700">Rajshahi College Ground<br>Rajshahi, Bangladesh</p>
                </div>
              </div>
      
              <!-- Dress Code -->
              <div class="flex items-start gap-5 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-700 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/892/892458.png" class="w-12 h-12" alt="Dress Code Icon" />
                <div>
                  <h3 class="text-xl font-bold text-blue-900 mb-1">Dress Code</h3>
                  <p class="text-blue-700">We are provide</p>
                </div>
              </div>
            </div>
      
            <!-- What's Included Box -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl p-8 shadow-lg border-t-4 border-blue-700 hover:shadow-xl transition">
              <h3 class="text-2xl font-bold text-blue-900 mb-6">What's Included</h3>
              <ul class="space-y-4 text-blue-700 text-base">
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Welcome cocktail reception
                </li>
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Three-course dinner
                </li>
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Open bar all evening
                </li>
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Live entertainment & DJ
                </li>
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Memory lane photo exhibition
                </li>
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Professional photography
                </li>
                <li class="flex items-center gap-3">
                  <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-6 h-6" alt="Check Icon" />
                  Commemorative gift
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      

    <!-- Schedule -->
    <section id="schedule" class="py-20 bg-gradient-to-br from-white via-blue-50 to-blue-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Section Header -->
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mb-4">Event Schedule</h2>
            <p class="text-xl text-blue-700">A perfectly planned evening of celebration and connection</p>
          </div>
      
          <!-- Timeline -->
          <div class="relative border-l-4 border-blue-200 space-y-10 pl-6">
            <!-- Timeline Item -->
            <div class="relative group bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
              <div class="absolute -left-[31px] top-6 w-5 h-5 rounded-full bg-blue-500 border-4 border-white shadow-md group-hover:scale-110 transition"></div>
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-blue-900">Registration & Welcome Drinks</h3>
                <span class="text-blue-600 font-semibold">5:00 PM</span>
              </div>
              <p class="text-gray-600 text-base">Check-in, receive your name tag and welcome packet, enjoy cocktails and light appetizers</p>
            </div>
      
            <div class="relative group bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
              <div class="absolute -left-[31px] top-6 w-5 h-5 rounded-full bg-blue-500 border-4 border-white shadow-md group-hover:scale-110 transition"></div>
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-blue-900">Opening Ceremony & Speeches</h3>
                <span class="text-blue-600 font-semibold">6:00 PM</span>
              </div>
              <p class="text-gray-600 text-base">Welcome address, department history highlights, and recognition of special achievements</p>
            </div>
      
            <div class="relative group bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
              <div class="absolute -left-[31px] top-6 w-5 h-5 rounded-full bg-blue-500 border-4 border-white shadow-md group-hover:scale-110 transition"></div>
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-blue-900">Dinner & Networking</h3>
                <span class="text-blue-600 font-semibold">7:00 PM</span>
              </div>
              <p class="text-gray-600 text-base">Three-course plated dinner with assigned seating to encourage mingling and conversation</p>
            </div>
      
            <div class="relative group bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
              <div class="absolute -left-[31px] top-6 w-5 h-5 rounded-full bg-blue-500 border-4 border-white shadow-md group-hover:scale-110 transition"></div>
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-blue-900">Memory Lane Presentation</h3>
                <span class="text-blue-600 font-semibold">8:30 PM</span>
              </div>
              <p class="text-gray-600 text-base">Photo slideshow, video messages from colleagues who couldn't attend, and shared memories</p>
            </div>
      
            <div class="relative group bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
              <div class="absolute -left-[31px] top-6 w-5 h-5 rounded-full bg-blue-500 border-4 border-white shadow-md group-hover:scale-110 transition"></div>
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-blue-900">Dancing & Entertainment</h3>
                <span class="text-blue-600 font-semibold">9:30 PM</span>
              </div>
              <p class="text-gray-600 text-base">Live band performance followed by DJ playing favorites from when we worked together</p>
            </div>
      
            <div class="relative group bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
              <div class="absolute -left-[31px] top-6 w-5 h-5 rounded-full bg-blue-500 border-4 border-white shadow-md group-hover:scale-110 transition"></div>
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-blue-900">Closing & Group Photos</h3>
                <span class="text-blue-600 font-semibold">11:00 PM</span>
              </div>
              <p class="text-gray-600 text-base">Final group photos, exchange contact information, and fond farewells until next time</p>
            </div>
          </div>
        </div>
      </section>
      

    <!-- Memories Gallery -->
    <section id="memories" class="py-20 bg-gradient-to-br from-white via-blue-50 to-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mb-4">Memory Lane</h2>
                <p class="text-xl text-blue-700">Relive the moments that made our time at Statistics special</p>
            </div>

            <!-- Image Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Repeat this block 8 times with different image seeds -->
                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory1/400" alt="Memory 1"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory2/400" alt="Memory 2"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory3/400" alt="Memory 3"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory4/400" alt="Memory 4"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory5/400" alt="Memory 5"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory6/400" alt="Memory 6"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory7/400" alt="Memory 7"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>

                <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md">
                    <img src="https://picsum.photos/seed/memory8/400" alt="Memory 8"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                </div>
            </div>


            <!-- CTA Button -->
            <div class="text-center mt-12">
                {{-- <button
                    class="bg-gradient-to-r from-blue-500 to-blue-400 text-white px-8 py-4 rounded-full font-semibold text-lg shadow hover:shadow-xl hover:scale-105 transition-all duration-300">
                    Share Your Photos <i class="fas fa-upload ml-2"></i>
                </button> --}}
            </div>
        </div>
    </section>

   



@endsection