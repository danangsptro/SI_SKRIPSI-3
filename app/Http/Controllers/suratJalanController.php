<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\Customer;
use App\Http\Models\suratJalan;
use Illuminate\Http\Request;

class suratJalanController extends Controller
{
    public function index()
    {
        $data = suratJalan::all();
        $customer = Customer::all();
        $barang = Barang::all();
        return view('page.sales.surat-jalan', compact('data', 'customer', 'barang'));
    }

    public function create()
    {
        $customer = Customer::all();
        $barang = Barang::all();

        return view('page.sales.create-surat-jalan', compact('customer', 'barang'));
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'tanggal_surat_jalan' => 'required|max:20',
            'customer_id' => 'required|max:10',
            'barang_id' => 'required|max:10',
            'satuan' => 'required|max:20',
            'total_barang_kirim' => 'required|max:20',
            'alamat' => 'required|max:50',
            'expedisi' => 'required|max:20',
        ]);

        $suratId = suratJalan::all();
        $data = new suratJalan();
        $data->tanggal_surat_jalan = $validate['tanggal_surat_jalan'];
        $data->customer_id = $validate['customer_id'];
        $data->barang_id = $validate['barang_id'];
        $data->nomor_surat_jalan = count($suratId) + 1 . '/SJ/ASG/07/2022';
        $data->satuan = $validate['satuan'];
        $data->total_barang_kirim = $validate['total_barang_kirim'];
        $data->alamat = $validate['alamat'];
        $data->expedisi = $validate['expedisi'];
        $data->save();

        if ($data) {
            toastr()->success('Data has been saved successfully!');
            return redirect('dashboard/surat-jalan');
        }
    }

    public function downloadSurat($id)
    {
        $data = suratJalan::find($id);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('page.sales.print-surat-jalan', compact(
            'data'
        ));
        return $pdf->stream("surat.pdf");
    }

    public function editSurat($id)
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $data = suratJalan::find($id);
        return view('page.sales.edit-surat', compact('data', 'barang', 'customer'));
    }

    public function updateSurat(Request $request)
    {
        $validate = $request->validate([
            'tanggal_surat_jalan' => 'required|max:20',
            'customer_id' => 'required|max:10',
            'barang_id' => 'required|max:10',
            'satuan' => 'required|max:20',
            'total_barang_kirim' => 'required|max:20',
            'alamat' => 'required|max:50',
            'expedisi' => 'required|max:20',
        ]);

        $id = $request->id;
        $data = suratJalan::find($id);
        $data->tanggal_surat_jalan = $validate['tanggal_surat_jalan'];
        $data->customer_id = $validate['customer_id'];
        $data->barang_id = $validate['barang_id'];
        $data->satuan = $validate['satuan'];
        $data->total_barang_kirim = $validate['total_barang_kirim'];
        $data->alamat = $validate['alamat'];
        $data->expedisi = $validate['expedisi'];
        $data->save();

        if ($data) {
            toastr()->success('Data has been edit successfully!');
            return redirect('dashboard/surat-jalan');
        }
    }

    public function deleteSurat($id)
    {
        $data = suratJalan::find($id);
        if ($data === null || $data === '') {
            toastr()->error('Data has been delete null!');
            return redirect()->back();
        }else {
            $data->delete();
            toastr()->success('Data has been delete successfully!');
            return redirect()->back();
        }
    }
}
