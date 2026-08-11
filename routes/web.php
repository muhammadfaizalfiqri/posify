<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\DaftarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\MidtransNotificationController;

Route::middleware('guest')->group(function () {

    Route::get('/daftar', [DaftarController::class, 'index'])
        ->name('daftar');

    Route::post('/daftar', [DaftarController::class, 'store'])
        ->name('daftar.store');

});

Route::middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');
});

Route::post('/midtrans/notification',[MidtransNotificationController::class, 'handle']);

Route::middleware('auth')->group(function () {

    Route::get('/notifications', function (Request $request) {

        return response()->json([
            'notifications' => $request->user()
                ->notifications()
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($notification) {

                    return [
                        'id' => $notification->id,
                        'title' => $notification->data['title'] ?? 'Notifikasi',
                        'message' => $notification->data['message'] ?? '',
                        'invoice' => $notification->data['invoice'] ?? null,
                        'total' => $notification->data['total'] ?? 0,
                        'read_at' => $notification->read_at,
                        'created_at' => $notification->created_at->diffForHumans(),
                    ];

                }),

            'unread_count' => $request->user()
                ->unreadNotifications()
                ->count(),
        ]);

    });

    Route::post('/notifications/{notification}/read', function (
        Request $request,
        string $notification
    ) {

        $item = $request->user()
            ->notifications()
            ->where('id', $notification)
            ->firstOrFail();

        $item->markAsRead();

        return response()->json([
            'success' => true
        ]);

    });

    Route::post('/notifications/read-all', function (Request $request) {

        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return response()->json([
            'success' => true
        ]);

    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/products/export', [ProductController::class,'export'])
        ->name('products.export');
    
    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::get('/suppliers/export', [SupplierController::class, 'export'])
        ->name('suppliers.export');

    Route::resource('suppliers', SupplierController::class);

    Route::get('/customers/export', [CustomerController::class, 'export'])
        ->name('customers.export');

    Route::resource('customers', CustomerController::class);

    Route::resource('transactions', TransactionController::class);

    Route::get('/reports/export', [ReportController::class, 'export'])
        ->name('reports.export');

    // Route::post('/midtrans/notification', [MidtransController::class, 'notification']);

    Route::get('/reports/{transaction}/print', [ReportController::class, 'print'])
        ->name('reports.print');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/{transaction}', [ReportController::class, 'show'])
        ->name('reports.show');

    Route::post('/logout', LogoutController::class)
        ->name('logout');
});

