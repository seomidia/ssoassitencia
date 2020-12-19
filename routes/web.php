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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
//voyager ------------------- 
Route::get('/vendor/voyager/orders','OrderController@index');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/empresa', 'EmpresaController@index')->name('empresa');
Route::get('/carrinho', 'CartController@index')->name('cart');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
