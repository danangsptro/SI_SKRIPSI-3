<?php

namespace App\Http\Controllers;

use App\Http\Models\BarangSelesai;
use Illuminate\Http\Request;

class barangSelesaiController extends Controller
{
    public function index()
    {
        $data = BarangSelesai::all();
        return view('page.barang.index', compact('data'));
    }
}
