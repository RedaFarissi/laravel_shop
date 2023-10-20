<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerContact;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\controllerProduct;
use App\Http\Controllers\ControllerCart;
use App\Http\Controllers\ControllerDashboard;


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
        Route::get('/contact/list/', "list")->middleware('super_admin')->name('contact_list');
        Route::get('/contact/create', "create")->name('contact_create');
        Route::post('/contact/store/', "store")->name('contact_store');
    });
});


Route::controller(ControllerCart::class)->group(function(){
    Route::get('/cart', "cart_view")->name('cart_view');
});
