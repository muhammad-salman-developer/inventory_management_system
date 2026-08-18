<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.pages.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'web','verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('product/create',[])->middleware('can:create-product');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('categories', CategoryController::class);
    Route::resource('categories', CategoryController::class)
        ->middleware([
            'index' => 'can:view-category',
            'store' => 'can:create-category',
            'edit' => 'can:edit-category',
            'update' => 'can:edit-category',
            'delete' => 'can:delete-category',
        ]);
    // products
    Route::resource('products', ProductController::class)
        ->except(['show'])
        ->middlewareFor('index', 'can:view-product')
        ->middlewareFor('create', 'can:create-product')
        ->middlewareFor('store', 'can:create-product')
        ->middlewareFor('edit', 'can:edit-product')
        ->middlewareFor('update', 'can:edit-product')
        ->middlewareFor('destroy', 'can:delete-product');
    // ->middleware([
    //     'index' => 'can:view-product',
    //     'store' => 'can:create-product',
    //     'edit' => 'can:edit-product',
    //     'update' => 'can:edit-product',
    //     'destroy' => 'can:delete-product',

    // ]);

    // suppliers
    Route::resource('suppliers', SupplierController::class)
        ->middleware([
            'index' => 'can:view-supplier',
            'store' => 'can:create-supplier',
            'edit' => 'can:edit-supplier',
            'update' => 'can:edit-supplier',
            'destroy' => 'can:delete-supplier',

        ]);
    // purchases routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/purchases', [PurchaseController::class, 'index'])->middleware('can:view-purchase')->name('purchases.index');
        Route::get('/purchases/create', [PurchaseController::class, 'create'])->middleware('can:view-purchase')->name('purchases.create');
        Route::post('/purchases', [PurchaseController::class, 'store'])
            ->middleware('can:create-purchase')
            ->name('purchases.store');
        Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])
            ->middleware('can:view-purchase')
            ->name('purchases.show');
        Route::patch('/purchases/{purchase}/status', [PurchaseController::class, 'updateStatus'])
            ->middleware('can:create-purchase')
            ->name('purchases.updateStatus');
    });
    // customer
    // Route::resource('customers', CustomerController::class)->middleware([
    //     'index' => 'can:view-customer',
    //     'store' => 'can:create-customer',
    //     'edit' => 'can:edit-customer',
    //     'update' => 'can:edit-customer',
    //     'destroy' => 'can:delete-customer',
    // ]);
    Route::resource('customers', CustomerController::class)
        ->middlewareFor('index', 'can:view-customer')
        ->middlewareFor('create', 'can:create-customer')
        ->middlewareFor('store', 'can:create-customer')
        ->middlewareFor('edit', 'can:edit-customer')
        ->middlewareFor('update', 'can:edit-customer')
        ->middlewareFor('destroy', 'can:delete-customer');
    // stock
    Route::get('/stocks', [StockController::class, 'index'])
        ->middleware('can:view-stocks')
        ->name('stocks.index');
    Route::get('sales', [SaleController::class, 'index'])
        ->name('sales.index')
        ->middleware('can:view-sale');

    Route::get('sales/create', [SaleController::class, 'create'])
        ->name('sales.create')
        ->middleware('can:create-sale');

    Route::post('sales', [SaleController::class, 'store'])
        ->name('sales.store')
        ->middleware('can:create-sale');

    Route::get('sales/{sale}', [SaleController::class, 'show'])
        ->name('sales.show')
        ->middleware('can:view-sale');
    Route::middleware(['can:view-reports'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/reports/purchases', [ReportController::class, 'purchases'])->name('reports.purchases');
        Route::get('/reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
    });
    // manage user
    Route::resource('users', UserController::class)
        ->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    });
});

require __DIR__.'/auth.php';
