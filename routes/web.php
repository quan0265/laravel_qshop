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

	Route::get('{name}/status/{id}', [CategoryController::class, 'editStatus'])->name('edit.status');

	Route::resource('category', CategoryController::class);
	Route::resource('brand', BrandController::class);
	Route::resource('slider', SliderController::class);
	Route::resource('product', ProductController::class);
	Route::post('product/ajax', [ProductController::class, 'ajaxCategory'])->name('product.ajax');

	Route::get('order', [OrderController::class, 'index'])->name('order.index');
	Route::get('order-status/{id}', [OrderController::class, 'editStatus'])->name('order.status');
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
Route::get('search', [FrontendController::class, 'getSearch'])->name('product.search');

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













