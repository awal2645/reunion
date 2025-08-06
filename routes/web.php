<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if($user->role === 'admin'){
        return redirect()->route('admin.dashboard');
    }
    $startYear = (int) explode('-', $user->batch_year)[0];
    if ($startYear >= 2018) {
        $paymentAmount = 1000;
    } elseif ($startYear >= 2013) {
        $paymentAmount = 1500;
    } else {
        $paymentAmount = 2000;
    }
    $order = $user->orders()->where('status', 'pending')->latest()->first();
    return view('dashboard', compact('paymentAmount', 'order'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pay-now', [\App\Http\Controllers\PayNowController::class, 'show'])->name('pay.now');
    Route::post('/pay-now', [\App\Http\Controllers\PayNowController::class, 'submit'])->name('pay.submit');
    Route::get('/pay-with-guest', [\App\Http\Controllers\PayWithGuestController::class, 'show'])->name('pay.guest');
    Route::post('/pay-with-guest', [\App\Http\Controllers\PayWithGuestController::class, 'submit'])->name('pay.guest.submit');
    Route::get('/transaction-history', [\App\Http\Controllers\TransactionHistoryController::class, 'index'])->name('transaction.history');
    // Admin routes
    Route::get('/admin/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders');
    Route::post('/admin/orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/admin/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'delete'])->name('admin.orders.delete');
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders/export', [\App\Http\Controllers\AdminOrderController::class, 'export'])->name('admin.orders.export');
});

require __DIR__.'/auth.php';
