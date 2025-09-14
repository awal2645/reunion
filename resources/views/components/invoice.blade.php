@if(isset($pendingOrders) && $pendingOrders && $pendingOrders->count() > 0)
<div class="mt-8">
    <!-- E-Ticket/Invoice Container -->
    <div class="bg-white rounded-lg shadow-xl border border-gray-200 max-w-3xl mx-auto overflow-hidden"
        style="background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)">

        <!-- Header Section with Logos -->
        <div class=" px-6 py-4 border-b border-gray-100"
            style="background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)">
            <div class="flex justify-between items-start">
                <!-- Left Logo - Geography & Environment Reunion -->
                <div class="flex items-center space-x-4">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center">
                        <img src="{{ asset('images/statistics-alumni-logo.png') }}" alt="Logo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="text-green-700">
                        <h1 class="text-base font-bold">Department of Statistics Reunion - 2026</h1>
                        <p class="text-xs text-gray-600">Rajshahi College</p>
                    </div>
                </div>

                <!-- Right Section - College Logo and Barcode -->
                <div class="text-center">
                    <!-- Profile Picture -->
                    @if(Auth::user()->photo_path)
                    <div class="w-12 h-16 rounded border border-gray-300 overflow-hidden">
                        <img src="{{ Storage::url(Auth::user()->photo_path) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-12 h-16 bg-gray-200 rounded border border-gray-300 flex items-center justify-center">
                        <i class="fas fa-user text-gray-500 text-lg"></i>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200"
            style="background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-black text-gray-900">INVOICE</h2>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Invoice Number</div>
                    <div class="font-bold text-lg text-blue-600">INV-{{ date('Y') }}-{{
                        str_pad($pendingOrders->first()?->id ?? '0001', 4, '0', STR_PAD_LEFT) }}</div>
                    <div class="text-sm text-gray-600 mt-1">Date Issued: {{ now()->format('F d, Y') }}</div>
                </div>
            </div>
        </div>
        <!-- Participant Information -->
        <div class="px-8 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900 mb-3">Bill To</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between border-b border-gray-100 pb-1">
                            <span class="text-gray-600">Name</span>
                            <span class="font-medium text-gray-900">{{ Auth::user()->full_name }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-1">
                            <span class="text-gray-600">Session</span>
                            <span class="text-gray-900">{{ Auth::user()->session ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-1">
                            <span class="text-gray-600">Occupation</span>
                            <span class="text-gray-900">{{ Auth::user()->occupation ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-900 mb-3">Contact</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between border-b border-gray-100 pb-1">
                            <span class="text-gray-600">Phone</span>
                            <span class="text-gray-900">{{ Auth::user()->contact_number ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-1">
                            <span class="text-gray-600">Blood Group</span>
                            <span class="text-gray-900">{{ Auth::user()->blood_group ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-1">
                            <span class="text-gray-600">Email</span>
                            <span class="text-gray-900">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description of Participation Table -->
        <div class="px-6 py-3">
            <h3 class="text-base font-bold text-gray-800 mb-3">Description of Participation</h3>
            <div class=" border border-gray-300 rounded overflow-hidden"
                style="background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)">
                <table class="w-full">
                    <thead class="" linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)>
                        <tr class="border-b border-gray-300">
                            <th
                                class="px-3 py-2 text-left font-semibold text-gray-700 border-r border-gray-300 text-sm">
                                Participation Category</th>
                            <th
                                class="px-3 py-2 text-center font-semibold text-gray-700 border-r border-gray-300 text-sm">
                                Qnty</th>
                            <th
                                class="px-3 py-2 text-center font-semibold text-gray-700 border-r border-gray-300 text-sm">
                                Unit Price (BDT)</th>
                            <th class="px-3 py-2 text-center font-semibold text-gray-700 text-sm">Total (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $allGuests = [];
                        $totalAmount = 0;
                        foreach ($pendingOrders as $po) {
                        $totalAmount += (int)$po->amount;
                        if (is_array($po->guest_details)) {
                        foreach ($po->guest_details as $g) { $allGuests[] = $g; }
                        }
                        }
                        $chargeableGuests = collect($allGuests)->filter(function($g){ return isset($g['age']) &&
                        (int)$g['age'] > 5; })->count();

                        // Calculate guest fees from existing order data
                        $guestUnitPrice = 1000; // Guest fee per person
                        $guestQuantity = $chargeableGuests;
                        $guestTotal = $guestQuantity * $guestUnitPrice;

                        // Calculate user paid amount = total amount - guest fees
                        $userPaidAmount = max(0, $totalAmount - $guestTotal);

                        // Show what the user actually paid
                        if ($userPaidAmount > 0) {
                        $singleQuantity = 1;
                        $singleTotal = $userPaidAmount;
                        } else {
                        $singleQuantity = 0;
                        $singleTotal = 0;
                        }

                        $calculatedTotal = $singleTotal + $guestTotal;
                        @endphp
                        @if($singleQuantity > 0)
                        <tr class="border-b border-gray-200">
                            <td class="px-3 py-2 font-medium text-gray-800 border-r border-gray-300 text-sm">Your </td>
                            <td class="px-3 py-2 text-center border-r border-gray-300 text-sm">{{ $singleQuantity }}
                            </td>
                            <td class="px-3 py-2 text-center border-r border-gray-300 text-sm">{{
                                number_format($singleTotal / max(1, $singleQuantity)) }}</td>
                            <td class="px-3 py-2 text-center font-semibold text-sm">{{ number_format($singleTotal) }}
                            </td>
                        </tr>
                        @endif
                        @if($guestQuantity > 0)
                        <tr class="border-b border-gray-200">
                            <td class="px-3 py-2 font-medium text-gray-800 border-r border-gray-300 text-sm">Guest</td>
                            <td class="px-3 py-2 text-center border-r border-gray-300 text-sm">{{ $guestQuantity }}</td>
                            <td class="px-3 py-2 text-center border-r border-gray-300 text-sm">{{
                                number_format($guestUnitPrice) }}</td>
                            <td class="px-3 py-2 text-center font-semibold text-sm">{{ number_format($guestTotal) }}
                            </td>
                        </tr>
                        @endif
                        <tr class="bg-green-50 border-t-2 border-green-300">
                            <td colspan="3"
                                class="px-3 py-2 font-bold text-right text-gray-800 border-r border-gray-300 text-sm">
                                Total Amount:</td>
                            <td class="px-3 py-2 text-center font-bold text-green-700 text-base">{{
                                number_format($calculatedTotal) }} BDT</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- T-Shirt Information -->
        @if(Auth::user()->tshirt_size)
        <div class="px-6 py-3 bg-blue-50 border-y border-blue-200">
            <div class="flex items-center space-x-4">
                <span class="font-bold text-gray-800">T-SHIRT:</span>
                <span class="bg-white px-3 py-1 rounded border border-blue-300 font-semibold">{{
                    Auth::user()->tshirt_size }}</span>
                <span class="text-sm text-gray-600">
                    @if(Auth::user()->tshirt_size == 'S') Chest 36-38 inches
                    @elseif(Auth::user()->tshirt_size == 'M') Chest 38-40 inches
                    @elseif(Auth::user()->tshirt_size == 'L') Chest 40-42 inches
                    @elseif(Auth::user()->tshirt_size == 'XL') Chest 42-44 inches
                    @elseif(Auth::user()->tshirt_size == 'XXL') Chest 44-46 inches
                    @else Chest 40-42 inches
                    @endif
                </span>
            </div>
        </div>
        @endif

        <!-- Event Details and QR Code -->
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h3 class="text-sm font-bold text-gray-800 mb-2">Event Details</h3>
                    <div class="space-y-1">
                        <div class="flex justify-between text-xs">
                            <span class="font-medium text-gray-600">Event Name:</span>
                            <span class="text-gray-800">Department of Statistics, Reunion 2026</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="font-medium text-gray-600">Location:</span>
                            <span class="text-gray-800">Rajshahi College, Rajshahi</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="font-medium text-gray-600">Event Date:</span>
                            <span class="text-gray-800">3 January 2026</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="font-medium text-gray-600">Emergency Contact:</span>
                            <a href="tel:+8801577281779" class="text-gray-800">+8801577281779</a>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="font-medium text-gray-600">Registration Date:</span>
                            <span class="text-gray-800">{{ Auth::user()->created_at ?
                                Auth::user()->created_at->format('d M Y') : 'N/A' }}</span>
                        </div>
                        @if(Auth::user()->accompanying_guests > 0)
                        <div class="flex justify-between text-xs">
                            <span class="font-medium text-gray-600">Total Guests:</span>
                            <span class="text-gray-800">{{ Auth::user()->accompanying_guests }} people</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-white rounded border border-gray-300 flex items-center justify-center mx-auto p-1">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=https://rcstatreunion.com/dashboard" 
                             alt="QR Code" 
                             class="w-full h-full object-contain">
                    </div>
                    <p class="text-xs text-gray-600 mt-1">QR Code</p>
                </div>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="px-6 py-3 bg-yellow-50 border-t border-yellow-200">
            <h3 class="text-base font-bold text-gray-800 mb-2">Terms & Conditions</h3>
            <div class="text-xs text-gray-700 space-y-0.5">
                <div>1. E-ticket must be shown upon entry.</div>
                <div>2. You must portage a photo ID during the event going on.</div>
                <div>3. This ticket is non-transferable and valid only for the registered participant.</div>
                <div>4. Once registered, the registration fee is non-refundable.</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3">
            <div class="text-center">
                <div class="text-base font-bold mb-1">Department of Statistics Reunion- 2026</div>
                <div class="text-xs opacity-90">Rajshahi College, Rajshahi- 6100, Emergency Contact: +8801577281779</div>
                <div class="text-xs opacity-90 mt-1">https://rcstatreunion.com/</div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="px-6 py-3 text-center bg-gray-50">
            @if($paymentStatus == 'Pending')
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-semibold text-base bg-yellow-100 text-yellow-700 border border-yellow-300">
                <i class="fas fa-clock"></i>
                Payment Status: {{ $paymentStatus }} ({{ Auth::user()->unpaidOrdersCount() ?? 0 }} orders)
            </span>
            @else
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-semibold text-base bg-green-100 text-green-700 border border-green-300">
                <i class="fas fa-check-circle"></i>
                Payment Status: {{ $paymentStatus }}
            </span>
            @endif
        </div>
    </div>
</div>

@elseif(isset($order) && $order)
<div class="mt-8">
    <!-- E-Ticket/Invoice Container -->
    <div class=" rounded-lg shadow-xl border border-gray-200 max-w-3xl mx-auto overflow-hidden"
        style="background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)">

        <!-- Header Section with Logos -->
        <div class="px-6 py-4 border-b border-gray-100"
            style="background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%)">
            <div class="flex justify-between items-start">
                <!-- Left Logo - Geography & Environment Reunion -->
                <div class="flex items-center space-x-4">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center">
                        <img src="{{ asset('images/statistics-alumni-logo.png') }}" alt="Logo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="text-green-700">
                        <h1 class="text-base font-bold">Department of Statistics Reunion - 2026</h1>
                        <p class="text-xs text-gray-600">Rajshahi College</p>
                    </div>
                </div>

                <!-- Right Section - College Logo and Barcode -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center mb-2">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div class="bg-black text-white px-3 py-1 text-xs font-mono mb-2">
                        {{ $order->trxid }}
                    </div>
                    <!-- Profile Picture -->
                    @if(Auth::user()->photo_path)
                    <div class="w-12 h-16 rounded border border-gray-300 overflow-hidden">
                        <img src="{{ Storage::url(Auth::user()->photo_path) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-12 h-16 bg-gray-200 rounded border border-gray-300 flex items-center justify-center">
                        <i class="fas fa-user text-gray-500 text-lg"></i>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-black text-gray-900">INVOICE</h2>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Invoice Number</div>
                    <div class="font-bold text-lg text-blue-600">INV-{{ date('Y') }}-{{ str_pad($order->id, 4, '0',
                        STR_PAD_LEFT) }}</div>
                    <div class="text-sm text-gray-600 mt-1">Date Issued: {{ $order->created_at ?
                        $order->created_at->format('F d, Y') : 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Participant Information -->
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <div class="flex justify-between py-1 border-b border-gray-200 text-xs">
                        <span class="font-medium text-gray-600">Name:</span>
                        <span class="text-gray-800 font-medium">{{ Auth::user()->full_name }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-200 text-xs">
                        <span class="font-medium text-gray-600">Session:</span>
                        <span class="text-gray-800">{{ Auth::user()->session ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-200 text-xs">
                        <span class="font-medium text-gray-600">Occupation:</span>
                        <span class="text-gray-800">{{ Auth::user()->occupation ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <div class="flex justify-between py-1 border-b border-gray-200 text-xs">
                        <span class="font-medium text-gray-600">Contact:</span>
                        <span class="text-gray-800">{{ Auth::user()->contact_number ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-200 text-xs">
                        <span class="font-medium text-gray-600">Blood Group:</span>
                        <span class="text-gray-800">{{ Auth::user()->blood_group ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-200 text-xs">
                        <span class="font-medium text-gray-600">Email:</span>
                        <span class="text-gray-800">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description of Participation Table -->
        <div class="px-6 py-3">
            <h3 class="text-base font-bold text-gray-800 mb-3">Description of Participation</h3>
            <div class="bg-white border border-gray-300 rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100" st>
                        <tr class="border-b border-gray-300">
                            <th
                                class="px-3 py-2 text-left font-semibold text-gray-700 border-r border-gray-300 text-sm">
                                Participation Category</th>
                            <th
                                class="px-3 py-2 text-center font-semibold text-gray-700 border-r border-gray-300 text-sm">
                                Qnty</th>
                            <th
                                class="px-3 py-2 text-center font-semibold text-gray-700 border-r border-gray-300 text-sm">
                                Unit Price (BDT)</th>
                            <th class="px-3 py-2 text-center font-semibold text-gray-700 text-sm">Total (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $guestDetails = is_array($order->guest_details) ? $order->guest_details : [];
                        $chargeableGuests = collect($guestDetails)->filter(function($g){
                        return isset($g['age']) && (int)$g['age'] > 1;
                        })->count();

                        // Calculate guest fees from existing order data
                        $guestUnitPrice = 1000; // Guest fee per person
                        $guestQuantity = $chargeableGuests;
                        $guestTotal = $guestQuantity * $guestUnitPrice;

                        // Calculate user paid amount = total amount - guest fees
                        $userPaidAmount = max(0, (int)$order->amount - $guestTotal);

                        // Show what the user actually paid
                        if ($userPaidAmount > 0) {
                        $singleQuantity = 1;
                        $singleTotal = $userPaidAmount;
                        } else {
                        $singleQuantity = 0;
                        $singleTotal = 0;
                        }

                        $calculatedTotal = $singleTotal + $guestTotal;
                        @endphp
                        @if($singleQuantity > 0)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3 font-medium text-gray-800 border-r border-gray-300">SINGLE</td>
                            <td class="px-4 py-3 text-center border-r border-gray-300">{{ $singleQuantity }}</td>
                            <td class="px-4 py-3 text-center border-r border-gray-300">{{ number_format($singleTotal /
                                max(1, $singleQuantity)) }}</td>
                            <td class="px-4 py-3 text-center font-semibold">{{ number_format($singleTotal) }}</td>
                        </tr>
                        @endif
                        @if($guestQuantity > 0)
                        <tr class="border-b border-gray-200">
                            <td class="px-3 py-2 font-medium text-gray-800 border-r border-gray-300 text-sm">Guest</td>
                            <td class="px-3 py-2 text-center border-r border-gray-300 text-sm">{{ $guestQuantity }}</td>
                            <td class="px-3 py-2 text-center border-r border-gray-300 text-sm">{{
                                number_format($guestUnitPrice) }}</td>
                            <td class="px-3 py-2 text-center font-semibold text-sm">{{ number_format($guestTotal) }}
                            </td>
                        </tr>
                        @endif
                        <tr class="bg-green-50 border-t-2 border-green-300">
                            <td colspan="3"
                                class="px-3 py-2 font-bold text-right text-gray-800 border-r border-gray-300 text-sm">
                                Total Amount:</td>
                            <td class="px-3 py-2 text-center font-bold text-green-700 text-base">{{
                                number_format($calculatedTotal) }} BDT</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- T-Shirt Information -->
        @if(Auth::user()->tshirt_size)
        <div class="px-6 py-3 bg-blue-50 border-y border-blue-200">
            <div class="flex items-center space-x-4">
                <span class="font-bold text-gray-800">T-SHIRT:</span>
                <span class="bg-white px-3 py-1 rounded border border-blue-300 font-semibold">{{
                    Auth::user()->tshirt_size }}</span>
                <span class="text-sm text-gray-600">
                    @if(Auth::user()->tshirt_size == 'S') Chest 36-38 inches
                    @elseif(Auth::user()->tshirt_size == 'M') Chest 38-40 inches
                    @elseif(Auth::user()->tshirt_size == 'L') Chest 40-42 inches
                    @elseif(Auth::user()->tshirt_size == 'XL') Chest 42-44 inches
                    @elseif(Auth::user()->tshirt_size == 'XXL') Chest 44-46 inches
                    @else Chest 40-42 inches
                    @endif
                </span>
            </div>
        </div>
        @endif

        <!-- Event Details and QR Code -->
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h3 class="text-sm font-bold text-gray-800 mb-2">Event Details</h3>
                    <div class="space-y-1">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Event Name:</span>
                            <span class="text-gray-900">Department of Statistics Reunion 2026</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Location:</span>
                            <span class="text-gray-900">Rajshahi College, Rajshahi</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Event Date:</span>
                            <span class="text-gray-900">3 January 2026</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Emergency Contact:</span>
                            <span class="text-gray-900">+8801577281779</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Registration Date:</span>
                            <span class="text-gray-900">{{ Auth::user()->created_at ?
                                Auth::user()->created_at->format('d M Y') : 'N/A' }}</span>
                        </div>
                        @if(Auth::user()->accompanying_guests > 0)
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Total Guests:</span>
                            <span class="text-gray-900">{{ Auth::user()->accompanying_guests }} people</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-white rounded border border-gray-300 flex items-center justify-center mx-auto p-1">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=https://rcstatreunion.com/dashboard" 
                             alt="QR Code" 
                             class="w-full h-full object-contain">
                    </div>
                    <p class="text-xs text-gray-600 mt-1">QR Code</p>
                </div>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="px-6 py-3 bg-yellow-50 border-t border-yellow-200">
            <h3 class="text-base font-bold text-gray-800 mb-2">Terms & Conditions</h3>
            <div class="text-xs text-gray-700 space-y-0.5">
                <div>1. E-ticket must be shown upon entry.</div>
                <div>2. You must portage a photo ID during the event going on.</div>
                <div>3. This ticket is non-transferable and valid only for the registered participant.</div>
                <div>4. Once registered, the registration fee is non-refundable.</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3">
            <div class="text-center">
                <div class="text-base font-bold mb-1">Department of Statistics Reunion- 2026</div>
                <div class="text-xs opacity-90">Rajshahi College, Rajshahi- 6100, Emergency Contact: +8801577281779</div>
                <div class="text-xs opacity-90 mt-1">https://rcstatreunion.com/</div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="px-6 py-3 text-center bg-gray-50">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-semibold text-base
                    @if($order->status === 'paid') 
                    bg-green-100 text-green-700 border border-green-300
                    @else 
                    bg-yellow-100 text-yellow-700 border border-yellow-300
                    @endif">
                <i class="fas @if($order->status === 'paid') fa-check-circle @else fa-clock @endif"></i>
                Payment Status: {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>
</div>
@endif