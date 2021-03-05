<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;

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



// Route::get('admin/login', [AdminController::class, 'getLogin'])->middleware('check.admin.logout')->name('admin.get.login');

Route::get('admin/login', [UserController::class, 'getLogin'])->middleware('check.admin.logout')->name('get.admin.login');
Route::post('admin/login', [UserController::class, 'postLogin'])->name('post.admin.login');
Route::get('admin/logout', [UserController::class, 'logout'])->name('admin.logout');

Route::prefix('admin/')->middleware('check.admin.login')->group(function(){
	Route::resource('category', CategoryController::class);
	Route::get('category/status/{id}', [CategoryController::class, 'editStatus'])->name('category.status');
	
	Route::resource('brand', BrandController::class);
	Route::get('brand/status/{id}', [BrandController::class, 'editStatus'])->name('brand.status');

	Route::resource('slider', SliderController::class);
	Route::get('slider/status/{id}', [SliderController::class, 'editStatus'])->name('slider.status');

	Route::resource('product', ProductController::class);
	Route::get('product/status/{id}', [ProductController::class, 'editStatus'])->name('product.status');
	Route::post('product/ajax', [ProductController::class, 'ajaxCategory'])->name('product.ajax');

	Route::get('order', [OrderController::class, 'index'])->name('order.index');
	Route::get('order/status/{id}', [OrderController::class, 'editStatus'])->name('order.status');
	Route::delete('order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
	Route::get('order-detail/{id}', [OrderController::class, 'getOrderDetail']);

	Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
	Route::delete('customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

});


// frontend
Route::get('', [FrontendController::class, 'index']);
Route::get('detail/{id}/{slug}.html', [FrontendController::class, 'getDetail'])->name('detail');
Route::get('product/{slug}.html', [FrontendController::class, 'getProductCategory'])->name('product.category');
Route::get('product/{id}/{slug}.html', [FrontendController::class, 'getProductBrand'])->name('product.brand');

Route::get('login', [CustomerController::class, 'getLogin']);
Route::post('login', [CustomerController::class, 'postLogin']);
Route::get('register', [CustomerController::class, 'getRegister']);
Route::post('register', [CustomerController::class, 'postRegister']);

Route::middleware('check.client.login')->group(function(){
	Route::get('logout', [CustomerController::class, 'getLogout']);
	Route::get('setting', [CustomerController::class, 'getSetting']);
	Route::post('setting', [CustomerController::class, 'postSetting']);
	Route::get('change-password', [CustomerController::class, 'getChangePassword']);
	Route::post('change-password', [CustomerController::class, 'postChangePassword']);
	
	Route::get('order', [CustomerController::class, 'getOrder']);
	Route::get('order/{id}', [CustomerController::class, 'getOrderDetail']);

	Route::prefix('cart/')->group(function(){
		Route::get('index', [CartController::class, 'index']);
		Route::get('add/{id}', [CartController::class, 'addCart']);
		Route::post('update', [CartController::class, 'updateCart']);
		Route::get('delete/{id}', [CartController::class, 'deleteCart']);
		Route::get('confirm', [CartController::class, 'getConfirm']);
		Route::get('complete', [CartController::class, 'complete']);
	});
});


// Route::get('detail/{slug}.html', [FrontendController::class, 'getDetail']);
// Route::post('detail/{slug}.html', [FrontendController::class, 'postComment'])->name('post.comment');
// Route::get('category/{id}/{slug}.html', [FrontendController::class, 'getCategory']);
// Route::get('search', [FrontendController::class, 'getSearch']);

// Route::prefix('cart/')->group(function(){
// 	Route::get('add/{id}', [CartController::class, 'getAddCart']);
// 	Route::get('show', [CartController::class, 'getShowCart']);
// 	Route::get('update', [CartController::class, 'getUpdateCart']);
// 	Route::get('delete/{rowId}', [CartController::class, 'getDeleteCart']);
// 	Route::post('show', [CartController::class, 'postComplete']);
// 	Route::get('complete', [CartController::class, 'getComplete']);
// });













