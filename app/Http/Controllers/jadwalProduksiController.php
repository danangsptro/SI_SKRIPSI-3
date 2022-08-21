<?php

namespace App\Http\Controllers;

use App\Http\Models\Barang;
use App\Http\Models\BarangSelesai;
use App\Http\Models\Customer;
use App\Http\Models\JadwalProduksi;
use App\Http\Models\JadwalProduksiSales;
use App\Http\Models\Spk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class jadwalProduksiController extends Controller
{
    // Jadwal Produksi
    public function index()
    {
        $data = JadwalProduksi::all();
        return view('page.jadwal-produksi.index', compact('data'));
    }

    // public function create()
    // {
    //     $customer = Customer::all();
    //     $barang = Barang::all();

    //     return view('page.jadwal-produksi.create', compact('customer', 'barang'));
    // }

    // public function store(Request $request)
    // {
    //     $validate = $request->validate([
    //         'jadwal_dibuat' => 'required|max:10',
    //         'customer_id' => 'required|max:10',
    //         'barang_id' => 'required|max:10',
    //         'total_barang' => 'required|max:30',
    //         'satuan' => 'required|max:10',
    //         'tanggal_produksi' => 'required|max:10',
    //         'deadline_produksi' => 'required|max:10',
    //         'status_produksi' => 'required|max:10',
    //     ]);

    //     $data = new JadwalProduksi();
    //     $barangSelesai = new BarangSelesai();
    //     DB::transaction(function () use ($data, $validate, $barangSelesai) {
    //         $data->jadwal_dibuat = $validate['jadwal_dibuat'];
    //         $data->customer_id = $validate['customer_id'];
    //         $data->barang_id = $validate['barang_id'];
    //         $data->total_barang = $validate['total_barang'];
    //         $data->satuan = $validate['satuan'];
    //         $data->tanggal_produksi = $validate['tanggal_produksi'];
    //         $data->deadline_produksi = $validate['deadline_produksi'];
    //         $data->status_produksi = $validate['status_produksi'];
    //         $data->save();

    //         $barangSelesai->tanggal_masuk_barang = $data->jadwal_dibuat;
    //         $barangSelesai->customer_id = $data->customer_id;
    //         $barangSelesai->barang_id = $data->barang_id;
    //         $barangSelesai->total_barang = $data->total_barang;
    //         $barangSelesai->satuan = $data->satuan;
    //         $barangSelesai->no_label = $data->id + 1 . '/PROD/' . $data->id;
    //         $barangSelesai->status = '-';
    //         $barangSelesai->save();
    //     });

    //     toastr()->success('Data has been saved successfully!');
    //     return redirect('dashboard/jadwal-produksi');
    // }

    public function edit($id)
    {
        $customer = Customer::all();
        $barang = Barang::all();
        $data = JadwalProduksi::find($id);
        return view('page.jadwal-produksi.edit', compact('customer', 'barang', 'data'));
    }

    public function update($id)
    {
        $jadwalProduksi = JadwalProduksi::find($id);
        DB::transaction(function () use ($jadwalProduksi) {
            try {
                $jadwalProduksi->status_produksi = 'FINISHED';
                $jadwalProduksi->save();

                $jadwalProduksiSales = JadwalProduksiSales::find($jadwalProduksi->id);
                $jadwalProduksiSales->status_produksi = 'FINISHED';
                $jadwalProduksiSales->save();

                $spk = new Spk();
                $spk->no_spk = $jadwalProduksi->id + 1 . '/ASG/2022/07';
                $spk->nama_customer = $jadwalProduksi->customer->nama_customer . ' - ' . $jadwalProduksi->customer->kode_customer;
                $spk->nama_barang = $jadwalProduksi->barang->nama_barang . ' - ' . $jadwalProduksi->barang->kode_barang;
                $spk->total_barang = $jadwalProduksi->total_barang;
                $spk->satuan = $jadwalProduksi->satuan;
                $spk->save();

                $selesaiProduksi = new BarangSelesai();
                $selesaiProduksi->nama_customer = $jadwalProduksi->customer->nama_customer . ' - ' . $jadwalProduksi->customer->kode_customer;
                $selesaiProduksi->nama_barang = $jadwalProduksi->barang->nama_barang . ' - ' . $jadwalProduksi->barang->kode_barang;
                $selesaiProduksi->total_barang = $jadwalProduksi->total_barang;
                $selesaiProduksi->satuan = $jadwalProduksi->satuan;
                $selesaiProduksi->no_label =  "/07PROD/100" . $jadwalProduksi->id;
                $selesaiProduksi->save();
            } catch (Exception $e) {
                $e->getMessage();
            }
        });
        toastr()->success('Data has been edit successfully!');
        return redirect('dashboard/jadwal-produksi');
    }

    public function delete($id)
    {
        $data = JadwalProduksi::find($id);
        $sales = JadwalProduksiSales::find($id);
        DB::transaction(function () use ($data, $sales) {
            try {
                if ($sales === null && $data === null) {
                    toastr()->error('Data has been delete null!');
                    return redirect()->back();
                } else {
                    $sales->delete();
                    $data->delete();
                }
            } catch (\Throwable $th) {
                $th->getMessage();
            }
        });
        toastr()->success('Data has been delete successfully!');
        return redirect()->back();
    }


    // Jadwal produksi Sales
    public function jadwalProduksiSales()
    {
        $jadwalProduksiSales = JadwalProduksiSales::all();
        return view('page.sales.jadwal-produksi.index', compact('jadwalProduksiSales'));
    }

    public function createJadwalProduksiSales()
    {
        $user = Auth::user()->position;

        if ($user === 'sales' || $user === 'admin') {
            $customer = Customer::all();
            $barang = Barang::all();
            return view('page.sales.jadwal-produksi.create', compact('customer', 'barang', 'user'));
        } else {
            toastr()->error('Access denied for user');
            return redirect()->back();
        }
    }


    public function storeJadwalProduksiSales(Request $request)
    {
        $validate = $request->validate([
            'jadwal_dibuat' => 'required|max:10',
            'customer_id' => 'required|max:10',
            'barang_id' => 'required|max:10',
            'total_barang' => 'required|max:30',
            'satuan' => 'required|max:10',
            'tanggal_produksi' => 'required|max:10',
            'deadline_produksi' => 'required|max:10',
            'status_produksi' => 'required|max:10',
        ]);

        $jadwalSales = new JadwalProduksiSales();
        $jadwalProduksi = new JadwalProduksi();

        DB::transaction(function () use ($jadwalSales, $validate, $jadwalProduksi) {
            $jadwalSales->jadwal_dibuat = $validate['jadwal_dibuat'];
            $jadwalSales->customer_id = $validate['customer_id'];
            $jadwalSales->barang_id = $validate['barang_id'];
            $jadwalSales->total_barang = $validate['total_barang'];
            $jadwalSales->satuan = $validate['satuan'];
            $jadwalSales->tanggal_produksi = $validate['tanggal_produksi'];
            $jadwalSales->deadline_produksi = $validate['deadline_produksi'];
            $jadwalSales->status_produksi = 'UNFINISHED';
            $jadwalSales->save();

            $jadwalProduksi->jadwal_dibuat = $jadwalSales->jadwal_dibuat;
            $jadwalProduksi->customer_id = $jadwalSales->customer_id;
            $jadwalProduksi->barang_id = $jadwalSales->barang_id;
            $jadwalProduksi->total_barang = $jadwalSales->total_barang;
            $jadwalProduksi->satuan = $jadwalSales->satuan;
            $jadwalProduksi->tanggal_produksi = $jadwalSales->tanggal_produksi;
            $jadwalProduksi->deadline_produksi = $jadwalSales->deadline_produksi;
            $jadwalProduksi->status_produksi = $jadwalSales->status_produksi;
            $jadwalProduksi->save();
        });


        toastr()->success('Data has been saved successfully!');
        return redirect('dashboard/jadwal-produksi-sales');
    }
}
