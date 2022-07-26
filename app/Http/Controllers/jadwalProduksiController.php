<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\BarangSelesai;
use App\Http\Models\Customer;
use App\Http\Models\JadwalProduksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class jadwalProduksiController extends Controller
{
    public function index()
    {
        $data = JadwalProduksi::all();
        return view('page.jadwal-produksi.index', compact('data'));
    }

    public function create()
    {
        $customer = Customer::all();
        $barang = Barang::all();

        return view('page.jadwal-produksi.create', compact('customer', 'barang'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'jadwal_dibuat' => 'required|max:10',
            'customer_id' => 'required|max:10',
            'barang_id' => 'required|max:10',
            'total_barang' => 'required|max:30',
            'satuan' => 'required|max:10',
            'tanggal_produksi' => 'required|max:10',
            'deadline_produksi' => 'required|max:10',
            'status_produksi' => 'required|max:10',
        ]);

        $data = new JadwalProduksi();
        $barangSelesai = new BarangSelesai();
        DB::transaction(function () use ($data, $validate, $barangSelesai) {
            $data->jadwal_dibuat = $validate['jadwal_dibuat'];
            $data->customer_id = $validate['customer_id'];
            $data->barang_id = $validate['barang_id'];
            $data->total_barang = $validate['total_barang'];
            $data->satuan = $validate['satuan'];
            $data->tanggal_produksi = $validate['tanggal_produksi'];
            $data->deadline_produksi = $validate['deadline_produksi'];
            $data->status_produksi = $validate['status_produksi'];
            $data->save();

            $barangSelesai->tanggal_masuk_barang = $data->jadwal_dibuat;
            $barangSelesai->customer_id = $data->customer_id;
            $barangSelesai->barang_id = $data->barang_id;
            $barangSelesai->total_barang = $data->total_barang;
            $barangSelesai->satuan = $data->satuan;
            $barangSelesai->no_label = $data->id + 1 . '/PROD/' . $data->id;
            $barangSelesai->status = '-';
            $barangSelesai->save();
        });

        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/jadwal-produksi');
    }

    public function edit($id)
    {
        $customer = Customer::all();
        $barang = Barang::all();
        $data = JadwalProduksi::find($id);
        return view('page.jadwal-produksi.edit', compact('customer', 'barang', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'jadwal_dibuat' => 'required|max:10',
            'customer_id' => 'required|max:10',
            'barang_id' => 'required|max:10',
            'total_barang' => 'required|max:30',
            'satuan' => 'required|max:10',
            'tanggal_produksi' => 'required|max:10',
            'deadline_produksi' => 'required|max:10',
            'status_produksi' => 'required|max:10',
        ]);

        $id = $request->id;
        $data = JadwalProduksi::find($id);
        $data->jadwal_dibuat = $validate['jadwal_dibuat'];
        $data->customer_id = $validate['customer_id'];
        $data->barang_id = $validate['barang_id'];
        $data->total_barang = $validate['total_barang'];
        $data->satuan = $validate['satuan'];
        $data->tanggal_produksi = $validate['tanggal_produksi'];
        $data->deadline_produksi = $validate['deadline_produksi'];
        $data->status_produksi = $validate['status_produksi'];
        $data->save();

        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/jadwal-produksi');
    }

    public function delete($id)
    {
        $data = JadwalProduksi::find($id);
        $data->delete();
        toastr()->success('Data has been delete successfully!');

        return redirect()->back();
    }
}
