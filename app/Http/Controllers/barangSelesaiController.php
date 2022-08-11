<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\barangMasuk;
use App\Http\Models\BarangSelesai;
use App\Http\Models\Customer;
use App\Http\Models\Warehouse;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class barangSelesaiController extends Controller
{
    public function index()
    {
        $data = BarangSelesai::all();
        return view('page.barang-selesai-produksi.index', compact('data'));
    }

    public function edit($id)
    {
        $data = BarangSelesai::find($id);
        $customer = Customer::all();
        $barang = Barang::all();
        return view('page.barang-selesai-produksi.edit', compact('data', 'customer', 'barang'));
    }

    public function update($id)
    {
        $data = BarangSelesai::find($id);

        DB::transaction(function () use ($data) {
            try {
                $data->status = 'PROD';
                $data->tanggal_masuk_barang = Carbon::today();
                $data->save();

                $whs = new barangMasuk();
                $whs->nama_customer = $data->nama_customer;
                $whs->nama_barang = $data->nama_barang;
                $whs->total_barang_masuk = $data->total_barang;
                $whs->satuan = $data->satuan;
                $whs->no_label = $data->no_label;
                $whs->status = $data->status;
                $whs->tanggal_masuk_barang = $data->tanggal_masuk_barang;
                $whs->save();
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });

        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/selesai-produksi');
    }

    public function delete($id)
    {
        $data = BarangSelesai::find($id);
        $data->delete();

        if ($data) {
            toastr()->success('Data has been delete successfully!');
            return redirect()->back();
        }
    }
}
