<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\BarangSelesai;
use App\Http\Models\Customer;
use App\Http\Models\JadwalProduksi;
use Illuminate\Http\Request;

class barangSelesaiController extends Controller
{
    public function index()
    {
        $data = BarangSelesai::all();
        return view('page.barang-selesai-produksi.index', compact('data'));
    }

    public function create()
    {
        $customer = Customer::all();
        $barang = Barang::all();

        return view('page.barang-selesai-produksi.create', compact('customer', 'barang'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'tanggal_masuk_barang' => 'required|max:10',
            'customer_id' => 'required|max:10',
            'barang_id' => 'required|max:10',
            'total_barang' => 'required|max:30',
            'satuan' => 'required|max:10',
            'no_label' => 'required|max:10',
            'status' => 'required|max:10',
        ]);

        $data = new BarangSelesai();

        $data->tanggal_masuk_barang = $validate['tanggal_masuk_barang'];
        $data->customer_id = $validate['customer_id'];
        $data->barang_id = $validate['barang_id'];
        $data->total_barang = $validate['total_barang'];
        $data->satuan = $validate['satuan'];
        $data->no_label = $validate['no_label'];
        $data->status = $validate['status'];
        $data->save();

        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/jadwal-produksi');
    }

    public function delete($id)
    {
        $data = BarangSelesai::find($id);
        $data->delete();

        if($data){
            toastr()->success('Data has been delete successfully!');
            return redirect()->back();
        }
    }
}
