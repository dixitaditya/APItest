<?php

/*
|--------------------------------------------------------------------------
| Pet Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for PET API application.
|
*/

Route::get('/pet/search','PetController@petSearch');
Route::get('/pet/data','PetController@petDataAvailable');
Route::get('/pet','PetController@index');




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

Route::get('/call','testCarController@index');
Route::get('/holi','Holiday@index');
Route::get('/', function () {
    return view('welcome');
});


