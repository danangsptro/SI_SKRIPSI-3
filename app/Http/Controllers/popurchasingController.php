<?php

namespace App\Http\Controllers;

use App\Exports\ReceivingExport;
use App\Exports\LaporanRecevingExport;
use App\Http\Models\poPurchasing;
use App\Http\Models\receivingBarang;
use App\Http\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\URL;

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
        return redirect('dashboard/form-pembuatan-po');
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

    public function exportExcell(Request $request) {
        $receivingBarang = receivingBarang::all();
        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));
        if ($request->start && $request->end) {
            $receivingBarang = $receivingBarang->whereBetween('tangal_receiving', [$start, $end]);
        }
        $result = $receivingBarang->map(function($item, $key) {
            return [
                'Tanggal Receiving' => $item->tangal_receiving,
                'No Receiving' => $item->no_receiving,
                'No PO' => $item->no_po,
                'No Surat Jalan' => $item->no_surat_jalan,
                'Nama Suplier' => $item->nama_supplier,
                'Total Barang PO' => $item->total_barang_po,
                'Total Barang diterima' => $item->total_barang_yg_diterima,
                'Sisa PO' => $item->sisa_po,
                'Satuan' => $item->satuan,
                'Validasi' => $item->validasi
            ];
        });
        return Excel::download(new ReceivingExport($result), 'receiving-barang.xlsx');
    }

    public function exportExcelLaporan(Request $request) {
        $data = receivingBarang::whereValidasi('Y')->get();

        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));

        if ($request->start && $request->end) {
            $data = $data->whereBetween('tangal_receiving', [$start, $end]);
        }

        $result = $data->map(function($item, $key) {
            return [
                'Tanggal Receiving' => $item->tangal_receiving,
                'No Receiving' => $item->no_receiving,
                'No PO' => $item->no_po,
                'No Surat Jalan' => $item->no_surat_jalan,
                'Nama Suplier' => $item->nama_supplier,
                'Total Barang PO' => $item->total_barang_po,
                'Total Barang diterima' => $item->total_barang_yg_diterima,
                'Sisa PO' => $item->sisa_po,
                'Satuan' => $item->satuan
            ];
        });
        return Excel::download(new LaporanRecevingExport($result), 'laporan-receiving-barang.xlsx');
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

    public function stockPurchasing(Request $request)
    {
        $data = receivingBarang::whereValidasi('Y')->get();
        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));
        if ($request->start && $request->end) {
            $data = $data->whereBetween('tangal_receiving', [$start, $end]);
        }
        return view('page.purchasing.laporan-purchasing', compact('data', 'start', 'end'));
    }

    public function printStockPurchasing(Request $request)
    {
        $user = Auth::user()->id;
        $idUser = User::where('id', $user)->first();
        $data = receivingBarang::whereValidasi('Y')->get();

        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));

        if ($request->start && $request->end) {
            $data = $data->whereBetween('tangal_receiving', [$start, $end]);
        }

        $pdf = app('dompdf.wrapper');
        // $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('A4', 'landscape');

        $pdf->loadView('page.purchasing.print-purchasing', compact(
            'user',
            'idUser',
            'data'
        ));
        return $pdf->stream("Laporan-receiving.pdf");
    }
}
