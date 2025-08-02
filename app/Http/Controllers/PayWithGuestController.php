<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PayWithGuestController extends Controller
{
    private function getPaymentAmount($batchYear)
    {
        $startYear = (int) explode('-', $batchYear)[0];
        if ($startYear >= 2018) {
            return 1000;
        } elseif ($startYear >= 2013) {
            return 1500;
        } else {
            return 2000;
        }
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $baseAmount = $this->getPaymentAmount($user->batch_year);
        return view('pay-with-guest', [
            'amount' => $baseAmount,
        ]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $baseAmount = $this->getPaymentAmount($user->batch_year);
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
        $totalAmount = $baseAmount + $guestCharge;
        $order = Order::create([
            'user_id' => $user->id,
            'amount' => $totalAmount,
            'trxid' => $validated['trxid'],
            'guest_details' => $validated['guests'],
        ]);
        return redirect()->route('dashboard')->with('status', 'Guest payment submitted successfully!');
    }
} 