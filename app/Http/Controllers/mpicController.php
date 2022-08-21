<?php

namespace App\Http\Controllers;

use App\Http\Models\mpicBarangKeluar;
use App\Http\Models\mpicBarangMasuk;
use App\Http\Models\Supplier;
use Illuminate\Http\Request;

class mpicController extends Controller
{
    public function mpicBarangMasuk()
    {
        $mpicBarangMasuk = mpicBarangMasuk::all();
        return view('page.mpic.mpic-barang-masuk.barangMasukMpic', compact('mpicBarangMasuk'));
    }

    public function mpicBarangKeluar()
    {
        $mpicBarangKeluar = mpicBarangKeluar::all();
        return view('page.mpic.mpic-barang-keluar.barangKeluarMpic', compact('mpicBarangKeluar'));
    }

    public function laporanMpic()
    {
        $laporan = mpicBarangKeluar::all();
        return view('page.mpic.laporanBarangMasukKeluarMpic', compact('laporan'));
    }
}
