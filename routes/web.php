<?php
use Symfony\Component\HttpFoundation\Session\Session;

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

Route::get('/', function () {
    request()->session()->forget('flash');
});
Route::get('/','HomeController@index');
Auth::routes();

// confirm email affter user register
Route::get('/register/confirm','ConfirmTokenController@index')->name('register.confirm');

// view user and admin
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/admin/home','admin')->name('admin')->middleware('auth:admin');

//Action login admin
Route::get('/admin/login','Admin\LoginController@showAdminLoginForm')->name('get.login');
Route::post('/admin/login','Admin\LoginController@login')->name('admin.login');
Route::post('/admin/logout','Admin\LoginController@logout')->name('admin.logout');
// action register admin
// Route::get('/admin/register','Auth\RegisterController@showAdminRegisterForm')->name('get.register');
// Route::post('/admin/register','Auth\RegisterController@createAdmin')->name('admin.register');

Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin'], function() {
    // Action Admin
    // Action categories
    Route::get('/categories','CategoryController@index')->name('product.categories');
    Route::post('/categories/store','CategoryController@store')->name('categories.store');
    Route::delete('/categories/delete/{id}','CategoryController@destroy')->name('categories.delete')->where('id', '[0-9]+');
    Route::get('/categories/edit/{id}','CategoryController@edit')->name('categories.edit')->where('id', '[0-9]+');
    Route::patch('/categories/edit/{id}','CategoryController@update')->name('categories.update')->where('id', '[0-9]+');
    Route::get('/paginate/categories/','CategoryController@paginate')->name('categories.paginate');
    // Action product
    Route::get('/product/create','ProductController@create')->name('product.create');
    Route::get('/product/show','ProductController@show')->name('product.show');
    Route::post('/product/store','ProductController@store')->name('product.store');
    Route::delete('/product/{id}','ProductController@destroy')->name('product.delete')->where('id', '[0-9]+');
    Route::get('/product/{id}','ProductController@edit')->name('product.edit')->where('id', '[0-9]+');
    Route::patch('/product/{id}','ProductController@update')->name('product.update')->where('id', '[0-9]+');
    Route::post('/image/upload', 'UploadImageController@uploadImage')->name('image.upload');
    Route::get('/paginate/product','ProductController@paginate')->name('product.paginate');
    Route::post('/product/search','ProductController@search')->name('product.search');

    // user
    Route::get('/user','UserController@index')->name('user.index');
    Route::get('/paginate/user','UserController@paginate')->name('user.paginate');
    Route::get('/user/locked/{id}','AdminController@locked')->name('user.locked')->where('id', '[0-9]+');
    Route::get('/user/unlocked/{id}','AdminController@unlocked')->name('user.unlocked')->where('id', '[0-9]+');
    Route::get('/user/activity','UserController@indexActivity')->name('user.activity');
    Route::post('/user/search','AdminController@search')->name('user.search');
    Route::delete('/user/delete/{id}','AdminController@destroy')->name('user.destroy')->where('id', '[0-9]+');
    //order
    Route::get('/order','OrderController@index')->name('order.index');
    Route::get('/show/order/','AdminController@showAllOrder')->name('user.show.order')->where('id', '[0-9]+');
    Route::get('/user/{id}','UserController@show')->name('user.show');

    Route::patch('/confirm/order/{order_id}','OrderController@confirmOrder')->name('user.confirm.order')->where('id', '[0-9]+');
    Route::patch('/delivery/order/{order_id}','OrderController@deliveryOrder')->name('user.delivery.order')->where('id', '[0-9]+');
    Route::patch('/cancel/order/{order_id}','OrderController@cancelOrder')->name('user.cancel.order')->where('id', '[0-9]+');
    Route::delete('/delete/order/{order_id}','OrderController@deleteOrder')->name('user.delete.order')->where('id', '[0-9]+');
    Route::post('/order/search','OrderController@searchOrder')->name('user.search.order');
});



 // File manager
 Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::get('/laravel-filemanager/folders', '\UniSharp\LaravelFilemanager\Controllers\FolderController@getFolders');
    Route::get('/laravel-filemanager/jsonitems', '\UniSharp\LaravelFilemanager\Controllers\ItemsController@getItems');
    Route::get('/laravel-filemanager/errors', '\UniSharp\LaravelFilemanager\Controllers\LfmController@getErrors');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});

// User

Route::group(['middleware'=>'auth'], function() {
    //
    Route::get('/profile/{id}','UserController@show')->name('user.profile')->where('id', '[0-9]+');
    Route::patch('/update/info/{id}','UserController@update')->name('user.update.info')->where('id', '[0-9]+');
    Route::get('/show/order/{id}','UserController@showOrder')->name('user.show.order')->where('id', '[0-9]+');
    Route::patch('/cancel/order/{order_id}','OrderController@cancelOrder')->name('user.cancel.order')->where('id', '[0-9]+');
    Route::post('/buy','OrderController@buyIt')->name('user.buy');
    Route::get('/cart','CartController@index')->name('user.cart');
    Route::get('/cart/get','CartController@getCart')->name('user.getcart');
    Route::post('/cart/add/{id}','CartController@addToCart')->name('user.addcart')->where('id', '[0-9]+');
    Route::post('/cart/minus/{id}','CartController@minusQuantity')->name('user.minus.quatity')->where('id', '[0-9]+');
    Route::post('/cart/plus/{id}','CartController@plusQuantity')->name('user.plus.quatity')->where('id', '[0-9]+');
    Route::delete('/cart/delete/{id}','CartController@delete')->name('user.plus.quatity')->where('id', '[0-9]+');
});
