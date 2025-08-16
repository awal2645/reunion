<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;

class SharePaymentController extends Controller
{
    /**
     * Show the banner download page
     */
    public function show()
    {
        $user = Auth::user();
        
        // Check if user has any paid orders
        $hasPaidOrders = $user->orders()->where('status', 'paid')->exists();
        
        if (!$hasPaidOrders) {
            return redirect()->route('dashboard')->with('error', 'You need to have a paid order to download the payment banner.');
        }

        return view('share-payment', compact('user'));
    }
}
