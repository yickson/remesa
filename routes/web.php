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
    return view('welcome');
});

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'middleware' => 'web', 'prefix' => 'admin', 'as' => 'admin.'], function(){
   Route::group(['middleware' => 'admin'], function(){
      Route::get('orders', 'OrderController@index')->name('ordenes');
      Route::get('list_orders', 'OrderController@list_orders')->name('listar_ordenes');

      Route::get('rates', 'RateController@index')->name('tasas');
      Route::get('list_rates', 'RateController@list_rates')->name('listar_tasas');

      Route::get('banks', 'BankController@index')->name('bancos');
      Route::get('list_banks', 'BankController@list_banks')->name('listar_bancos');

      Route::get('users', 'UserController@index')->name('usuarios');
      Route::get('list_users', 'UserController@list_users')->name('listar_usuarios');
   });

   Route::get('demand', 'DemandController@create')->name('solicitud');

   Route::get('accounts', 'AccountController@index')->name('cuentas');

   Route::get('demands', 'DemandController@index')->name('solicitudes');
   Route::get('list_demands', 'DemandController@list_demands');
});
