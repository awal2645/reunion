<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            ->select(
                'orders.*',
                'orders.user_id',
                'users.full_name',
                'users.contact_number',
                'users.email',
                'users.session',
                'users.courses_completed',
                'users.accompanying_guests',
                'users.tshirt_size',
                'users.photo_path'
            );

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

    public function downloadUserImage($user)
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $user = User::findOrFail($user);
        
        if (!$user->photo_path) {
            abort(404, 'User photo not found');
        }

        $filePath = storage_path('app/public/' . $user->photo_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'Photo file not found');
        }

        $fileName = $user->full_name . '_photo.' . pathinfo($filePath, PATHINFO_EXTENSION);
        $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);

        return response()->download($filePath, $fileName);
    }
}