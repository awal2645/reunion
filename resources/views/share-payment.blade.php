@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 pt-32 md:px-32">
    @include('components.aside')
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white text-3xl shadow-lg">
                <i class="fas fa-download"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Download Payment Banner</h1>
            <p class="text-gray-600 text-lg">Share this banner to motivate others! 🎉</p>
        </div>

        <!-- Banner Preview -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 mb-8 overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Your Payment Banner</h3>
                
                <!-- Banner Image -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-8 text-center mb-6 border border-green-100">
                    <div class="w-[500px] h-[500px] mx-auto bg-white rounded-2xl shadow-2xl border-2 border-gray-200 flex flex-col items-center justify-center relative overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        
                     
                        
                        <!-- Main Title -->
                        <div class="text-center mb-6 ">
                            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                                <span class="text-gray-800">PAYMENT</span>
                                <span class="text-green-600">CONFIRMED</span>
                            </h1>
                        </div>
                        
                        <!-- Central User Info Circle -->
                        <div class="relative mb-6">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-green-500 to-blue-500 p-1">
                                <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
                                    <div class="text-center">
                                           @if($user->hasProfilePhoto())
                                               <img src="{{ $user->profile_photo_url }}" alt="Profile Photo" class="w-20 h-20 object-cover rounded-full">
                                           @else
                                               <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center">
                                                   <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                   </svg>
                                               </div>
                                           @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Main Message -->
                        <div class="text-center mb-6">
                            <div class="bg-gradient-to-r from-green-50 to-blue-50 border-2 border-green-200 rounded-xl p-4 shadow-sm max-w-sm">
                                <p class="text-green-700 font-bold text-xl">আমি পেমেন্ট করেছি, আপনি করছেন তো? 🎉</p>
                            </div>
                        </div>
                        
                    
                        
                        <!-- Bottom Section -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-green-500 to-blue-500 text-white p-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-check text-lg"></i>
                                    <span class="text-sm font-semibold">Event Date: 3rd January 2026</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                    <span class="text-sm font-semibold">Rajshahi College</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Elements -->
                        <div class="absolute top-20 right-8 w-16 h-16 bg-green-200 rounded-full opacity-30"></div>
                        <div class="absolute bottom-32 left-8 w-12 h-12 bg-blue-200 rounded-full opacity-30"></div>
                        <div class="absolute top-40 left-12 w-8 h-8 bg-green-300 rounded-full opacity-40"></div>
                    </div>
                </div>

                <!-- Download Button -->
                <div class="text-center">
                    <button onclick="downloadBanner()" 
                            class="inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold text-xl rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-offset-2 border-2 border-green-500">
                        <i class="fas fa-download mr-3 text-2xl"></i>
                        Download Banner
                    </button>
                    
                    <!-- Download Info -->
                                            <p class="text-sm text-gray-500 mt-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            Ultra HD PNG (1600x1600) will be downloaded
                        </p>
                </div>
            </div>
        </div>


        <!-- Motivational Section -->
        <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-2xl p-8 text-center border-2 border-blue-200 shadow-xl relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-blue-200 rounded-full -translate-x-16 -translate-y-16 opacity-20"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-green-200 rounded-full translate-x-12 translate-y-12 opacity-20"></div>
            
            <div class="relative z-10">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500 to-green-500 flex items-center justify-center text-white text-3xl shadow-lg">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Motivate Your Batch Mates! 🚀</h3>
                <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                    Download this beautiful banner and share it on social media to encourage others to join the reunion. 
                    <span class="font-semibold text-blue-600">Let's make this the biggest gathering ever!</span>
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                    <div class="flex flex-col items-center space-y-2 p-4 bg-white/50 rounded-xl border border-blue-100">
                        <i class="fas fa-download text-2xl text-green-500"></i>
                        <span class="font-medium text-gray-700">Easy Download</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2 p-4 bg-white/50 rounded-xl border border-blue-100">
                        <i class="fas fa-share-alt text-2xl text-blue-500"></i>
                        <span class="font-medium text-gray-700">Social Ready</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2 p-4 bg-white/50 rounded-xl border border-blue-100">
                        <i class="fas fa-heart text-2xl text-red-500"></i>
                        <span class="font-medium text-gray-700">Motivate Others</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function downloadBanner() {
    // Create a canvas element to generate the banner
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    
    // Set canvas size to high-resolution square format
    canvas.width = 1600;
    canvas.height = 1300;
    
    // Scale context for high resolution
    ctx.scale(2, 2);
    
    // Enable high-quality rendering
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';
    
    // Background - white
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, 800, 800);
    
    // Add decorative circles matching the preview exactly
    ctx.fillStyle = 'rgba(34, 197, 94, 0.3)';
    ctx.beginPath();
    ctx.arc(650, 160, 64, 0, 2 * Math.PI);
    ctx.fill();
    
    ctx.fillStyle = 'rgba(59, 130, 246, 0.3)';
    ctx.beginPath();
    ctx.arc(96, 320, 48, 0, 2 * Math.PI);
    ctx.fill();
    
    ctx.fillStyle = 'rgba(34, 197, 94, 0.4)';
    ctx.beginPath();
    ctx.arc(96, 480, 32, 0, 2 * Math.PI);
    ctx.fill();
    
    // Main Title
    ctx.fillStyle = '#1f2937';
    ctx.font = 'bold 48px "Segoe UI", Arial, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('PAYMENT', 400, 200);
    
    ctx.fillStyle = '#22c55e';
    ctx.fillText('CONFIRMED', 400, 260);
    
    // Central User Info Circle with Profile Photo
    const centerX = 400;
    const centerY = 350;
    const circleRadius = 80;
    
    // Outer circle with gradient effect (green to blue)
    const gradient = ctx.createLinearGradient(centerX - circleRadius, centerY - circleRadius, centerX + circleRadius, centerY + circleRadius);
    gradient.addColorStop(0, '#22c55e');
    gradient.addColorStop(1, '#3b82f6');
    ctx.fillStyle = gradient;
    ctx.beginPath();
    ctx.arc(centerX, centerY, circleRadius, 0, 2 * Math.PI);
    ctx.fill();
    
    // Inner white circle
    ctx.fillStyle = '#ffffff';
    ctx.beginPath();
    ctx.arc(centerX, centerY, circleRadius - 8, 0, 2 * Math.PI);
    ctx.fill();
    
    // Load and draw user's profile photo
    const profilePhoto = new Image();
    profilePhoto.crossOrigin = 'anonymous';
    
    profilePhoto.onload = function() {
        // Create circular clipping for the photo
        ctx.save();
        ctx.beginPath();
        ctx.arc(centerX, centerY, circleRadius - 12, 0, 2 * Math.PI);
        ctx.clip();
        
        // Calculate photo dimensions to fit the circle
        const photoSize = (circleRadius - 12) * 2;
        const photoX = centerX - photoSize / 2;
        const photoY = centerY - photoSize / 2;
        
        // Draw the profile photo
        ctx.drawImage(profilePhoto, photoX, photoY, photoSize, photoSize);
        ctx.restore();
        
        // Continue with the rest of the banner
        completeBanner();
    };
    
    profilePhoto.onerror = function() {
        // Fallback to initials if photo fails to load
        ctx.fillStyle = '#22c55e';
        ctx.font = 'bold 24px "Segoe UI", Arial, sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('{{ substr($user->full_name, 0, 1) }}', centerX, centerY - 5);
        
        ctx.fillStyle = '#3b82f6';
        ctx.font = 'bold 16px "Segoe UI", Arial, sans-serif';
        ctx.fillText('USER', centerX, centerY + 15);
        
        // Continue with the rest of the banner
        completeBanner();
    };
    
    // Set the profile photo source
    @if($user->hasProfilePhoto())
        profilePhoto.src = '{{ $user->profile_photo_url }}';
    @else
        profilePhoto.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik01MCAyNUMyOC4wNzA5IDI1IDEwIDQzLjA3MDkgMTAgNjVDMTAgODYuOTI5MSAyOC4wNzA5IDEwNSA1MCAxMDVDNzEuOTI5MSAxMDUgOTAgODYuOTI5MSA5MCA2NUM5MCA0My4wNzA5IDcxLjkyOTEgMjUgNTAgMjVaIiBmaWxsPSIjN0MzQTU5Ii8+Cjwvc3ZnPgo=';
    @endif
    
    function completeBanner() {
        // Main Message with gradient background
        const message = 'আমি পেমেন্ট করেছি, আপনি করছেন তো? 🎉';
        const messageWidth = ctx.measureText(message).width;
        
        // Message text
        ctx.fillStyle = '#15803d';
        ctx.font = 'bold 28px "Segoe UI", Arial, sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(message, centerX, 520);
        
        // Bottom Section with gradient
        const bottomGradient = ctx.createLinearGradient(0, 600, 800, 600);
        bottomGradient.addColorStop(0, '#22c55e');
        bottomGradient.addColorStop(1, '#3b82f6');
        ctx.fillStyle = bottomGradient;
        ctx.fillRect(0, 600, 800, 70);
        
        // Bottom text with icons
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 16px "Segoe UI", Arial, sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText('Event Date: 3rd January 2026', 60, 635);
        
        ctx.textAlign = 'right';
        ctx.fillText('Rajshahi College', 740, 635);
        
        // Convert to blob and download
        canvas.toBlob(function(blob) {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'payment-banner-{{ $user->full_name }}.png';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            // Show success message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Banner downloaded successfully!',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        });
    }
}
</script>
@endsection
