<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductLogController;
use App\Http\Controllers\ProductFrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Frontend (customers) + Admin (dashboard) routes.
|
*/

// ----------------- Public / Frontend -----------------

// Home / Products
Route::get('/', [ProductFrontendController::class,'index'])->name('home');
Route::get('/products', [ProductFrontendController::class,'index'])->name('products.index');
Route::get('/products/{product}', [ProductFrontendController::class, 'show'])->name('products.show');
Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');

// Cart
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class,'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class,'remove'])->name('cart.remove');
Route::post('/cart/bulk-update', [CartController::class,'bulkUpdate'])->name('cart.bulkUpdate');
Route::post('/cart/stock-check', [CartController::class,'stockCheck'])->name('cart.stockCheck');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
// Checkout page
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order/{id}/confirmation', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
// ----------------- Breeze Default -----------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------- Admin (only for admins) -----------------
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return redirect()->route('admin.products.index'); });
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index','show']);
    Route::get('product-logs', [ProductLogController::class, 'index'])->name('product-logs.index');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// ----------------- Auth scaffolding -----------------
require __DIR__.'/auth.php';
