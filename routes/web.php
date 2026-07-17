<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
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
    Route::resource('products', ProductController::class)
        ->middleware([
            'index' => 'can:view-product',
            'store' => 'can:create-product',
            'edit' => 'can:edit-product',
            'update' => 'can:edit-product',
            'destroy' => 'can:delete-product',

        ]);

});

require __DIR__.'/auth.php';
