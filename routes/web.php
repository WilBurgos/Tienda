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

Route::get('/', function () {
	if( !Auth::user() ){
    	return view('auth.login');
	}else{
		return view('inicio');
	}
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/register', 'Auth\RegisterController@index')->name('register');

Route::resource('almacen', 'AlmacenController');

Route::get('proveedor/get_proveedores','ProveedorController@json_proveedores')->name('prov.get_provs');
Route::resource('proveedor', 'ProveedorController');


