<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        // Admin check
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $query = Order::query();

        // Join with users for searching
        $query->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.full_name', 'users.contact_number', 'users.email');

        // Filtering
        if ($request->filled('status')) {
            $query->where('orders.status', $request->status);
        }
        if ($request->filled('phone')) {
            $query->where('users.contact_number', 'like', '%'.$request->phone.'%');
        }
        if ($request->filled('email')) {
            $query->where('users.email', 'like', '%'.$request->email.'%');
        }
        if ($request->filled('trxid')) {
            $query->where('orders.trxid', 'like', '%'.$request->trxid.'%');
        }

        $orders = $query->orderByDesc('orders.created_at')->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $order = Order::findOrFail($orderId);
        $order->status = $request->input('status', 'paid');
        $order->save();
        return redirect()->back()->with('status', 'Order status updated!');
    }

    public function delete(Request $request, $orderId)
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        
        $order = Order::findOrFail($orderId);
        $order->delete();
        
        return redirect()->back()->with('status', 'Order removed successfully! User can now submit a new transaction.');
    }

    public function export(Request $request)
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $filters = $request->only(['status', 'phone', 'email', 'trxid']);
        return Excel::download(new OrdersExport($filters), 'orders.xlsx');
    }
}