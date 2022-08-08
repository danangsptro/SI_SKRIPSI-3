<?php

namespace App\Http\Controllers;

use App\Http\Models\poPurchasing;
use App\Http\Models\receivingBarang;
use App\Http\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class popurchasingController extends Controller
{
    public function index()
    {
        $data = poPurchasing::all();
        return view('page.purchasing.pembuatan-po', compact('data'));
    }

    public function create()
    {
        $supplier = Supplier::all();
        return view('page.purchasing.create-po', compact('supplier'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'supplier_id' => 'required|min:1',
            'tanggal_po' => 'required|min:1',
            'tanggal_kirim_awal' => 'required|min:1',
            'tanggal_kirim_akhir' => 'required|min:1',
            'total_barang' => 'required|min:1',
            'satuan' => 'required|min:1',
        ]);

        $data = new poPurchasing();

        DB::transaction(function () use ($data, $validate) {
            try {
                $data->no_po = "PO/ASG/2022/07/000" . $data->id;
                $data->supplier_id = $validate['supplier_id'];
                $data->tanggal_po = $validate['tanggal_po'];
                $data->tanggal_kirim_awal = $validate['tanggal_kirim_awal'];
                $data->tanggal_kirim_akhir = $validate['tanggal_kirim_akhir'];
                $data->total_barang = $validate['total_barang'];
                $data->satuan = $validate['satuan'];
                $data->validasi = 'N';
                $data->save();

                $receiving = new receivingBarang();
                $receiving->no_receiving = 'RCV/ASG/2022/07' . $data->id;
                $receiving->no_po = $data->no_po;
                $receiving->nama_supplier = $data->supplier->nama_supplier . ' - ' . $data->supplier->kode_supplier;
                $receiving->total_barang_po = $data->total_barang;
                $receiving->satuan = $data->satuan;
                $receiving->validasi = $data->validasi;
                $receiving->save();
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });

        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/popurchasing');
    }

    public function receivingBarang(Request $request)
    {
        $data = receivingBarang::all();
        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));
        if ($request->start && $request->end) {
            $data = $data->whereBetween('tangal_receiving', [$start, $end]);
        }
        return view('page.purchasing.receiving-barang', compact('data', 'start', 'end'));
    }

    public function editReceiving($id)
    {
        $data = receivingBarang::find($id);
        return view('page.purchasing.update-receiving-barang', compact('data'));
    }

    public function updateReceiving(Request $request, $id)
    {
        $validate = $request->validate([
            'tangal_receiving' => 'required|min:1',
            'total_barang_yg_diterima' => 'required|min:1',
        ]);

        $data = receivingBarang::find($id);
        $popurchasing = poPurchasing::find($id);

        DB::transaction(function () use ($data, $validate, $popurchasing) {
            try {
                $data->tangal_receiving = $validate['tangal_receiving'];
                $data->total_barang_yg_diterima  = $validate['total_barang_yg_diterima'];
                $data->no_surat_jalan  = 'SJBRG' . $data->id;
                $data->sisa_po = $data->total_barang_po - $data->total_barang_yg_diterima;
                $data->validasi = 'Y';
                $data->save();

                $popurchasing->validasi = $data->validasi;
                $popurchasing->save();
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });

        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/receiving-barang');
    }

    public function stock(Request $request)
    {
        $data = receivingBarang::whereValidasi('Y')->get();
        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));
        if ($request->start && $request->end) {
            $data = $data->whereBetween('tangal_receiving', [$start, $end]);
        }
        return view('page.purchasing.laporan-purchasing', compact('data', 'start', 'end'));
    }
}
