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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('api/postulante', 'PostulanteController');
Route::resource('api/convocatoria', 'ConvocatoriaController');

Route::resource('api/pais', 'PaisController');
Route::get('api/paisporid/{idpais}', 'PaisController@indexById');

Route::resource('api/tipodocumentoidentidad', 'TipoDocumentoIdentidadController');
Route::get('api/tipodocumentoidentidadporid/{idtipodocumentoidentidad}', 'TipoDocumentoIdentidadController@indexById');

Route::resource('api/departamento', 'DepartamentoController');
Route::get('api/departamentoporpais/{idpais}', 'DepartamentoController@indexByIdPais');

Route::get('api/provinciapordepartamento/{iddepartamento}', 'ProvinciaController@indexByIdDepartamento');

Route::get('api/distritoporprovincia/{idprovincia}', 'DistritoController@indexByIdProvincia');

/*
Route::post('api/userLogin', 'UserController@login');
Route::put('api/userPassRestGenCode/{email}', 'UserController@passwordRestoreGenerateCode');
Route::put('api/userPassRest/{email}', 'UserController@passwordRestore');
 * 
 */