@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 pt-32 md:px-32">
    @include('components.aside')
    <main class="flex-1 p-4 sm:p-6 lg:p-8 xl:p-12">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-4 sm:mb-6">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-green-600 to-green-700 flex items-center justify-center text-white text-xl sm:text-2xl shadow-lg">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Pay for Guest</h1>
                        <p class="text-sm sm:text-base text-gray-600 flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            Base fee already paid — only guest fees apply
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl sm:shadow-2xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-white mb-2">Guest Payment Details</h2>
                    <p class="text-sm sm:text-base text-green-100">Add your guests and complete the payment</p>
                </div>
                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Amount Display -->
                    <div class="mb-6 sm:mb-8">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-green-200">
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <h3 class="text-base sm:text-lg font-semibold text-green-900">Total Amount to Pay</h3>
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-500 flex items-center justify-center">
                                    <i class="fas fa-money-bill-wave text-white text-sm sm:text-base"></i>
                                </div>
                            </div>
                            <div class="text-2xl sm:text-3xl font-bold text-green-700 mb-2" id="amountDisplay">৳0</div>
                            <div class="text-xs sm:text-sm text-green-700 font-semibold flex items-center gap-2">
                                <i class="fas fa-check-circle"></i>
                                Base registration fee already paid — only guest fees apply
                            </div>
                        </div>
                    </div>

                    <!-- Rules -->
                    <div class="mb-6 sm:mb-8">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2">
                            <i class="fas fa-calculator text-green-500"></i>
                            Guest Fee Rules
                        </h3>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-200">
                            <div class="text-xs sm:text-sm text-gray-700 space-y-2">
                                <div class="flex items-center gap-2"><div class="w-2 h-2 bg-green-500 rounded-full"></div><span>For each guest above 5 years: <strong>+৳1,000</strong></span></div>
                                <div class="flex items-center gap-2"><div class="w-2 h-2 bg-green-500 rounded-full"></div><span>Children 5 and under: <strong>Free</strong></span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="mb-6 sm:mb-8">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2">
                            <i class="fas fa-university text-blue-500"></i>
                            Bank Transfer Details
                        </h3>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-blue-200">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <div class="text-xs sm:text-sm text-gray-600 mb-1">Bank Name</div>
                                    <div class="font-semibold text-gray-900 text-sm sm:text-base">Pubali Bank</div>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm text-gray-600 mb-1">Branch</div>
                                    <div class="font-semibold text-gray-900 text-sm sm:text-base">DELUABARI (RURAL) BRANCH</div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="text-xs sm:text-sm text-gray-600 mb-1">Account Name</div>
                                    <div class="font-semibold text-gray-900 text-sm sm:text-base">MD. SAZEDUR RAHMAN</div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="text-xs sm:text-sm text-gray-600 mb-1">Account Number</div>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                                        <span class="font-mono font-semibold text-gray-900 text-sm sm:text-base break-all" id="bankAccount">4398101078888</span>
                                        <button type="button"
                                            onclick="copyBankAccount()"
                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-xs font-semibold focus:outline-none transition-all duration-300 flex items-center gap-1 w-fit">
                                            <i class="fas fa-copy"></i> Copy
                                        </button>
                                    </div>
                                    <div id="copyMsg" class="text-green-600 text-xs mt-1 hidden">✓ Copied to clipboard!</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form method="POST" action="{{ route('pay.for.guest.submit') }}" class="space-y-4 sm:space-y-6">
                        @csrf
                        <input type="hidden" id="amountInput" name="amount" value="0">

                        <!-- Guest Details -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 sm:mb-4">
                                <i class="fas fa-users text-blue-500 mr-2"></i>Guest Details
                            </label>
                            <div id="guest-fields" class="space-y-3 sm:space-y-4">
                                <div class="guest-row bg-gray-50 rounded-xl p-3 sm:p-4 border border-gray-200" data-guest-index="0">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm font-semibold text-blue-700">Guest 1</span>
                                        <span class="text-xs text-gray-500">Required</span>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-600 mb-1">Name</label>
                                            <input name="guests[0][name]" type="text" placeholder="Guest Name"
                                                class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 text-sm sm:text-base" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-600 mb-1">Relation</label>
                                            <input name="guests[0][relation]" type="text" placeholder="e.g. Spouse, Child"
                                                class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 text-sm sm:text-base" required>
                                        </div>
                                        <div class="sm:col-span-2 lg:col-span-1">
                                            <label class="block text-xs text-gray-600 mb-1">Age</label>
                                            <input name="guests[0][age]" type="number" min="0" placeholder="Age"
                                                class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 text-sm sm:text-base" required oninput="updateAmount()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="addGuestField()" 
                                class="mt-3 sm:mt-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                <i class="fas fa-plus-circle"></i> Add Another Guest
                            </button>
                        </div>

                        <!-- TRXID Input -->
                        <div>
                            <label for="trxid" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-receipt text-blue-500 mr-2"></i>Transaction ID (TRXID)
                            </label>
                            <div class="relative">
                                <input id="trxid" name="trxid" type="text" required
                                    placeholder="Enter your TRXID from payment receipt"
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 pl-10 sm:pl-12 text-sm sm:text-base">
                                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-receipt text-gray-400 text-sm sm:text-base"></i>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">You can find this on your payment receipt</div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 sm:pt-6">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 sm:py-4 px-4 sm:px-6 rounded-xl font-bold text-base sm:text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <i class="fas fa-check-circle mr-2"></i>
                                Submit Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
let guestIndex = 1;

function updateAmount() {
    const guestRows = document.querySelectorAll('#guest-fields .guest-row');
    let chargeableGuests = 0;
    guestRows.forEach(row => {
        const ageInput = row.querySelector('input[name^="guests"][name$="[age]"]');
        if (ageInput && parseInt(ageInput.value, 10) > 5) {
            chargeableGuests++;
        }
    });
    let total = (chargeableGuests * 1000);
    document.getElementById('amountDisplay').textContent = '৳' + total.toLocaleString();
    document.getElementById('amountInput').value = total;
}

function addGuestField() {
    const guestFields = document.getElementById('guest-fields');
    const div = document.createElement('div');
    div.className = 'guest-row bg-gray-50 rounded-xl p-3 sm:p-4 border border-gray-200';
    div.setAttribute('data-guest-index', guestIndex);
    div.innerHTML = `
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-semibold text-blue-700">Guest ${guestIndex + 1}</span>
            <button type="button" onclick="removeGuestField(this)" class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1">
                <i class="fas fa-times-circle"></i> Remove
            </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            <div>
                <label class="block text-xs text-gray-600 mb-1">Name</label>
                <input name="guests[${guestIndex}][name]" type="text" placeholder="Guest Name" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 text-sm sm:text-base" required>
            </div>
            <div>
                <label class="block text-xs text-gray-600 mb-1">Relation</label>
                <input name="guests[${guestIndex}][relation]" type="text" placeholder="e.g. Spouse, Child" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 text-sm sm:text-base" required>
            </div>
            <div class="sm:col-span-2 lg:col-span-1">
                <label class="block text-xs text-gray-600 mb-1">Age</label>
                <input name="guests[${guestIndex}][age]" type="number" min="0" placeholder="Age" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300 text-sm sm:text-base" required oninput="updateAmount()">
            </div>
        </div>
    `;
    guestFields.appendChild(div);
    guestIndex++;
    updateAmount();
}

function removeGuestField(btn) {
    btn.closest('.guest-row').remove();
    updateAmount();
}

updateAmount();

function copyBankAccount() {
    const account = document.getElementById('bankAccount').textContent;
    navigator.clipboard.writeText(account).then(function() {
        const msg = document.getElementById('copyMsg');
        msg.classList.remove('hidden');
        setTimeout(() => msg.classList.add('hidden'), 2000);
    });
}
</script>
@endsection


