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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'ContactController@contact')->name('contact');
Route::post('/contact', 'ContactController@send_contact');

Route::group(['namespace' => 'Admin', 'middleware' => 'web', 'prefix' => 'admin', 'as' => 'admin.'], function(){
   Route::group(['middleware' => 'admin'], function(){
      Route::get('orders', 'OrderController@index')->name('ordenes');
      Route::get('list_orders', 'OrderController@list_orders')->name('listar_ordenes');
      Route::get('validate/{id}', 'OrderController@validate_order');
      Route::get('delete/{id}', 'OrderController@delete_order');

      Route::get('rates', 'RateController@index')->name('tasas');
      Route::get('list_rates', 'RateController@list_rates')->name('listar_tasas');
      Route::post('create_rate', 'RateController@create_rate');

      Route::get('banks', 'BankController@index')->name('bancos');
      Route::get('list_banks', 'BankController@list_banks')->name('listar_bancos');

      Route::get('users', 'UserController@index')->name('usuarios');
      Route::get('list_users', 'UserController@list_users')->name('listar_usuarios');

      Route::post('deposit', 'DepositController@create_deposit');
   });

   Route::get('demand', 'DemandController@create')->name('solicitud');
   Route::post('create_demand', 'DemandController@create_demand');

   Route::get('accounts', 'AccountController@index')->name('cuentas');
   Route::get('account/create', 'AccountController@create')->name('cuenta.crear');
   Route::post('create_account', 'AccountController@create_account')->name('cuenta.almacenar');
   Route::get('get_accounts', 'AccountController@list_accounts');
   Route::post('update_account', 'AccountController@update_account');
   Route::delete('delete_account/{id}', 'AccountController@delete_account');


   Route::get('demands', 'DemandController@index')->name('solicitudes');
   Route::get('list_demands', 'DemandController@list_demands');

   Route::post('transfer', 'TransferController@create_transfer');

   Route::post('bank/search', 'BankController@view');
});

//List of routes for Axios
Route::get('rate', 'RateController@show');