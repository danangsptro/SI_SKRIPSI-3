<?php

namespace App\Http\Controllers;

use App\Http\Models\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    public function index()
    {
        $data = Supplier::all();
        return view('page.supplier.index', compact('data'));
    }

    public function create()
    {
        return view('page.supplier.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_supplier' => 'required|min:3',
            'kode_supplier' => 'required|min:3'
        ]);

        $data = new Supplier();
        $data->nama_supplier = $validate['nama_supplier'];
        $data->kode_supplier = $validate['kode_supplier'];
        $data->save();


        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/supplier');
    }

    public function edit($id)
    {
        $data = Supplier::find($id);
        return view('page.supplier.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_supplier' => 'required|min:3',
            'kode_supplier' => 'required|min:3',
        ]);

        $id = $request->id;
        $data = Supplier::find($id);
        $data->nama_supplier = $validate['nama_supplier'];
        $data->kode_supplier = $validate['kode_supplier'];
        $data->save();

        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/supplier');
    }

    public function delete($id)
    {
        $data = Supplier::find($id);
        $data->delete();

        toastr()->success('Data has been edit successfully!');
        return redirect()->back();
    }
}
