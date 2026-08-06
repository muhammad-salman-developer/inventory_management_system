<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'web','verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
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
        ->middleware([
            'index' => 'can:view-product',
            'store' => 'can:create-product',
            'edit' => 'can:edit-product',
            'update' => 'can:edit-product',
            'destroy' => 'can:delete-product',

        ]);
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
    });
    // customer
    Route::resource('customers', CustomerController::class)->middleware([
        'index' => 'can:view-customer',
        'store' => 'can:create-customer',
        'edit' => 'can:edit-customer',
        'update' => 'can:edit-customer',
        'destroy' => 'can:delete-customer',
    ]);
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
});


require __DIR__.'/auth.php';
