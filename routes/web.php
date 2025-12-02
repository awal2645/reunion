<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = Auth::user();
    /** @var \App\Models\User $user */
    if($user->role === 'admin'){
        return redirect()->route('admin.dashboard');
    }
    $paymentAmount = $user->getExpectedBaseAmount();
    // Gather all pending orders for aggregation in the invoice
    $pendingOrders = $user->orders()->orderBy('created_at')->get();
    // Fallback single order when there is no pending order
    $order = null;
    if ($pendingOrders->isEmpty()) {
        $order = $user->orders()->latest()->first();
    }
    
    // payment status
    $paymentStatus = $user->getPaymentStatus();

    $ordersCount = $user->orders()->count();
    $hasPaidBase = method_exists($user, 'hasPaidBaseRegistration') ? $user->hasPaidBaseRegistration() : $user->orders()->where('status', 'paid')->exists();
    return view('dashboard', compact('paymentAmount', 'pendingOrders', 'order', 'ordersCount', 'hasPaidBase', 'paymentStatus'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pay-now', [\App\Http\Controllers\PayNowController::class, 'show'])->name('pay.now');
    Route::post('/pay-now', [\App\Http\Controllers\PayNowController::class, 'submit'])->name('pay.submit');
    Route::get('/pay-with-guest', [\App\Http\Controllers\PayWithGuestController::class, 'show'])->name('pay.guest');
    Route::post('/pay-with-guest', [\App\Http\Controllers\PayWithGuestController::class, 'submit'])->name('pay.guest.submit');
    Route::get('/pay-for-guest', [\App\Http\Controllers\PayForGuestController::class, 'show'])->name('pay.for.guest');
    Route::post('/pay-for-guest', [\App\Http\Controllers\PayForGuestController::class, 'submit'])->name('pay.for.guest.submit');
    Route::get('/transaction-history', [\App\Http\Controllers\TransactionHistoryController::class, 'index'])->name('transaction.history');
    
    // Share Payment Routes
    Route::get('/share-payment', [\App\Http\Controllers\SharePaymentController::class, 'show'])->name('share.payment');
    
    // Admin routes with admin middleware
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders');
        Route::post('/admin/orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
        Route::delete('/admin/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'delete'])->name('admin.orders.delete');
        Route::get('/admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/orders/export', [\App\Http\Controllers\AdminOrderController::class, 'export'])->name('admin.orders.export');
        Route::get('/admin/users/{user}/download-image', [\App\Http\Controllers\AdminOrderController::class, 'downloadUserImage'])->name('admin.users.downloadImage');
        
        // Admin User Management Routes
        Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
        Route::get('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
        Route::get('/admin/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});

require __DIR__.'/auth.php';
