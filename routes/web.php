<?php

use App\Http\Controllers\popurchasingController;
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
        Route::delete('/selesai-produksi-delete/{id}', 'barangSelesaiController@delete')->name('barang-selesai-produksi-delete');
        Route::get('/selesai-produksi-edit/{id}', 'barangSelesaiController@edit')->name('barang-selesai-produksi-edit');
        Route::post('/selesai-produksi-update/{id}', 'barangSelesaiController@update')->name('barang-selesai-produksi-update');
        // Register User
        Route::get('/register-user', 'registerPegawaiController@index')->name('register-user');
        Route::post('/register-user-store/{id?}', 'registerPegawaiController@store')->name('register-user-store');
        Route::delete('/register-user-delete/{id}', 'registerPegawaiController@delete')->name('register-user-delete');
        // Surat Jalan
        Route::get('/surat-jalan', 'suratJalanController@index')->name('surat-jalan');
        Route::get('/surat-jalan-create', 'suratJalanController@create')->name('surat-jalan-create');
        Route::post('/surat-jalan-store', 'suratJalanController@store')->name('surat-jalan-store');
        Route::get('/download-surat/{id}', 'suratJalanController@downloadSurat')->name('download-surat');
        Route::get('/surat-jalan-edit/{id}', 'suratJalanController@editSurat')->name('surat-jalan-edit');
        Route::post('/surat-jalan-update/{id}', 'suratJalanController@updateSurat')->name('surat-jalan-update');
        Route::delete('/surat-jalan-delete/{id}', 'suratJalanController@deleteSurat')->name('surat-jalan-delete');
        // SPK
        Route::get('/spk', 'spkController@index')->name('spk');
        Route::get('/spk/{id}', 'spKController@edit')->name('spk-edit');
        Route::post('/spk-update/{id}', 'spKController@update')->name('spk-update');
        // Warehouse
        Route::get('/warehouse-barang-masuk', 'warehouseController@barangMasuk')->name('barang-masuk');
        Route::get('/warehouse-barang-keluar', 'warehouseController@barangKeluar')->name('barang-keluar');
        Route::get('/warehouse-laporan-stock-barang', 'warehouseController@laporanStockBarang')->name('warehouse-laporan-stock-barang');
        Route::post('/warehouse-barang-masuk-tokeluar/{id}', 'warehouseController@barangMasuktoKeluar')->name('warehouse-barangmasuktokeluar');
        Route::post('/warehouse-barang-keluar-update/{id}', 'warehouseController@updateBarangKeluar')->name('warehouse-barang-keluar-update');
        Route::get('/laporan-stock-barang', 'warehouseController@printWarehouse')->name('laporan-stock-barang');
        // Purchasing
        Route::get('/form-pembuatan-po', 'popurchasingController@index')->name('popurchasing');
        Route::get('/create-po-purchasing', 'popurchasingController@create')->name('popurchasing-create');
        Route::post('/store-po-purchasing', 'popurchasingController@store')->name('popurchasing-store');
        Route::get('/receiving-barang', 'popurchasingController@receivingBarang')->name('receiving-barang');
        Route::get('/edit-validasi-receiving/{id}', 'popurchasingController@editReceiving')->name('edit-validasi-receiving');
        Route::post('/update-validasi-receiving/{id}', 'popurchasingController@updateReceiving')->name('update-validasi-receiving');
        Route::get('/laporan-stock-purchasing', 'popurchasingController@stockPurchasing')->name('laporan-stock-purchasing');
        Route::get('/print-stock-purchasing', 'popurchasingController@printStockPurchasing')->name('print-stock-purchasing');
        Route::get('/export-excell-purchasing', 'popurchasingController@exportExcell')->name('export-excell-purchasing');
        // Supplier
        Route::get('/supplier', 'supplierController@index')->name('supplier');
        Route::get('/create-supplier', 'supplierController@create')->name('supplier-create');
        Route::post('/store-supplier', 'supplierController@store')->name('store-supplier');
        Route::post('/update-supplier/{id}', 'supplierController@update')->name('update-supplier');
        Route::get('/edit-supplier/{id}', 'supplierController@edit')->name('edit-supplier');
        Route::delete('/delete-supplier/{id}', 'supplierController@delete')->name('delete-supplier');
        // Mpic Barang Masuk
        Route::get('/mpic-barang-masuk', 'mpicController@mpicBarangMasuk')->name('mpicBarangMasuk');
        Route::get('/mpic-barang-masuk-create', 'mpicController@createMpicBarangMasuk')->name('mpicBarangMasukCreate');
        Route::get('/mpic-barang-masuk-edit/{id}', 'mpicController@editMpicBarangMasuk')->name('mpicBarangMasukEdit');
        Route::post('/mpic-barang-masuk-store','mpicController@storeMpicBarangMasuk')->name('mpicBarangMasukStore');
        Route::post('/mpic-barang-masuk-edit/{id}', 'mpicController@updateMpicBarangMasuk')->name('mpicBarangMasukUpdate');
        Route::delete('/mpic-barang-masuk-delete/{id}', 'mpicController@deleteMpicBarangMasuk')->name('mpicBarangMasukDelete');
        // Mpic Barang Keluar
        Route::get('/mpic-barang-keluar', 'mpicController@mpicBarangKeluar')->name('mpicBarangKeluar');
        Route::get('/mpic-barang-keluar-edit/{id}', 'mpicController@editMpicBarangKeluar')->name('mpicBarangKeluarEdit');
        Route::post('/mpic=barang-keluar-update/{id}', 'mpicController@updateMpicBarangKeluar')->name('mpicBarangKeluarUpdate');
        Route::get('/laporan-mpic', 'mpicController@laporanMpic')->name('laporanMpic');
        Route::get('/print-laporan-mpic', 'mpicController@printLaporanMpic')->name('print-mpic');
        // Profile
        Route::get('/profile', 'registerPegawaiController@profile')->name('profile');
        Route::post('/edit-profile/{id}', 'registerPegawaiController@editProfile')->name('profile-edit');
        Route::post('/update-password/{id}', 'registerPegawaiController@updatePassword')->name('update-profile-password');
    });
});
