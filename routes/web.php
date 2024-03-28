<?php

use Illuminate\Support\Facades\Route;

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

//Fontend

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/index.html', 'App\Http\Controllers\HomeController@index');
Route::get('/product/{id}', 'App\Http\Controllers\HomeController@products');

//Hiển thị danh mục
Route::get('danhmuc/{slug}/{id}', 'App\Http\Controllers\HomeController@danhmuc');

//Thêm sản phẩm vào giỏ hàng
Route::post('/save-cart', 'App\Http\Controllers\HomeController@savecart');
Route::post('/update-cart', 'App\Http\Controllers\HomeController@update_cart');
Route::post('/delete-cart', 'App\Http\Controllers\HomeController@delete_cart');
Route::get('/shopping-cart', 'App\Http\Controllers\HomeController@shoppingcart');


//Trang admin
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::post('/admin/logining', 'App\Http\Controllers\AdminController@logining');
Route::get('/admin/login', 'App\Http\Controllers\AdminController@index');
Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@show_dashboard')->name('admin.dashboard');
Route::get('/admin/dashboard/{username}', 'App\Http\Controllers\AdminController@show_dashboard')->name('admin.dashboard');

//Category - Quản lý danh mục sản phẩm
Route::get('admin/all-category', 'App\Http\Controllers\CategoryController@all_category')->name('admin.all_category');
Route::get('admin/add-category', 'App\Http\Controllers\CategoryController@add_category')->name('admin.add_category');
Route::post('admin/add-category', 'App\Http\Controllers\CategoryController@add_category_post');
Route::get('admin/update-category/{id}', 'App\Http\Controllers\CategoryController@update_category');
Route::post('admin/update-category/{id}', 'App\Http\Controllers\CategoryController@update_category_post');
Route::get('admin/delete-category/{id}', 'App\Http\Controllers\CategoryController@delete_category')->name('admin.delete_category');

//Product - Sản phẩm
Route::get('admin/all-product', 'App\Http\Controllers\ProductController@all_product')->name('admin.all_product');
Route::get('admin/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::post('admin/add-product', 'App\Http\Controllers\ProductController@add_product_post');
Route::get('admin/update-product/{id}', 'App\Http\Controllers\ProductController@update_product')->name('admin.update_product');
Route::post('admin/update-product/{id}', 'App\Http\Controllers\ProductController@update_product_post');
Route::get('admin/delete-product/{id}', 'App\Http\Controllers\ProductController@delete_product')->name('admin.delete_product');

//GRN_Receipt_Controller - Phiếu nhập kho (GRN)
Route::get('admin/all-GRN', 'App\Http\Controllers\GRN_Receipt_Controller@all_GRN');
Route::get('admin/add-GRN', 'App\Http\Controllers\GRN_Receipt_Controller@add_GRN');
Route::post('admin/adding-GRN', 'App\Http\Controllers\GRN_Receipt_Controller@adding_GRN');
Route::get('admin/update-GRN/{id}', 'App\Http\Controllers\GRN_Receipt_Controller@update_GRN');
Route::post('admin/updating-GRN', 'App\Http\Controllers\GRN_Receipt_Controller@updating_GRN');
Route::get('admin/remove-GRN/{id}', 'App\Http\Controllers\GRN_Receipt_Controller@remove_GRN');;

//Đơn hàng
Route::get('admin/all-receipt', 'App\Http\Controllers\GRN_Receipt_Controller@all_receipt');
Route::get('admin/view-receipt/{id}', 'App\Http\Controllers\GRN_Receipt_Controller@view_receipt');
Route::post('admin/updating-receipt', 'App\Http\Controllers\GRN_Receipt_Controller@updating_receipt');
Route::get('admin/update-receipt/{id}', 'App\Http\Controllers\GRN_Receipt_Controller@update_receipt');
Route::get('admin/remove-receipt/{id}', 'App\Http\Controllers\GRN_Receipt_Controller@remove_receipt');;


//Đặt hàng
Route::post('/order', 'App\Http\Controllers\GRN_Receipt_Controller@order');
Route::get('/check-out', 'App\Http\Controllers\GRN_Receipt_Controller@checkout');
