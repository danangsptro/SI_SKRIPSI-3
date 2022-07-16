<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        return view('page.barang.index', compact('data'));
    }

    public function create()
    {
        return view('page.barang.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_barang' => 'required|min:3',
            'kode_barang' => 'required|min:3',
        ]);

        $data = new Barang();
        $data->nama_barang = $validate['nama_barang'];
        $data->kode_barang = $validate['kode_barang'];
        $data->save();

        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/barang');
    }

    public function edit($id)
    {
        $data = Barang::find($id);
        return view('page.barang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_barang' => 'required|min:3',
            'kode_barang' => 'required|min:3',
        ]);

        $id = $request->id;
        $data = Barang::find($id);
        $data->nama_barang = $validate['nama_barang'];
        $data->kode_barang = $validate['kode_barang'];
        $data->save();

        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/barang');
    }

    public function delete($id)
    {
        $data = Barang::find($id);
        $data->delete();

        toastr()->success('Data has been delete successfully!');
        return redirect('dashboard/barang');
    }
}
