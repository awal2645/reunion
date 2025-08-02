@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 pt-32 md:px-32">
    @include('components.aside')
    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 xl:p-12">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-4 sm:mb-6">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white text-xl sm:text-2xl shadow-lg">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Transaction History</h1>
                        <p class="text-sm sm:text-base text-gray-600 flex items-center gap-2">
                            <i class="fas fa-clock text-blue-500"></i>
                            View all your payment transactions and guest registrations
                        </p>
                    </div>
                </div>
            </div>


            <!-- Transaction History Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-white mb-2">Payment Transactions</h2>
                            <p class="text-sm sm:text-base text-blue-100">Your complete payment and guest registration history</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1">
                                <span class="text-white text-sm font-medium">{{ $orders->count() }} transactions</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6 lg:p-8">
                    @if($orders->count() > 0)
                        <!-- Desktop Table -->
                        <div class="hidden lg:block overflow-hidden rounded-2xl border border-gray-200">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date & Time</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Amount</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Transaction ID</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Guest Details</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-900">{{ $order->created_at->format('d M Y') }}</span>
                                                    <span class="text-sm text-gray-500">{{ $order->created_at->format('h:i A') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="font-bold text-lg text-blue-700">৳{{ number_format($order->amount) }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-mono text-sm bg-gray-100 px-3 py-1 rounded-lg">{{ $order->trxid }}</span>
                                                    <button onclick="copyToClipboard('{{ $order->trxid }}')" class="text-gray-400 hover:text-blue-600 transition-colors">
                                                        <i class="fas fa-copy text-xs"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($order->guest_details && is_array($order->guest_details) && count($order->guest_details))
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($order->guest_details as $guest)
                                                            <div class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2 text-xs">
                                                                <div class="font-medium text-blue-700">{{ $guest['name'] ?? 'N/A' }}</div>
                                                                <div class="text-gray-600">{{ $guest['relation'] ?? 'N/A' }} • {{ $guest['age'] ?? 'N/A' }}y</div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 text-sm">No guests</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $status = strtolower($order->status);
                                                    $statusConfig = match($status) {
                                                        'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fas fa-clock'],
                                                        'completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fas fa-check-circle'],
                                                        'failed' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fas fa-times-circle'],
                                                        default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => 'fas fa-question-circle'],
                                                    };
                                                @endphp
                                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                                                    <i class="{{ $statusConfig['icon'] }}"></i>
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="lg:hidden space-y-4">
                            @foreach($orders as $order)
                                <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $order->created_at->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-lg text-blue-700">৳{{ number_format($order->amount) }}</div>
                                            @php
                                                $status = strtolower($order->status);
                                                $statusConfig = match($status) {
                                                    'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fas fa-clock'],
                                                    'completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fas fa-check-circle'],
                                                    'failed' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fas fa-times-circle'],
                                                    default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => 'fas fa-question-circle'],
                                                };
                                            @endphp
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                                                <i class="{{ $statusConfig['icon'] }}"></i>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Transaction ID:</span>
                                            <div class="flex items-center gap-2">
                                                <span class="font-mono text-sm bg-white px-2 py-1 rounded border">{{ $order->trxid }}</span>
                                                <button onclick="copyToClipboard('{{ $order->trxid }}')" class="text-gray-400 hover:text-blue-600">
                                                    <i class="fas fa-copy text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        @if($order->guest_details && is_array($order->guest_details) && count($order->guest_details))
                                            <div>
                                                <div class="text-sm text-gray-600 mb-2">Guests:</div>
                                                <div class="space-y-2">
                                                    @foreach($order->guest_details as $guest)
                                                        <div class="bg-white rounded-lg px-3 py-2 text-sm border">
                                                            <div class="font-medium text-gray-900">{{ $guest['name'] ?? 'N/A' }}</div>
                                                            <div class="text-gray-600 text-xs">{{ $guest['relation'] ?? 'N/A' }} • {{ $guest['age'] ?? 'N/A' }} years old</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-500">No guests registered</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-receipt text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Transactions Yet</h3>
                            <p class="text-gray-600 mb-6">You haven't made any payments yet. Start by making your first payment.</p>
                            <a href="{{ route('pay.now') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                <i class="fas fa-credit-card"></i>
                                Make Payment
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 sm:mt-8 text-center">
                <div class="inline-flex items-center gap-3 px-6 py-4 bg-blue-50 rounded-2xl border border-blue-200">
                    <i class="fas fa-shield-alt text-blue-500 text-lg"></i>
                    <div class="text-left">
                        <div class="font-semibold text-blue-900">Secure Transactions</div>
                        <div class="text-sm text-blue-700">All your payment data is encrypted and secure</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show a temporary success message
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check text-green-600"></i>';
        setTimeout(() => {
            button.innerHTML = originalHTML;
        }, 1500);
    });
}
</script>
@endsection