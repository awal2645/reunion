<!-- Sidebar -->
@php
    $user = Auth::user();
    $hasOrder = $user->orders()->exists();
    $hasPaidBase = method_exists($user, 'hasPaidBaseRegistration') ? $user->hasPaidBaseRegistration() : $user->orders()->where('status', 'paid')->exists();
@endphp
<aside class="w-72 bg-white border-r border-gray-100 flex flex-col py-8 px-6 min-h-screen shadow-md hidden lg:flex">
    <div class="flex flex-col items-center mb-10">
        <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-3xl text-blue-600 mb-4 shadow-lg">
            @if(Auth::user()->photo_path)
                <img src="{{ asset('storage/' . Auth::user()->photo_path) }}" alt="Profile Photo" class="w-20 h-20 object-cover rounded-full border-4 border-white shadow-lg">
            @else
                <i class="fas fa-user"></i>
            @endif
        </div>
        <div class="text-center">
            <div class="text-lg font-bold text-gray-900 mb-1">{{ Auth::user()->full_name }}</div>
            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>
    </div>
    <nav class="flex-1">
        <ul class="space-y-2">
            @if(Auth::user()->role == 'admin')
                <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('admin.dashboard')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-th-large w-5"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('admin.orders')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-list w-5"></i> Orders</a></li>
                <li><a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('admin.users')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-users w-5"></i> Users</a></li>
                @else
            <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('dashboard')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-th-large w-5"></i> Dashboard</a></li>
                @if(!$hasOrder)
                    <li><a href="{{ route('pay.now') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('pay.now')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-credit-card w-5"></i> Pay Now</a></li>
                    <li><a href="{{ route('pay.guest') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('pay.guest')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-users w-5"></i> Pay with Guest</a></li>
                @else
                    <li><a href="{{ route('pay.for.guest') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('pay.for.guest')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-credit-card w-5"></i> Pay for Guest</a></li>
                @endif
            <li><a href="{{ route('transaction.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('transaction.history')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-history w-5"></i> Transaction History</a></li>
            @endif
            {{-- logout  --}}
            <li class="mt-6"> 
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-red-50 hover:text-red-700 transition-all duration-200 text-sm w-full text-left"  @if(request()->routeIs('logout')) style="background-color: #fef2f2; color: #dc2626;" @endif><i class="fas fa-sign-out-alt w-5"></i> Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>

<!-- Mobile Menu Button -->
<div class="lg:hidden fixed top-6 right-6 z-50">
    <button id="mobile-menu-btn" class="bg-white p-3 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-200">
        <i class="fas fa-bars text-gray-700 text-lg"></i>
    </button>
</div>

<!-- Mobile Sidebar Overlay -->
<div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

<!-- Mobile Sidebar -->
<div id="mobile-sidebar" class="lg:hidden fixed top-0 right-0 h-full w-80 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Mobile Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-2xl text-blue-600">
                    @if(Auth::user()->photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->photo_path) }}" alt="Profile Photo" class="w-14 h-14 object-cover rounded-full">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
                <div>
                    <div class="font-semibold text-gray-900">{{ Auth::user()->full_name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <button id="mobile-close-btn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i class="fas fa-times text-gray-600 text-lg"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav class="flex-1 p-6">
            <ul class="space-y-3">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('admin.dashboard')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-th-large w-5"></i> Dashboard</a></li>
                    <li><a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('admin.orders')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-list w-5"></i> Orders</a></li>
                @else
                <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('dashboard')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-th-large w-5"></i> Dashboard</a></li>
                @if(!$hasOrder)
                    @if(!$hasPaidBase)
                        <li><a href="{{ route('pay.now') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('pay.now')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-credit-card w-5"></i> Pay Now</a></li>
                        <li><a href="{{ route('pay.guest') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('pay.guest')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-users w-5"></i> Pay with Guest</a></li>
                    @else
                        <li><a href="{{ route('pay.for.guest') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('pay.for.guest')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-credit-card w-5"></i> Pay for Guest</a></li>
                    @endif
                @endif
                <li><a href="{{ route('transaction.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 text-sm"  @if(request()->routeIs('transaction.history')) style="background-color: #e0e7ff; color: #1e40af;" @endif><i class="fas fa-history w-5"></i> Transaction History</a></li>
                @endif
                {{-- logout  --}}
                <li class="mt-6"> 
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-red-50 hover:text-red-700 transition-all duration-200 text-sm w-full text-left"  @if(request()->routeIs('logout')) style="background-color: #fef2f2; color: #dc2626;" @endif><i class="fas fa-sign-out-alt w-5"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileCloseBtn = document.getElementById('mobile-close-btn');

    function openMobileMenu() {
        mobileSidebar.classList.remove('translate-x-full');
        mobileOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileSidebar.classList.add('translate-x-full');
        mobileOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    mobileMenuBtn.addEventListener('click', openMobileMenu);
    mobileCloseBtn.addEventListener('click', closeMobileMenu);
    mobileOverlay.addEventListener('click', closeMobileMenu);

    // Close menu when clicking on a link
    const mobileLinks = mobileSidebar.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
});
</script>