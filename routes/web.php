<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SalesReport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth.custom');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth.custom');

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth.custom');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->middleware('auth.custom');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth.custom');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth.custom');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update')->middleware('auth.custom');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth.custom');

Route::get('/checkout', [CheckoutController::class, 'payment'])->name('checkout.payment')->middleware('auth.custom');
Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process')->middleware('auth.custom');
Route::get('/checkout/review', [CheckoutController::class, 'review'])->name('checkout.review')->middleware('auth.custom');

Route::post('/checkout/purchase', [CheckoutController::class, 'purchase'])->name('checkout.purchase')->middleware('auth.custom');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth.custom');

Route::get('/sales-report', [SalesReport::class, 'index'])->name('sales.report')->middleware('auth.custom');
