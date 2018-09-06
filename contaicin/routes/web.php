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

Route::get('/', 'CuentaController@index');

Route::get('/plantilla', function(){
  return view('plantilla');
});

Route::resource('cuentas', 'CuentaController');

Route::resource('asientos_contables', 'AsientosController');

Route::get('/balance_general', 'BalanceController@general')->name('balance_general');

Route::get('/estado_resultado', 'BalanceController@estado_resultado')->name('estado_resultado');

Route::get('/balance_tributario', 'BalanceController@tributario')->name('balance_tributario');
