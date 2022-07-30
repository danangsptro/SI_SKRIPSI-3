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
        Route::get('/jadwal-produksi-edit/{id}', 'jadwalProduksiController@edit')->name('jadwal-produksi-edit');
        Route::post('/jadwal-produksi-update/{id}', 'jadwalProduksiController@update')->name('jadwal-produksi-update');
        Route::delete('/jadwal-produksi-delete/{id}', 'jadwalProduksiController@delete')->name('jadwal-produksi-delete');
        // Jadwal Produksi Sales
        Route::get('/jadwal-produksi-sales', 'jadwalProduksiController@jadwalProduksiSales')->name('jadwal-produksi-sales');
        Route::get('/jadwal-produksi-sales-create', 'jadwalProduksiController@createJadwalProduksiSales')->name('jadwal-produksi-sales-create');
        Route::post('/jadwal-produksi-sales-store', 'jadwalProduksiController@storeJadwalProduksiSales')->name('jadwal-produksi-sales-store');
        // Barang selesai produksi
        Route::get('/selesai-produksi', 'barangSelesaiController@index')->name('barang-selesai-produksi');
        Route::get('/selesai-produksi-create', 'barangSelesaiController@create')->name('barang-selesai-produksi-create');
        Route::delete('/selesai-produksi-delete/{id}', 'barangSelesaiController@delete')->name('barang-selesai-produksi-delete');
        Route::get('/selesai-produksi-edit/{id}', 'barangSelesaiController@edit')->name('barang-selesai-produksi-edit');
        Route::post('/selesai-produksi-update/{id}', 'barangSelesaiController@update')->name('barang-selesai-produksi-update');
        // Register User
        Route::get('/register-user', 'registerPegawaiController@index')->name('register-user');
        Route::post('/register-user-store', 'registerPegawaiController@store')->name('register-user-store');
        Route::delete('/register-user-delete/{id}', 'registerPegawaiController@delete')->name('register-user-delete');
        // Surat Jalan
        Route::get('/surat-jalan', 'suratJalanController@index')->name('surat-jalan');
        Route::get('/surat-jalan-create', 'suratJalanController@create')->name('surat-jalan-create');
        Route::post('/surat-jalan-store', 'suratJalanController@store')->name('surat-jalan-store');
        // SPK
        Route::get('/spk', 'spkController@index')->name('spk');
        Route::get('/spk/{id}', 'spKController@edit')->name('spk-edit');
        Route::post('/spk-update/{id}', 'spKController@update')->name('spk-update');
    });
});
