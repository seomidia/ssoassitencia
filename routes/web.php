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
//ANAMINESE  get-------------------
Route::get('/admin/anaminese', 'AnamineseController@index')->name('voyager.anaminese');
Route::get('/admin/anaminese/cadastro/{anaminese}', 'AnamineseController@cadastro')->name('voyager.anaminese.cadastro');
Route::get('/json/getcompany/{cnpj}', 'CompanyController@getEmpresa')->name('voyager.getEmpresa');

// pessoal get --------------------
Route::post('/json/getpessoa/{cpf}', 'PeopleController@getPessoa')->name('voyager.getPeople');
Route::post('/json/create-pessoa', 'PeopleController@CreatePessoa')->name('voyager.create.People');



Route::post('/admin/office', 'OfficeController@store')->name('voyager.office.store');
Route::post('/admin/office-update', 'OfficeController@update')->name('voyager.office.update');
Route::post('/admin/anaminese-questions', 'AnamineseQuestionController@store')->name('voyager.anaminesequestion.store');
Route::post('/admin/anaminese-questions-update', 'AnamineseQuestionController@update')->name('voyager.anaminesequestion.update');
Route::get('/admin/area-cliente-avulso', 'AreasController@Cliente')->name('voyager.area.cliente');
Route::get('/admin/area-rh', 'AreasController@Cliente')->name('voyager.area.rh');
Route::get('/admin/anaminese', 'AnamineseController@index')->name('voyager.anaminese');
Route::post('/admin/create-anaminesis', 'AnamineseController@create')->name('voyager.create.anaminese');
Route::get('/admin/servicos', 'ServicesController@index')->name('voyager.services');


