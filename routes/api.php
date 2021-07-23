<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Pegawai
Route::get('pegawai', 'API\PegawaiController@index');
//tampil 1 data
Route::get('pegawai/{data}', 'API\PegawaiController@show');
// Route Hapus Data
Route::delete('pegawai/{data}', 'API\PegawaiController@destroy')->middleware('auth:api');
// Route Tambah Data
Route::post('pegawai', 'API\PegawaiController@store')->middleware('auth:api');
// Route Update Data
Route::patch('pegawai/{id}', 'API\PegawaiController@update')->middleware('auth:api');



//Jabatan
//tampil semua data
Route::get('jabatan', 'API\JabatanController@index');
//tampil 1 data
Route::get('jabatan/{data}', 'API\JabatanController@show');
// Route Hapus Data
Route::delete('jabatan/{data}', 'API\JabatanController@destroy')->middleware('auth:api');
// Route Tambah Data
Route::post('jabatan', 'API\JabatanController@store')->middleware('auth:api');
// Route Update Data
Route::patch('jabatan/{id}', 'API\JabatanController@update')->middleware('auth:api');

Route::get('password', function () {
    return bcrypt('wahyu');
});


//Pendidikan
Route::get('pendidikan', 'API\RiwayatpendidikanController@index');
//tampil 1 data
Route::get('pendidikan/{data}', 'API\RiwayatpendidikanController@show');
// Route Hapus Data
Route::delete('pendidikan/{data}', 'API\RiwayatpendidikanController@destroy')->middleware('auth:api');
// Route Tambah Data
Route::post('pendidikan', 'API\RiwayatpendidikanController@store')->middleware('auth:api');
// Route Update Data
Route::patch('pendidikan/{id}', 'API\RiwayatpendidikanController@update')->middleware('auth:api');



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});