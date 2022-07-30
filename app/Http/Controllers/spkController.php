<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\Customer;
use App\Http\Models\Spk;
use Illuminate\Http\Request;

class spkController extends Controller
{
    public function index()
    {
        $data = Spk::all();
        return view('page.sales.spk.index', compact('data'));
    }

    public function edit($id)
    {
        $data = Spk::find($id);
        $customer = Customer::all();
        $barang = Barang::all();
        return view('page.sales.spk.edit', compact('data', ));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'tanggal_spk' => 'required|min:1',
            'no_spk' => 'required|min:1',
            'nama_customer' => 'required|min:1',
            'nama_barang' => 'required|min:1',
            'total_barang' => 'required|min:1',
            'satuan' => 'required|min:1',
            'tanggal_kirim' => 'required|min:1',
            'tanggal_akhir' => 'required|min:1',
            'status_spk' => 'required|min:1',
        ]);

        $id = $request->id;
        $data = Spk::find($id);
        $data->tanggal_spk = $validate['tanggal_spk'];
        $data->no_spk = $validate['no_spk'];
        $data->nama_customer = $validate['nama_customer'];
        $data->nama_barang = $validate['nama_barang'];
        $data->total_barang = $validate['total_barang'];
        $data->satuan = $validate['satuan'];
        $data->tanggal_kirim = $validate['tanggal_kirim'];
        $data->tanggal_akhir = $validate['tanggal_akhir'];
        $data->status_spk = $validate['status_spk'];
        $data->save();

        if ($data) {
            toastr()->success('Data has been saved successfully!');
            return redirect('dashboard/spk');
        }
    }
}
