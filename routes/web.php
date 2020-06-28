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

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('laundry/receipt/{id}', 'LaundryController@receipt')->name('receipt');
	Route::get('laporan/pembelian', 'PembelianController@laporan')->name('laporanpembelian');
	Route::get('laporan/laundry', 'PemakaianController@laporan')->name('laporanlaundry');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::resource('supplier', 'SupplierController');
	Route::resource('customer', 'CustomerController');
	Route::resource('item', 'ItemController');
	Route::resource('layanan', 'LayananController');
	Route::resource('pembelian', 'PembelianController');
	Route::resource('pemakaian', 'PemakaianController');
	Route::resource('laundry', 'LaundryController');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});
