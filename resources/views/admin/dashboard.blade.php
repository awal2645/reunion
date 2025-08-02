@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-gray-50 pt-32 md:px-32">    
    @include('components.aside')
    <main class="flex-1 p-8 lg:p-12">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-1">Admin Dashboard</h1>
                            <p class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-chart-line text-blue-500"></i>
                                Overview of reunion registration and payments
                            </p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Last Updated</div>
                            <div class="text-lg font-semibold text-gray-900">{{ now()->format('l, F j, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Paid Amount -->
                <div class="group bg-white rounded-3xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-green-600 font-semibold">+12.5%</div>
                            <div class="text-xs text-gray-500">vs last week</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-2xl font-bold text-gray-900">৳{{ number_format($totalPaid) }}</div>
                        <div class="text-sm text-gray-500">Total Paid Amount</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <!-- Total Pending Amount -->
                <div class="group bg-white rounded-3xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-hourglass-half text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-yellow-600 font-semibold">+8.2%</div>
                            <div class="text-xs text-gray-500">vs last week</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-2xl font-bold text-gray-900">৳{{ number_format($totalPending) }}</div>
                        <div class="text-sm text-gray-500">Total Pending Amount</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>

                <!-- Total Registered Users -->
                <div class="group bg-white rounded-3xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-blue-600 font-semibold">+15.3%</div>
                            <div class="text-xs text-gray-500">vs last week</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</div>
                        <div class="text-sm text-gray-500">Total Registered Users</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>

                <!-- Total Guests -->
                <div class="group bg-white rounded-3xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-friends text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-purple-600 font-semibold">+22.1%</div>
                            <div class="text-xs text-gray-500">vs last week</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalGuests) }}</div>
                        <div class="text-sm text-gray-500">Total Guests</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>

            <!-- Additional Statistics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Payment Overview -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Payment Overview</h3>
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-blue-600"></i>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="font-medium text-gray-700">Completed Payments</span>
                            </div>
                            <span class="font-bold text-green-600">৳{{ number_format($totalPaid) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <span class="font-medium text-gray-700">Pending Payments</span>
                            </div>
                            <span class="font-bold text-yellow-600">৳{{ number_format($totalPending) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="font-medium text-gray-700">Total Revenue</span>
                            </div>
                            <span class="font-bold text-blue-600">৳{{ number_format($totalPaid + $totalPending) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Registration Stats -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Registration Statistics</h3>
                        <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-user-plus text-purple-600"></i>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="font-medium text-gray-700">Total Registrations</span>
                            </div>
                            <span class="font-bold text-blue-600">{{ number_format($totalUsers) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                <span class="font-medium text-gray-700">Total Guests</span>
                            </div>
                            <span class="font-bold text-purple-600">{{ number_format($totalGuests) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="font-medium text-gray-700">Average Guests per User</span>
                            </div>
                            <span class="font-bold text-green-600">{{ $totalUsers > 0 ? number_format($totalGuests / $totalUsers, 1) : 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

    

            <!-- Info Message -->
            <div class="mt-8 text-center">
                <div class="inline-flex items-center gap-3 px-6 py-4 bg-blue-50 rounded-2xl border border-blue-200">
                    <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                    <div class="text-left">
                        <div class="font-semibold text-blue-900">Dashboard Overview</div>
                        <div class="text-sm text-blue-700">This dashboard provides a comprehensive overview of all registration and payment activities for the reunion event.</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection