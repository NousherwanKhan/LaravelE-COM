<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth Controller for Registration
Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('postregister', [AuthController::class, 'store'])->name('postregister');
Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');



// Product Controller
Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('showproduct');
Route::get('/productlist', [ProductController::class, 'productlist'])->name('productlist');
Route::post('searchproduct', [ProductController::class, 'searchproduct'])->name('searchproduct');



//User COntroller public Access
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('loginattempt', [UserController::class, 'login'])->name('loginattempt');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

//CART controller

Route::post('/add-to-cart', [CartController::class, 'cart'])->name('cartview');
Route::get('/loadcart', [CartController::class, 'cartcount'])->name('loadcart');
Route::get('/cart', [CartController::class, 'cartview'])->name('cart');
Route::post('/updatecart', [CartController::class, 'updatecart'])->name('updatecart');
Route::post('/cart/delete-cart-item/', [CartController::class, 'destroy'])->name('deletecart');


//checkout controller
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/placeorder', [CheckoutController::class, 'placeorder'])->name('placeorder');
Route::post('/payment', [CheckoutController::class, 'payment'])->name('payment');
Route::get('/stripepay/{id}', [CheckoutController::class, 'stripe'])->name('stripepay');
Route::post('/card-checkout{id}', [CheckoutController::class, 'stripePost'])->name('stripePost');

// Route::get('/paypal/{id}/', [CheckoutController::class, 'paypal'])->name('paypalpay');


//Middleware Routes After User Login Successfully

Route::middleware(['isUser', 'is_verified'])->group(function () {

    Route::get('/upload', [UserController::class, 'show'])->name('upload');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/myorders', [UserController::class, 'myorder'])->name('myorders');

    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [UserController::class, 'update'])->name('update');
    Route::get('delete/{id}', [UserController::class, 'destroy'])->name('delete');
});


//MiddleWare Routes After Admin Login Successfully
Route::middleware(['isAdmin', 'is_verified'])->group(function () {

    Route::get('post', [AdminController::class, 'index'])->name('post');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('/orders', [AdminController::class, 'orders'])->name('userorders');
    Route::get('deliver/{id}', [AdminController::class, 'deliver'])->name('deliver');

    Route::get('ban/{id}', [AdminController::class, 'banned'])->name('ban');
    Route::get('unban/{id}', [AdminController::class, 'unbanned'])->name('unban');

    Route::get('accept/{id}', [AdminController::class, 'accept'])->name('accept');
    Route::get('reject/{id}', [AdminController::class, 'reject'])->name('reject');
});
