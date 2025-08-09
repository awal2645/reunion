<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;

class PayForGuestController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        /** @var User $user */
        $hasPaidBase = $user->hasPaidBaseRegistration();
        if (!$hasPaidBase) {
            return redirect()->route('pay.now')->with('error', 'Please complete base registration payment first.');
        }

        return view('pay-for-guest', [
            'amount' => 0,
            'hasPaidBase' => true,
        ]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        /** @var User $user */
        $hasPaidBase = $user->hasPaidBaseRegistration();
        if (!$hasPaidBase) {
            return redirect()->route('pay.now')->with('error', 'Please complete base registration payment first.');
        }

        $validated = $request->validate([
            'trxid' => 'required|string|max:255|unique:orders,trxid',
            'amount' => 'required|integer',
            'guests' => 'required|array|min:1',
            'guests.*.name' => 'required|string|max:255',
            'guests.*.relation' => 'required|string|max:255',
            'guests.*.age' => 'required|integer|min:0',
        ]);

        $guestCharge = 0;
        foreach ($validated['guests'] as $guest) {
            if ($guest['age'] > 5) {
                $guestCharge += 1000;
            }
        }

        $totalAmount = $guestCharge; // base is always 0 here

        Order::create([
            'user_id' => $user->id,
            'amount' => $totalAmount,
            'trxid' => $validated['trxid'],
            'guest_details' => $validated['guests'],
        ]);

        return redirect()->route('dashboard')->with('status', 'Guest payment submitted successfully!');
    }
}


