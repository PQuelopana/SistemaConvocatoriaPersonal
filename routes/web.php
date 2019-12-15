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

Route::resource('api/postulante', 'PostulanteController');
Route::resource('api/convocatoria', 'ConvocatoriaController');
/*
Route::post('api/userLogin', 'UserController@login');
Route::put('api/userPassRestGenCode/{email}', 'UserController@passwordRestoreGenerateCode');
Route::put('api/userPassRest/{email}', 'UserController@passwordRestore');
 * 
 */