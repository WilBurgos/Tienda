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

//Auth::routes();

// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('almacen', 'AlmacenController');

Route::get('proveedor/get_proveedores','ProveedorController@json_proveedores')->name('prov.get_provs');
Route::resource('proveedor', 'ProveedorController');

Route::get('producto/get_productos','ProductoController@json_productos')->name('prod.get_prods');
Route::resource('producto','ProductoController');

Route::get('administracion/get_usuarios','AdministracionController@json_users')->name('admin.get_users');
Route::resource('administracion', 'AdministracionController');

Route::get('ventas/get_ventas','VentasController@json_ventas')->name('ventas.get_ventas');
Route::post('ventas/get_ventasFechas','VentasController@json_ventasFechas')->name('ventas.get_ventasFechas');
Route::resource('ventas', 'VentasController');

Route::get('ordenes/get_ordenes','OrdenesController@json_ordenes')->name('ordenes.get_ordenes');
Route::post('ordenes/cerrar_orden','OrdenesController@cerrarOrden')->name('ordenes.cerrarOrden');
Route::resource('ordenes', 'OrdenesController');

Route::resource('pruebas', 'PruebasController');
