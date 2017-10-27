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
    //return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//-----------------------------------------------------------------
//Route::resource('rubros', 'RubroController', ['except'=>['create', 'edit']]);

Route::group(['middleware' => 'auth'], function (){
	Route::resource('usuarios', 'UserController', ['except' => ['create', 'show']]);
	Route::resource('roles', 'RolController', ['except' => ['show']]);
	Route::resource('equipos', 'EquipoController', ['except' => ['create', 'show']]);
	Route::resource('materiales', 'MaterialController', ['except' => ['create', 'show']]);
	Route::resource('mano_de_obra', 'ManoDeObraController', ['except' => ['create', 'show']]);
	Route::resource('transportes', 'TransporteController', ['except' => ['create', 'show']]);
	Route::resource('biblioteca_apus', 'BiblioApusController');
	Route::resource('proyecto', 'ProyectoController');
	//-----------------------------------------------------------------------------------------
	Route::resource('categoria', 'CategoriaController');
	Route::prefix('categoria')->group(function (){
		Route::post('copia/{apu}/{categoria}', 'CategoriaController@copia');
	});
	//-----------------------------------------------------------------------------------------
	Route::resource('apu', 'ApuController');
	Route::prefix('apu')->group(function (){
		Route::get('excel/{apu}', 'ApuController@exportarExcel');
	});
});