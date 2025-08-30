<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PayNowController extends Controller
{
    private function getPaymentAmount($session)
    {
        if (!$session) {
            return 1000; // Default amount
        }
        
        $startYear = (int) explode('-', $session)[0];
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
        $amount = $this->getPaymentAmount($user->session);
        $withGuest = $request->query('guest', false);
        return view('pay-now', [
            'amount' => $amount,
            'withGuest' => $withGuest,
        ]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $amount = $this->getPaymentAmount($user->session);

        $validated = $request->validate([
            'trxid' => 'required|string|max:255|unique:orders,trxid',
            'amount' => 'required|integer',
            'guests' => 'nullable|array',
            'guests.*.name' => 'required_with:guests|string|max:255',
            'guests.*.relation' => 'required_with:guests|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'trxid' => $validated['trxid'],
            'guest_details' => isset($validated['guests']) ? $validated['guests'] : null,
        ]);

        return redirect()->route('dashboard')->with('status', 'Payment submitted successfully!');
    }
} 