<?php

namespace App\Http\Controllers;

use App\Http\Models\barangKeluar;
use App\Http\Models\JadwalProduksi;
use App\Http\Models\JadwalProduksiSales;
use App\Http\Models\receivingBarang;

class dashboardController extends Controller
{
    public function index()
    {
        $warehouse = barangKeluar::all();
        $purchasing = receivingBarang::whereValidasi('Y')->get();
        $produksi = JadwalProduksi::all();
        $sales = JadwalProduksiSales::all();
        return view('page.home.index', compact('warehouse','purchasing','produksi','sales'));
    }
}
