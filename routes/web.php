<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerContact;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\controllerProduct;
use App\Http\Controllers\ControllerCart;
use App\Http\Controllers\ControllerOrder;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\StripePaymentController;

Route::controller(ControllerDashboard::class)->group(function(){
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', "dashboard")->name('dashboard');
        Route::get('dashboard/product/delete/{id}', "dashboard_product_delete")->name('dashboard_product_delete');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::resource("/products", controllerProduct::class);

Route::controller(ControllerHome::class)->group(function(){
    Route::get('/', "home")->name('home');
    Route::get('home/categories/{category_id}', "home_category_by_id")->name('home_category_by_id');
    Route::get('/about', "about")->name('about');
});

Route::controller(ControllerContact::class)->group(function(){
    Route::middleware('auth')->group(function () {
        Route::get('/contact/list', "list")->middleware('super_admin')->name('contact_list');
        Route::get('/contact/create', "create")->name('contact_create');
        Route::post('/contact/store', "store")->name('contact_store');
    });
});


Route::controller(ControllerCart::class)->group(function(){
    Route::get('/cart', "cart_view")->name('cart_view');
    Route::post('/cart/add/{product_id}', "cart_add")->name('cart_add');
    Route::get('/cart/delete/{cart_id}', "delete_cart_id")->name('delete_cart_id');
    Route::get('/cart/clear', "cart_clear")->name('cart_clear');
    Route::get('/cart/empty', "cart_empty")->name('cart_empty');
});


Route::controller(ControllerOrder::class)->group(function(){
    Route::get('/order', "order_view")->name('order_view');
    Route::post('/order/store', "order_store")->name('order_store');
});


Route::controller(PaypalPaymentController::class)->prefix('paypal')->group(function () {
    Route::get('handle-payment', 'handlePayment')->name('make.payment');
    Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
    Route::get('payment-success', 'paymentSuccess')->name('success.payment');
});


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('payment/view', 'payment_view')->name('payment_view');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});