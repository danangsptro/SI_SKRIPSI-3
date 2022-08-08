<?php

namespace App\Http\Controllers;

use App\Http\Models\Customer;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class customerController extends Controller
{
    public function index()
    {
        $data = Customer::all();
        return view('page.customer.index', compact('data'));
    }

    public function create()
    {
        return view('page.customer.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_customer' => 'required|min:3',
            'kode_customer' => 'required|min:3',
        ]);

        $data = new Customer();
        $data->nama_customer = $validate['nama_customer'];
        $data->kode_customer = $validate['kode_customer'];
        $data->save();

        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/customer');
    }

    public function edit($id)
    {
        $data = Customer::find($id);
        return view('page.customer.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_customer' => 'required|min:3',
            'kode_customer' => 'required|min:3',
        ]);

        $id = $request->id;
        $data = Customer::find($id);
        $data->nama_customer = $validate['nama_customer'];
        $data->kode_customer = $validate['kode_customer'];
        $data->save();

        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/customer');
    }

    public function delete($id)
    {
        $data = Customer::find($id);
        $data->delete();

        toastr()->success('Data has been edit successfully!');
        return redirect()->back();
    }
}
