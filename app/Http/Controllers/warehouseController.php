<?php

namespace App\Http\Controllers;

use App\Http\Models\BarangSelesai;
use App\Http\Models\Warehouse;
use Illuminate\Http\Request;

class warehouseController extends Controller
{
    public function barangMasuk()
    {
        $barangMasuk = Warehouse::whereStatus(null)->get();
        return view('page.warehouse.barang-masuk', compact('barangMasuk'));
    }

    public function barangKeluar()
    {
        $barangKeluar = BarangSelesai::whereStatus('WHS')->get();
        return view('page.warehouse.barang-keluar', compact('barangKeluar'));
    }

    public function laporanStockBarang()
    {
        return view('page.warehouse.laporan-stock-barang');
    }
}
