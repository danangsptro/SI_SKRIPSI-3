<?php

namespace App\Http\Controllers;

use App\Http\Models\JadwalProduksi;
use Illuminate\Http\Request;

class jadwalProduksiController extends Controller
{
    public function index ()
    {
        $data = JadwalProduksi::all();
        return view('page.jadwal-produksi.index', compact('data'));
    }
}
