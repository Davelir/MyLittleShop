<?php

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

use Illuminate\Support\Facades\Route;


Route::get('/','IndexController@index')->name('index');

/**
 * Contact
 */
Route::get('/contact','ContactController@index');

/**
 * Register
 */

Route::get('/register','RegisterController@index');
Route::post('/register','RegisterController@register');
/**
 * Login
 */
Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

/**
 * Account
 */

Route::get('/account','AccountController@index')->middleware('auth');
Route::post('/account/change_password','AccountController@changePassword')->middleware('auth');

 /**
  * Product page
  */

Route::get('/{product_alias},{product_id}','ProductController@index')->where(['product_id' => '\d+']);
Route::post('/product/{id}/add_review','ProductController@addReview')->middleware('auth');

  /**
   * Cart
   */

Route::post('/cart/add','CartController@add');
Route::post('/cart/remove','CartController@remove');
Route::get('/cart','CartController@index');
Route::post('/cart/update','CartController@update');

/**
 * Catalog
 */

 Route::get('/category','CategoryController@category');
 Route::get('/category/{category_alias},{category_id}','CategoryController@category')->where(['category_id' => '\d+']);

 /**
  * Order
  */
Route::post('/order','OrderController@create');
Route::get('/orders','OrderController@list')->middleware('auth');
Route::get('/order/{hash}','OrderController@details')->name('orderDetails');

 /**
  * Admin
  */

Route::prefix('admin')->middleware('authAdmin')->group(function () {
    // Dashboard
    Route::get('/', 'Admin\AdminController@index');

    //Produkty
    Route::get('/product/list', 'Admin\ProductController@list')->name('adminProductList');
    Route::post('/product/create', 'Admin\ProductController@create')->name('AdminProductNew');
    Route::get('/product/{id}/edit', 'Admin\ProductController@edit')->where(['id' => '\d+'])->name('AdminProductEdit');
    Route::post('/product/{id}/edit', 'Admin\ProductController@save')->where(['id' => '\d+']);

    //Zamówienia

    Route::get('/order/list','Admin\OrderController@list')->name('adminOrderList');
    Route::get('/order/{id}','Admin\OrderController@details')->name('adminOrderDetails');
    Route::post('/order/{id}','Admin\OrderController@edit')->name('adminOrderEdit');

    // Kategorie
    Route::get('/category/list','Admin\CategoryController@list')->name('adminCategoryList');
    Route::post('/category/create','Admin\CategoryController@create')->name('adminCategoryCreate');
    Route::get('/category/{id}/edit','Admin\CategoryController@edit')->name('AdminCategoryEdit');
    Route::post('/category/{id}/edit','Admin\CategoryController@save')->name('adminCategorySave');

    //Użytkownicy
    Route::get('/user/list','Admin\UserController@list')->name('adminUserList');
    Route::get('/user/{id}','Admin\UserController@details')->name('adminUserDetails');
    Route::post('/user/{id}','Admin\UserController@edit')->name('adminUserDEdit');
});
