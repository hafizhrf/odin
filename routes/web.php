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

Route::get('/',['as'=>'homepage', function () {
    return view('home');
}]);

Route::get('/riwayat', 'peminjamanController@index');

Route::resource('inventaris', 'inventarisController');
Route::resource('cart','cartController');
Route::resource('peminjaman','peminjamanController');
Route::get('filter/{jenis}','inventarisController@filter');
Route::get('/search/query','inventarisController@search');
Route::get('/riwayat/{id}','peminjamanController@detail');
Route::resource('detail','detailController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('profile', 'peminjamController@index');
Route::get('/help', function () {
    return view('help');
});

Route::get('operator/peminjaman','operatorPeminjamanController@index');