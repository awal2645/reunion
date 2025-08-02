<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('transaction-history', [
            'orders' => $orders,
        ]);
    }
}