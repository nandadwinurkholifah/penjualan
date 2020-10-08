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

use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(["get","post"],"/register",function(){
    return redirect('login');
})->name("register");

Route::resource('user','UserController');

Route::resource('supplier', 'SupplierController');
Route::resource('pegawai', 'PegawaiController');
Route::resource('kategori', 'KategoriController');
Route::resource('produk','ProdukController');
