@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gray-50 pt-32 md:px-32"> 
    @include('components.aside')
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-1">Order Management</h1>
                            <p class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-chart-bar text-blue-500"></i>
                                Manage and track all payment orders
                            </p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Total Orders</div>
                            <div class="text-lg font-semibold text-gray-900">{{ $orders->total() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Filter Orders</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-filter text-blue-600"></i>
                    </div>
                </div>
                <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div>
                        <label for="status" class="block text-gray-700 font-semibold mb-2">Payment Status</label>
                        <select id="status" name="status" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                            <option value="">All Status</option>
                            <option value="pending" @if(request('status')=='pending') selected @endif>Pending</option>
                            <option value="paid" @if(request('status')=='paid') selected @endif>Paid</option>
                        </select>
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                        <input id="phone" type="text" name="phone" value="{{ request('phone') }}" 
                            placeholder="Enter phone number"
                            class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="trxid" class="block text-gray-700 font-semibold mb-2">Transaction ID</label>
                        <input id="trxid" type="text" name="trxid" value="{{ request('trxid') }}" 
                            placeholder="Enter TRXID"
                            class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-search mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Actions Section -->
            <div class="flex flex-wrap items-center justify-between mb-6">
                <div class="flex items-center gap-4 mb-4 md:mb-0">
                    <a href="{{ route('admin.orders.export', request()->query()) }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-file-excel"></i>
                        Export to Excel
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
                <div class="text-sm text-gray-600">
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} orders
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hashtag"></i>
                                        Order ID
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-user"></i>
                                        Customer
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-phone"></i>
                                        Contact
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-receipt"></i>
                                        TRXID
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Amount
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-info-circle"></i>
                                        Status
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-cogs"></i>
                                        Actions
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($orders as $order)
                            <tr class="hover:bg-blue-50 transition-all duration-300 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-xs font-bold text-blue-600">#{{ $order->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-sm font-bold">
                                            {{ substr($order->full_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $order->full_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->created_at->format('M j, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-phone text-blue-500 text-sm"></i>
                                        <span class="font-medium text-gray-900">{{ $order->contact_number }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-receipt text-blue-500 text-sm"></i>
                                        <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $order->trxid }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-money-bill-wave text-green-500 text-sm"></i>
                                        <span class="font-bold text-green-600 text-lg">৳{{ number_format($order->amount) }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($order->status === 'pending')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            <i class="fas fa-clock"></i>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                            <i class="fas fa-check-circle"></i>
                                            Paid
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($order->status === 'pending')
                                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="paid">
                                            <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-lg font-bold shadow hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-check"></i>
                                                Mark as Paid
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex items-center gap-2 text-green-700 font-semibold">
                                            <i class="fas fa-check-circle text-lg"></i>
                                            Confirmed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                        </div>
                                        <div class="text-gray-500">
                                            <div class="font-semibold text-lg">No orders found</div>
                                            <div class="text-sm">Try adjusting your filters or check back later</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 px-6 py-4">
                    {{ $orders->withQueryString()->links() }}
                </div>
            </div>
            @endif

        </div>
    </main>
</div>
@endsection