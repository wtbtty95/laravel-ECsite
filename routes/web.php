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


Auth::routes();

//userログイン前
Route::get('/', 'User\ItemController@index')->name('index');
Route::get('/detail', 'User\ItemController@detail')->name('detail');

//userログイン後
Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/home', 'User\HomeController@index')->name('home');
	Route::post('/detail', 'User\CartController@add')->name('add');
	Route::get('/index', 'User\CartController@index')->name('cart.index');
	Route::post('/index', 'User\CartController@delete')->name('cart.delete');
	Route::get('/address', 'User\AddressController@index')->name('address.index');
	Route::post('/address', 'User\AddressController@delete')->name('address.delete');
	Route::get('/address/add', 'User\AddressController@add')->name('address.add');
	Route::post('/address/add', 'User\AddressController@addressInsert')->name('address.insert');
	Route::get('/address/edit', 'User\AddressController@addressEdit')->name('address.edit');
	Route::post('/address/edit', 'User\AddressController@update')->name('address.update');
	Route::get('/address/select', 'User\AddressController@select')->name('address.select');
	Route::post('/address/select', 'User\AddressController@addressSelectInsert')->name('address.select.insert');
	Route::get('/user/edit', 'User\EmailResetController@edit')->name('user.edit');
	Route::post('/user/edit', 'User\EmailResetController@update')->name('user.update');
	Route::get('/email/reset/{token}', 'User\EmailResetController@reset')->name('email.reset');
	Route::post('/order', 'User\OrderController@selectedAddress')->name('order');
});

//adminログイン前
Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () {
		return redirect('/');
	});
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

//adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('/', 'Admin\AdminItemController@index')->name('admin.index');
	Route::get('/detail', 'Admin\AdminItemController@detail')->name('admin.item.detail');
	Route::get('/add', 'Admin\AdminItemController@add')->name('admin.item.add');
	Route::post('/add', 'Admin\AdminItemController@insert')->name('admin.item.insert');
	Route::get('/detail/edit', 'Admin\AdminItemController@edit')->name('admin.item.edit');
	Route::post('/detail/edit', 'Admin\AdminItemController@update')->name('admin.item.update');
	Route::post('/', 'Admin\AdminItemController@forceDelete')->name('admin.item.delete');
	Route::get('/user', 'Admin\UserController@index')->name('admin.user.index');
	Route::get('/user/detail/{id}', 'Admin\UserController@detail')->name('admin.user.detail');
});
