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

//Route::get('/', function () {
    //return view('welcome');
//});
Route::get('/', 'CrudController@index');
Route::post('/FormController/insertRestoran','FormController@insert_restoran');
Route::post('/FormController/fetch','FormController@fetch')->name('autocomplete.fetch');
Route::post('/FormController/fetchnpwpd','FormController@fetchnpwpd')->name('autocomplete.fetchnpwpd');
Route::get('/formRestoran', [
    'uses'=>'FormController@pindah_restoran',
    'as' => 'formRestoran'
]);
Route::get('/formHotel', [
    'uses'=>'FormController@pindah_hotel',
    'as' => 'formHotel'
]);
Route::get('/formHiburan', [
    'uses'=>'FormController@pindah_hiburan',
    'as' => 'formHiburan'
]);
Route::get('/formReklame', [
    'uses'=>'FormController@pindah_reklame',
    'as' => 'formReklame'
]);
Route::get('/formParkir', [
    'uses'=>'FormController@pindah_parkir',
    'as' => 'formParkir'
]);
Route::get('/formAirtanah', [
    'uses'=>'FormController@pindah_airtanah',
    'as' => 'formAirtanah'
]);
Route::get('/formMineral', [
    'uses'=>'FormController@pindah_mineral',
    'as' => 'formMineral'
]);
