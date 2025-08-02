<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $totalPaid = Order::where('status', 'paid')->sum('amount');
        $totalPending = Order::where('status', 'pending')->sum('amount');
        $totalUsers = User::count();
        $totalGuests = Order::whereNotNull('guest_details')
            ->get()
            ->sum(function ($order) {
                $guests = $order->guest_details;
                if (is_string($guests)) {
                    $guests = json_decode($guests, true);
                }
                return is_array($guests) ? count($guests) : 0;
            });

        return view('admin.dashboard', compact('totalPaid', 'totalPending', 'totalUsers', 'totalGuests'));
    }
}