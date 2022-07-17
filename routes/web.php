<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login');
    }
    return redirect(url('/dashboard'));
});


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'dashboardController@index')->name('dashboard');
        // Customer
        Route::get('/customer', 'customerController@index')->name('customer');
        Route::get('/customer-create', 'customerController@create')->name('customer-create');
        Route::post('/customer-store', 'customerController@store')->name('customer-store');
        Route::get('/customer-edit/{id}', 'customerController@edit')->name('customer-edit');
        Route::post('/customer-update/{id}', 'customerController@update')->name('customer-update');
        Route::delete('/customer-delete/{id}', 'customerController@delete')->name('customer-delete');
        // Barang
        Route::get('/barang', 'barangController@index')->name('barang');
        Route::get('/barang-create', 'barangController@create')->name('barang-create');
        Route::post('/barang-store', 'barangController@store')->name('barang-store');
        Route::get('/barang-edit/{id}', 'barangController@edit')->name('barang-edit');
        Route::post('/barang-update/{id}', 'barangController@update')->name('barang-update');
        Route::delete('/barang-delete/{id}', 'barangController@delete')->name('barang-delete');
        // Jadwal Produksi
        Route::get('/jadwal-produksi', 'jadwalProduksiController@index')->name('jadwal-produksi');
        Route::get('/jadwal-produksi-create', 'jadwalProduksiController@create')->name('jadwal-produksi-create');
        Route::post('/jadwal-produksi-store', 'jadwalProduksiController@store')->name('jadwal-produksi-store');
        Route::delete('/jadwal-produksi-delete/{id}', 'jadwalProduksiController@delete')->name('jadwal-produksi-delete');
    });
});
