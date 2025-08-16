@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 pt-32 md:px-32">
    @include('components.aside')
    <!-- Main Content -->
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-6xl mx-auto">
            <!-- Welcome Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        @if(Auth::user()->hasProfilePhoto())
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo"
                                 class="w-20 h-20 object-cover rounded-full border-4 border-white shadow-lg">
                        @else
                            <div class="w-20 h-20 bg-gray-300 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-1">Welcome back, {{ Auth::user()->full_name }}!</h1>
                            <p class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-graduation-cap text-blue-500"></i>
                                Batch Year: <span class="font-semibold text-blue-700">{{ Auth::user()->batch_year ?? 'Not specified' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Today</div>
                            <div class="text-lg font-semibold text-gray-900">{{ now()->format('l, F j, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-envelope text-blue-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-500 mb-1">Email Address</div>
                            <div class="font-semibold text-gray-900 break-all">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <i class="fas fa-phone text-green-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-500 mb-1">Contact Number</div>
                            <div class="font-semibold text-gray-900 break-all">{{ Auth::user()->contact_number ?? 'Not provided' }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-purple-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-500 mb-1">Location</div>
                            <div class="font-semibold text-gray-900 break-all">{{ Auth::user()->city_of_residence ?? 'Not specified' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            @if(!$order)
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white mb-2">Payment Information</h2>
                    <p class="text-blue-100">Complete your reunion registration</p>
                </div>
                
                <div class="p-8">
                    @php
                        $batchYear = Auth::user()->batch_year;
                        function getPaymentAmount($batchYear) {
                            $ranges = [
                                ['start' => '2018-2019', 'end' => '2024-2025', 'amount' => 1000],
                                ['start' => '2013-2014', 'end' => '2017-2018', 'amount' => 1500],
                                ['start' => null, 'end' => '2012-2013', 'amount' => 2000],
                            ];
                            foreach ($ranges as $range) {
                                if ($range['start'] && $range['end']) {
                                    if (strcmp($batchYear, $range['start']) >= 0 && strcmp($batchYear, $range['end']) <= 0) {
                                        return $range['amount'];
                                    }
                                } elseif ($range['end']) {
                                    if (strcmp($batchYear, $range['end']) <= 0) {
                                        return $range['amount'];
                                    }
                                }
                            }
                            return 2000; // fallback
                        }
                        $paymentAmount = getPaymentAmount($batchYear);
                    @endphp

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Payment Amount Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-blue-900">Your Registration Fee</h3>
                                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center">
                                    <i class="fas fa-tag text-white"></i>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-blue-700 mb-2">৳{{ number_format($paymentAmount) }}</div>
                            <div class="text-sm text-blue-600">
                                Based on your batch year: <span class="font-semibold">{{ $batchYear ?? 'Not specified' }}</span>
                            </div>
                        </div>

                        <!-- Payment Rules -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-info-circle text-blue-500"></i>
                                Payment Rules
                            </h3>
                            <div class="space-y-2 text-sm text-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span>2018-2019 to 2024-2025: <strong>৳1,000</strong></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span>2013-2014 to 2017-2018: <strong>৳1,500</strong></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span>2012-2013 and earlier: <strong>৳2,000</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Buttons -->
                    <div class="mt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('pay.now') }}"
                                class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold mb-2">Pay Now</h3>
                                        <p class="text-blue-100 text-sm">Pay your reunion registration fee</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                                        <i class="fas fa-credit-card text-white text-xl"></i>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('pay.guest') }}"
                                class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold mb-2">Pay with Guest</h3>
                                        <p class="text-green-100 text-sm">Pay for yourself and guests together</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                                        <i class="fas fa-users text-white text-xl"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Invoice -->
            @if(isset($pendingOrders) && $pendingOrders && $pendingOrders->count() > 0)
            <div class="mt-8">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-3">
                            <i class="fas fa-file-invoice-dollar"></i>
                            Payment Invoice 
                        </h2>
                        <p class="text-green-100">Aggregated pending orders</p>
                    </div>
                    <div class="p-8">
                        @php
                            $allGuests = [];
                            $totalAmount = 0;
                            $trxids = [];
                            foreach ($pendingOrders as $po) {
                                $totalAmount += (int)$po->amount;
                                $trxids[] = $po->trxid;
                                if (is_array($po->guest_details)) {
                                    foreach ($po->guest_details as $g) { $allGuests[] = $g; }
                                }
                            }
                            $chargeableGuests = collect($allGuests)->filter(function($g){ return isset($g['age']) && (int)$g['age'] > 5; })->count();
                        @endphp
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Name:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->full_name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Email:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Phone:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->contact_number ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">TRXIDs:</span>
                                    <span class="font-semibold text-blue-600">{{ implode(', ', $trxids) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Date Range:</span>
                                    <span class="font-semibold text-gray-900">{{ $pendingOrders->first()->created_at->format('d M Y, h:i A') }} — {{ $pendingOrders->last()->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                                <h3 class="text-lg font-semibold text-green-900 mb-4">Payment Summary</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Registration Fee:</span>
                                        <span class="font-semibold text-gray-900">৳{{ number_format($paymentAmount) }}</span>
                                    </div>
                                    <div class="text-xs text-green-700 flex items-center gap-2">
                                        <i class="fas fa-check-circle"></i>
                                        Base fee already paid earlier
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Guest Fees ({{ $chargeableGuests }}):</span>
                                        <span class="font-semibold text-gray-900">৳{{ number_format($totalAmount - $paymentAmount) }}</span>
                                    </div>
                                    <div class="border-t border-green-200 pt-3 mt-3">
                                        <div class="flex justify-between items-center text-lg font-bold">
                                            <span class="text-green-900">Total Pending:</span>
                                            <span class="text-green-700">৳{{ number_format($totalAmount) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($allGuests))
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-users text-blue-500"></i>
                                Guest Details ({{ count($allGuests) }})
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($allGuests as $guest)
                                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <div class="font-semibold text-gray-900">{{ $guest['name'] ?? 'N/A' }}</div>
                                    </div>
                                    <div class="space-y-1 text-sm text-gray-600">
                                        <div><span class="font-medium">Relation:</span> {{ $guest['relation'] ?? 'N/A' }}</div>
                                        <div><span class="font-medium">Age:</span> {{ $guest['age'] ?? 'N/A' }} years</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if($paymentStatus == 'Pending')
                        <div class="mt-8 text-center">
                            <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-lg bg-yellow-100 text-yellow-700 border border-yellow-200">
                                <i class="fas fa-clock"></i>
                                Payment Status: {{ $paymentStatus }} ({{ Auth::user()->unpaidOrdersCount() }} orders)
                            </span>
                        </div>
                        @else
                        <div class="mt-8 text-center">
                            <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-lg bg-green-100 text-green-700 border border-green-200">
                                <i class="fas fa-check-circle"></i>
                                Payment Status: {{ $paymentStatus }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @elseif(isset($order) && $order)
            <div class="mt-8">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-3">
                            <i class="fas fa-file-invoice-dollar"></i>
                            Payment Invoice
        </h2>
                        <p class="text-green-100">Invoice #{{ $order->id }}</p>
                    </div>
                    
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Invoice Details -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Name:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->full_name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Email:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Phone:</span>
                                    <span class="font-semibold text-gray-900">{{ Auth::user()->contact_number ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">TRXID:</span>
                                    <span class="font-semibold text-blue-600">{{ $order->trxid }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Date:</span>
                                    <span class="font-semibold text-gray-900">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                            </div>

                            <!-- Payment Summary -->
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                                <h3 class="text-lg font-semibold text-green-900 mb-4">Payment Summary</h3>
                                @php
                                    $guestDetails = is_array($order->guest_details) ? $order->guest_details : [];
                                    $chargeableGuests = collect($guestDetails)->filter(function($g){
                                        return isset($g['age']) && (int)$g['age'] > 5;
                                    })->count();
                                    $guestFees = $chargeableGuests * 1000;
                                    $baseComponent = max(0, (int)$order->amount - $guestFees);
                                    $baseIncluded = $baseComponent > 0;
                                @endphp
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Registration Fee:</span>
                                        <span class="font-semibold text-gray-900">৳{{ number_format($baseIncluded ? $baseComponent : 0) }}</span>
                                    </div>
                                    @if(!$baseIncluded)
                                        <div class="text-xs text-green-700 flex items-center gap-2">
                                            <i class="fas fa-check-circle"></i>
                                            Base fee already paid earlier
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Guest Fees ({{ $chargeableGuests }}):</span>
                                        <span class="font-semibold text-gray-900">৳{{ number_format($guestFees) }}</span>
                                    </div>
                                    <div class="border-t border-green-200 pt-3 mt-3">
                                        <div class="flex justify-between items-center text-lg font-bold">
                                            <span class="text-green-900">Total Paid:</span>
                                            <span class="text-green-700">৳{{ number_format($order->amount) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Guest Details -->
                        @if($order->guest_details && is_array($order->guest_details) && count($order->guest_details))
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-users text-blue-500"></i>
                                Guest Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($order->guest_details as $guest)
                                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <div class="font-semibold text-gray-900">{{ $guest['name'] ?? 'N/A' }}</div>
                                    </div>
                                    <div class="space-y-1 text-sm text-gray-600">
                                        <div><span class="font-medium">Relation:</span> {{ $guest['relation'] ?? 'N/A' }}</div>
                                        <div><span class="font-medium">Age:</span> {{ $guest['age'] ?? 'N/A' }} years</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Payment Status -->
                        <div class="mt-8 text-center">
                            <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-lg
                                @if($order->status === 'paid') 
                                    bg-green-100 text-green-700 border border-green-200
                                @else 
                                    bg-yellow-100 text-yellow-700 border border-yellow-200
                                @endif">
                                <i class="fas @if($order->status === 'paid') fa-check-circle @else fa-clock @endif"></i>
                                Payment Status: {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>
    </div>
@endsection