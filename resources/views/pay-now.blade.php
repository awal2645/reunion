@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 pt-32 md:px-32">
    @include('components.aside')
    <!-- Main Content -->
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white text-2xl shadow-lg">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-1">Pay Now</h1>
                        <p class="text-gray-600 flex items-center gap-2">
                            <i class="fas fa-money-bill-wave text-blue-500"></i>
                            Complete your reunion registration payment
                        </p>
                    </div>
                </div>
            </div>

            <!-- Payment Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white mb-2">Payment Details</h2>
                    <p class="text-blue-100">Please complete your payment using the information below</p>
                </div>

                <div class="p-8">
                    <!-- Amount Display -->
                    <div class="mb-8">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-blue-900">Registration Fee</h3>
                                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center">
                                    <i class="fas fa-tag text-white"></i>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-blue-700 mb-2">৳{{ number_format($amount) }}</div>
                            <div class="text-sm text-blue-600">
                                Based on your batch year: <span class="font-semibold">{{ Auth::user()->batch_year ?? 'Not specified' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-university text-blue-500"></i>
                            Bank Transfer Details
                        </h3>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Bank Name</div>
                                    <div class="font-semibold text-gray-900">Pubali Bank</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Branch</div>
                                    <div class="font-semibold text-gray-900">Rajshahi</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Account Name</div>
                                    <div class="font-semibold text-gray-900">Statisticsk Alumni Reunion</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Account Number</div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono font-semibold text-gray-900" id="bankAccount">0419101239646</span>
                                        <button type="button"
                                            onclick="copyBankAccount()"
                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm font-semibold focus:outline-none transition-all duration-300 flex items-center gap-1">
                                            <i class="fas fa-copy"></i> Copy
                                        </button>
                                    </div>
                                    <div id="copyMsg" class="text-green-600 text-xs mt-1 hidden">✓ Copied to clipboard!</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-500"></i>
                            Payment Instructions
                        </h3>
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200">
                            <div class="space-y-3 text-sm text-gray-700">
                                <div class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-full bg-yellow-500 text-white flex items-center justify-center text-xs font-bold mt-0.5">1</div>
                                    <div>Send the exact amount (৳{{ number_format($amount) }}) to the bank account above</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-full bg-yellow-500 text-white flex items-center justify-center text-xs font-bold mt-0.5">2</div>
                                    <div>Save your payment receipt with the Transaction ID (TRXID)</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-full bg-yellow-500 text-white flex items-center justify-center text-xs font-bold mt-0.5">3</div>
                                    <div>Enter the TRXID below and submit to complete your registration</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form method="POST" action="{{ route('pay.submit') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        
                        <!-- TRXID Input -->
                        <div>
                            <label for="trxid" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-receipt text-blue-500 mr-2"></i>Transaction ID (TRXID)
                            </label>
                            <div class="relative">
                                <input id="trxid" name="trxid" type="text" required
                                    placeholder="Enter your TRXID from payment receipt"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 pl-12">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-receipt text-gray-400"></i>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">You can find this on your payment receipt</div>
                        </div>

                        @if($withGuest ?? false)
                        <!-- Guest Details -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-blue-500 mr-2"></i>Guest Details
                            </label>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <input name="guests[0][name]" type="text" placeholder="Guest Name"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" required>
                                    </div>
                                    <div>
                                        <input name="guests[0][relation]" type="text" placeholder="Relation (e.g. Spouse, Child)"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" required>
                                    </div>
                                </div>
                                <button type="button" onclick="addGuestField()" 
                                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                    <i class="fas fa-plus-circle"></i> Add Another Guest
                                </button>
                                <div id="guest-fields" class="space-y-4"></div>
                            </div>
                        </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 px-6 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-check-circle mr-2"></i>
                                Submit Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center">
                <div class="inline-flex items-center gap-3 px-6 py-4 bg-blue-50 rounded-2xl border border-blue-200">
                    <i class="fas fa-shield-alt text-blue-500 text-lg"></i>
                    <div class="text-left">
                        <div class="font-semibold text-blue-900">Secure Payment</div>
                        <div class="text-sm text-blue-700">Your payment information is secure and encrypted</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function copyBankAccount() {
    const account = document.getElementById('bankAccount').textContent;
    navigator.clipboard.writeText(account).then(function() {
        const msg = document.getElementById('copyMsg');
        msg.classList.remove('hidden');
        setTimeout(() => msg.classList.add('hidden'), 2000);
    });
}

@if($withGuest ?? false)
function addGuestField() {
    const idx = document.querySelectorAll('#guest-fields .guest-row').length + 1;
    const div = document.createElement('div');
    div.className = 'guest-row grid grid-cols-1 md:grid-cols-2 gap-4';
    div.innerHTML = `
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700">Guest ${idx + 1}</span>
            <button type="button" onclick="removeGuestField(this)" class="text-red-500 hover:text-red-700 text-sm">
                <i class="fas fa-times-circle"></i> Remove
            </button>
        </div>
        <input name="guests[${idx}][name]" type="text" placeholder="Guest Name" 
            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" required>
        <input name="guests[${idx}][relation]" type="text" placeholder="Relation (e.g. Spouse, Child)" 
            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" required>
    `;
    document.getElementById('guest-fields').appendChild(div);
}

function removeGuestField(button) {
    button.closest('.guest-row').remove();
}
@endif
</script>
@endsection