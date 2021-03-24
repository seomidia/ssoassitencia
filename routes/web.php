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
Route::get('/json/getcompany/{cnpj}', 'CompanyController@getEmpresa')->name('voyager.getEmpresa');

// pessoal get --------------------
Route::post('/json/getpessoa/{cpf}', 'PeopleController@getPessoa')->name('voyager.getPeople');
Route::post('/json/create-pessoa', 'PeopleController@CreatePessoa')->name('voyager.create.People');

// ger ambiente de trabalho ------------------
Route::get('/json/getworkplace', 'WorkplaceController@getworkplace')->name('voyager.get.workplace');

// get section ------------------
Route::get('/json/getSection', 'AnamineseQuestionController@getSection')->name('voyager.get.section');

// get section ------------------
Route::get('/json/getParent', 'AnamineseQuestionController@getParent')->name('voyager.get.parent');

// ger cargo ------------------
Route::get('/json/getCargo', 'OfficeController@getCargo')->name('voyager.get.cargo');

// ger medico ------------------
Route::get('/json/getMedicos', 'UserController@getMedico')->name('voyager.get.medico');


Route::post('/admin/office', 'OfficeController@store')->name('voyager.office.store');
Route::post('/admin/office-update', 'OfficeController@update')->name('voyager.office.update1');
Route::post('/admin/anaminese-questions', 'AnamineseQuestionController@store')->name('voyager.anaminesequestion.store');
Route::post('/admin/anaminese-questions-update', 'AnamineseQuestionController@update')->name('voyager.anaminesequestion.update');
Route::get('/admin/area-cliente-avulso', 'AreasController@Cliente')->name('voyager.area.cliente');
Route::get('/admin/area-rh', 'AreasController@Cliente')->name('voyager.area.rh');
Route::get('/admin/encaminhamento', 'AnamineseController@index')->name('voyager.encaminhamento');
Route::get('/admin/encaminhamento/cadastro/{anamnese}', 'AnamineseController@cadastro')->name('voyager.encaminhamento.cadastro');
Route::post('/admin/encaminhamento', 'AnamineseController@create')->name('voyager.create.encaminhamento');
Route::post('/admin/encaminhamento/{encaminhamento}', 'AnamineseController@updade')->name('voyager.update.encaminhamento');
Route::post('/admin/encaminhamento/{encaminhamento}/delete', 'AnamineseController@destroy')->name('voyager.delete.encaminhamento');
Route::get('/admin/servicos', 'ServicesController@index')->name('voyager.services');

//funcionario -------------------

Route::get('/admin/funcionario/anaminese', 'AnamineseController@indexfunc')->name('voyager.funcionario.anaminese');
Route::get('/admin/anaminese/questionario/{anamnese}', 'AnamineseController@question')->name('voyager.funcionario.question');
Route::post('/admin/anaminese/questionario/', 'AnamineseController@questionStore')->name('voyager.funcionario.question.response');
Route::post('/admin/anaminese/devolver', 'AnamineseController@devolver')->name('voyager.funcionario.anaminese.devolver');
Route::get('/admin/anamnese/atestado/{anamnese}', 'AnamineseController@atestado')->name('voyager.anaminese.atestado');
Route::get('/admin/anaminese/cadastro/{anaminese}', 'AnamineseController@cadastro')->name('voyager.anaminese.cadastro');


// busca medico --------------------------------
Route::get('/admin/buscar', 'AnamineseController@busca')->name('voyager.busca');
Route::post('/admin/feedback-medico', 'AnamineseController@feedbackMedico')->name('feedback.medico');


