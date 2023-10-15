<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ControllerAdmin;
use App\Http\Controllers\Admin\ControllerAdminCategory;
use App\Http\Controllers\Admin\ControllerAdminProduct;
use App\Http\Controllers\Admin\ControllerAdminSize;
use App\Http\Controllers\Admin\ControllerAdminUser;


//home 
Route::controller(ControllerAdmin::class)->group(function(){
    Route::get('/admin/home', "admin_home")->name('admin_home');     
});

//users
Route::controller(ControllerAdminUser::class)->group(function(){
    Route::get('admin/users/list', "admin_users_list")->name('admin_users_list');
    Route::get('admin/user/create/view', "admin_user_create_views")->name('admin_user_create_views');
    Route::post('admin/user/create/store', "admin_user_create_store")->name('admin_user_create_store');
    Route::get('admin/user/edit/{id}/views', "admin_user_edit_views")->name('admin_user_edit_views');
    Route::get('admin/user/delete/{id}', "admin_user_delete")->name('admin_user_delete');
    Route::post('admin/users/delete/selected', "admin_users_delete_selected")->name('admin_users_delete_selected');
});

//products
Route::controller(ControllerAdminProduct::class)->group(function(){
    Route::get('admin/products/list', "admin_products_list")->name('admin_products_list');
    Route::get('admin/product/create/view', "admin_product_create_views")->name('admin_product_create_views');
    Route::post('admin/product/create/store', "admin_product_create_store")->name('admin_product_create_store');
    Route::get('admin/product/edit/{id}/views', "admin_product_edit_views")->name('admin_product_edit_views');
    Route::put('admin/product/edit/{id}', "admin_product_edit")->name('admin_product_edit');
    Route::get('admin/product/delete/{id}', "admin_product_delete")->name('admin_product_delete');
    Route::post('admin/products/delete/selected', "admin_products_delete_selected")->name('admin_products_delete_selected');
});

//caterories
Route::controller(ControllerAdminCategory::class)->group(function(){
    Route::get('admin/caterories/list', "admin_categories_list")->name('admin_categories_list');
    Route::get('admin/category/create/view', "admin_category_create_views")->name('admin_category_create_views');
    Route::post('admin/category/create/store', "admin_category_create_store")->name('admin_category_create_store');
    Route::get('admin/category/edit/{id}/views', "admin_category_edit_views")->name('admin_category_edit_views');
    Route::put('admin/category/edit/{id}', "admin_category_edit")->name('admin_category_edit');
    Route::get('admin/category/delete/{id}', "admin_category_delete")->name('admin_category_delete');
    Route::post('admin/categories/delete/selected', "admin_categories_delete_selected")->name('admin_categories_delete_selected');
});

//sizes
Route::controller(ControllerAdminSize::class)->group(function(){
    Route::get('admin/sizes/list', "admin_sizes_list")->name('admin_sizes_list');
    Route::get('admin/size/create', "admin_size_create_views")->name('admin_size_create_views');
    Route::post('admin/size/create/store', "admin_size_create_store")->name('admin_size_create_store');
    Route::get('admin/size/edit/{id}/views', "admin_size_edit_views")->name('admin_size_edit_views');
    Route::put('admin/size/edit/{id}', "admin_size_edit")->name('admin_size_edit');
    Route::get('admin/size/delete/{id}', "admin_size_delete")->name('admin_size_delete');
    Route::post('admin/sizes/delete/selected', "admin_sizes_delete_selected")->name('admin_sizes_delete_selected');
});

?>