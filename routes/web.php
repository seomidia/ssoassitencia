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



Route::get('/', 'HomeController@index')->name('home');
Route::get('/empresa', 'EmpresaController@index')->name('empresa');
Route::get('/carrinho', 'CartController@index')->name('cart');
Route::post('/carrinho/add', 'CartController@add')->name('cart-add');
Route::post('/carrinho-update/{product}', 'CartController@update')->name('cart-update');
Route::get('/carrinho-delete/{product}', 'CartController@destroy')->name('cart-destroy');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/get-company', 'CheckoutController@Autocomplete')->name('autocomplete');
Route::post('/finalizar', 'CheckoutController@finalizar')->name('finalizar');
Route::get('/obrigado', 'CheckoutController@obrigado')->name('obrigado');
Route::post('/company-store', 'CompanyController@store')->name('company-store');
Route::get('/produto/{slug}', 'ProductController@Single')->name('single');
Route::get('/contato', 'ContatoController@index')->name('contato');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Auth::routes();
//voyager -------------------
Route::get('/admin/pedidos','OrderController@index');


