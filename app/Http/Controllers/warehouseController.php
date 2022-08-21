<?php

namespace App\Http\Controllers;

use App\Http\Models\barangKeluar;
use App\Http\Models\barangMasuk;
use App\Http\Models\BarangSelesai;
use App\Http\Models\Warehouse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class warehouseController extends Controller
{
    public function barangMasuk()
    {
        $barangMasuk = barangMasuk::all();
        return view('page.warehouse.barang-masuk', compact('barangMasuk'));
    }

    public function barangMasuktoKeluar($id)
    {
        $barangMasuk = barangMasuk::find($id);
        DB::transaction(function () use($barangMasuk) {
            try {
                $barangMasuk->status = 'WHS';
                $barangMasuk->save();

                $barangSelesai = BarangSelesai::whereNo_label($barangMasuk->no_label)->get();
                foreach ($barangSelesai as $key => $value) {
                    $value->status = 'WHS';
                    $value->save();
                }
                $barangKeluar = new barangKeluar();
                $barangKeluar->nama_customer = $barangMasuk->nama_customer;
                $barangKeluar->nama_barang = $barangMasuk->nama_barang;
                $barangKeluar->total_barang_masuk = $barangMasuk->total_barang_masuk;
                $barangKeluar->satuan = $barangMasuk->satuan;
                $barangKeluar->status = $barangMasuk->status;
                $barangKeluar->no_label = $barangMasuk->no_label;
                $barangKeluar->save();
            } catch (\Throwable $th) {
                $this->getMessage($th);
            }
        });
        toastr()->success('Data has been delete successfully!');
        return redirect()->back();
    }

    public function updateBarangKeluar(Request $request,$id){
        $barangKeluar = barangKeluar::find($id);
        DB::transaction(function () use ($barangKeluar, $request){
            try {
                $barangKeluar->tanggal_keluar_barang = $request->tanggal_keluar_barang;
                $barangKeluar->total_barang_keluar = $request->total_barang_keluar;
                $barangKeluar->total_sisa_barang = $barangKeluar->total_barang_masuk - $barangKeluar->total_barang_keluar;
                $barangKeluar->status = 'SALES';
                $barangKeluar->save();

                $barangSelesai = BarangSelesai::whereNo_label($barangKeluar->no_label)->get();
                foreach ($barangSelesai as $key => $value) {
                    $value->status = 'SALES';
                    $value->save();
                }

                $barangSelesai = barangMasuk::whereNo_label($barangKeluar->no_label)->get();
                foreach ($barangSelesai as $key => $value) {
                    $value->status = 'SALES';
                    $value->save();
                }
            } catch (\Throwable $th) {
                $this->getMessage($th);
            }
        });
        toastr()->success('Data has been delete successfully!');
        return redirect()->back();
    }

    public function barangKeluar()
    {
        $barangKeluar = barangKeluar::all();
        return view('page.warehouse.barang-keluar', compact('barangKeluar'));
    }

    public function laporanStockBarang(Request $request)
    {
        $barangKeluar = barangKeluar::all();
        $start = date("Y-m-d 00:00:00", strtotime($request->start));
        $end = date("Y-m-d 23:59:59", strtotime($request->end));

        if ($request->start && $request->end) {
            $barangKeluar = $barangKeluar->whereBetween('tanggal_keluar_barang', [$start, $end]);
        }
        return view('page.warehouse.laporan-stock-barang', compact('barangKeluar', 'start', 'end'));
    }

    public function printWarehouse(Request $request)
    {
        $user = Auth::user()->id;
        $idUser = User::where('id', $user)->first();
        $barangKeluar = barangKeluar::all();

        $start = date("Y-m-d 00:00:00", strtotime($request->start));
        $end = date("Y-m-d 23:59:59", strtotime($request->end));

        if ($request->start && $request->end) {
            $barangKeluar = $barangKeluar->whereBetween('tanggal_keluar_barang', [$start, $end]);
        }

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('page.warehouse.print-warehouse', compact(
            'user',
            'idUser',
            'barangKeluar'
        ));
        return $pdf->stream("Laporan-arsip-baru.pdf");
    }
}
