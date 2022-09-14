<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\mpicBarangKeluar;
use App\Http\Models\mpicBarangMasuk;
use App\Http\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class mpicController extends Controller
{
    public function mpicBarangMasuk()
    {
        $mpicBarangMasuk = mpicBarangMasuk::all();
        return view('page.mpic.mpic-barang-masuk.barangMasukMpic', compact('mpicBarangMasuk'));
    }

    public function createMpicBarangMasuk()
    {
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('page.mpic.mpic-barang-masuk.createBarangMasukMpic', compact('barang', 'supplier'));
    }

    public function storeMpicBarangMasuk(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'no_surat_jalan' => 'required|max:30',
            'supplier_id' => 'required|min:1',
            'barang_id' => 'required|min:1',
            'satuan' => 'required|max:10',
            'total_barang_masuk' => 'required|min:1'
        ]);

        DB::transaction(function () use ($request) {
            try {
                $mpicBarangMasuk = new mpicBarangMasuk();
                $mpicBarangMasuk->tanggal = $request['tanggal'];
                $mpicBarangMasuk->no_surat_jalan = $request['no_surat_jalan'];
                $mpicBarangMasuk->supplier_id = $request['supplier_id'];
                $mpicBarangMasuk->barang_id = $request['barang_id'];
                $mpicBarangMasuk->satuan = $request['satuan'];
                $mpicBarangMasuk->total_barang_masuk = $request['total_barang_masuk'];
                $mpicBarangMasuk->save();

                $mpicBarangKeluar = new mpicBarangKeluar();
                $mpicBarangKeluar->tanggal_masuk = $mpicBarangMasuk->tanggal;
                $mpicBarangKeluar->no_surat_jalan = $mpicBarangMasuk->no_surat_jalan;
                $mpicBarangKeluar->nama_supplier = $mpicBarangMasuk->supplier->nama_supplier;
                $mpicBarangKeluar->nama_barang = $mpicBarangMasuk->barang->nama_barang . ' - ' . $mpicBarangMasuk->barang->kode_barang;
                $mpicBarangKeluar->satuan = $mpicBarangMasuk->satuan;
                $mpicBarangKeluar->stock_barang1 = $mpicBarangMasuk->total_barang_masuk;
                $mpicBarangKeluar->save();
                // dd($mpicBarangKeluar);/

                DB::commit();
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });

        toastr()->success('Data has been create successfully!');
        return redirect('dashboard/mpic-barang-masuk');
    }

    public function editMpicBarangMasuk($id)
    {
        $data = mpicBarangMasuk::find($id);
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('page.mpic.mpic-barang-masuk.editBarangMasukMpic', compact('data', 'barang', 'supplier'));
    }

    public function updateMpicBarangMasuk(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|min:1',
            'no_surat_jalan' => 'required|max:30',
            'supplier_id' => 'required|min:1',
            'barang_id' => 'required|min:1',
            'satuan' => 'required|max:10',
            'total_barang_masuk' => 'required|min:1'
        ]);

        $id = $request->id;
        $data = mpicBarangMasuk::find($id);

        DB::transaction(function () use ($request, $id, $data) {
            try {
                $data->tanggal = $request['tanggal'];
                $data->no_surat_jalan = $request['no_surat_jalan'];
                $data->supplier_id = $request['supplier_id'];
                $data->barang_id = $request['barang_id'];
                $data->satuan = $request['satuan'];
                $data->total_barang_masuk = $request['total_barang_masuk'];
                $data->save();

                $mpicBarangKeluar = mpicBarangKeluar::find($data->id);
                $mpicBarangKeluar->tanggal_masuk = $data->tanggal;
                $mpicBarangKeluar->no_surat_jalan = $data->no_surat_jalan;
                $mpicBarangKeluar->nama_supplier = $data->supplier->nama_supplier;
                $mpicBarangKeluar->nama_barang = $data->barang->nama_barang . ' - ' . $data->barang->kode_barang;
                $mpicBarangKeluar->satuan = $data->satuan;
                $mpicBarangKeluar->stock_barang1 = $data->total_barang_masuk;
                $mpicBarangKeluar->save();
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });

        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/mpic-barang-masuk');
    }

    public function deleteMpicBarangMasuk($id)
    {
        DB::transaction(function () use ($id) {
            try {
                $data = mpicBarangMasuk::find($id);
                $data->delete();

                $mpicBarangKeluar = mpicBarangKeluar::find($data->id);
                $mpicBarangKeluar->delete();

                DB::commit();
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });

        toastr()->success('Data has been delete successfully!');
        return redirect()->back();
    }

    public function mpicBarangKeluar()
    {
        $mpicBarangKeluar = mpicBarangKeluar::all();
        return view('page.mpic.mpic-barang-keluar.barangKeluarMpic', compact('mpicBarangKeluar'));
    }

    public function editMpicBarangKeluar($id)
    {
        $data = mpicBarangKeluar::find($id);
        return view('page.mpic.mpic-barang-keluar.barangKeluarMpicUpdate', compact('data'));
    }

    public function updateMpicBarangKeluar(Request $request, $id)
    {
        $request->validate([
            'tanggal_masuk' => 'required|min:1',
            'tanggal_keluar' => 'required|min:1',
            'no_surat_jalan' => 'required|min:1',
            'nama_supplier' => 'required|min:1',
            'nama_barang' => 'required|min:1',
            'satuan' => 'required|min:1',
            'stock_barang1' => 'required|min:1',
            'total_barang_keluar' => 'required|min:1',
        ]);

        $id = $request->id;
        $data = mpicBarangKeluar::find($id);
        $data->tanggal_masuk = $request['tanggal_masuk'];
        $data->tanggal_keluar = $request['tanggal_keluar'];
        $data->no_surat_jalan = $request['no_surat_jalan'];
        $data->nama_supplier = $request['nama_supplier'];
        $data->nama_barang = $request['nama_barang'];
        $data->satuan = $request['satuan'];
        $data->stock_barang1 = $request['stock_barang1'];
        $data->total_barang_keluar = $request['total_barang_keluar'];
        $data->stock_barang2 = $data->stock_barang1 - $data->total_barang_keluar;
        $data->save();

        if ($data) {
            toastr()->success('Data has been edit successfully!');
            return redirect('dashboard/mpic-barang-keluar');
        }
    }

    public function laporanMpic(Request $request)
    {
        $laporan = mpicBarangKeluar::all();
        $start = date("Y-m-d 00:00:00", strtotime($request->start));
        $end = date("Y-m-d 23:59:59", strtotime($request->end));

        if ($request->start && $request->end) {
            $laporan = $laporan->whereBetween('tanggal_masuk', [$start, $end]);

        }
        return view('page.mpic.laporanBarangMasukKeluarMpic', compact('laporan', 'start', 'end'));
    }

    public function printLaporanMpic(Request $request)
    {
        $user = Auth::user()->id;
        $idUser = User::where('id', $user)->first();
        $mpicBarangKeluar = mpicBarangKeluar::all();

        $start = date("Y-m-d 00:00:00", strtotime($request->start));
        $end = date("Y-m-d 23:59:59", strtotime($request->end));

        if ($request->start && $request->end) {
            $mpicBarangKeluar = $mpicBarangKeluar->whereBetween('tanggal_masuk', [$start, $end]);
        }

        $pdf = app('dompdf.wrapper');
        // $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('A4', 'landscape');

        $pdf->loadView('page.mpic.printBarangMasukKeluarMpic', compact(
            'user',
            'idUser',
            'mpicBarangKeluar'
        ));
        return $pdf->stream("Laporan-barang-masuk/keluar-mpic.pdf");
    }
}
