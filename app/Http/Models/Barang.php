<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function JadwalProduksi()
    {
        return $this->hasMany(JadwalProduksi::class, 'barang_id', 'id');
    }

    public function JadwalProduksiSales()
    {
        return $this->hasMany(JadwalProduksiSales::class, 'barang_id', 'id');
    }

    // public function BarangSelesai()
    // {
    //     return $this->hasMany(BarangSelesai::class, 'barang_id', 'id');
    // }

    public function SuratJalan()
    {
        return $this->hasMany(SuratJalan::class, 'barang_id', 'id');
    }

    public function spk()
    {
        return $this->hasMany(Spk::class, 'barang_id', 'id');
    }

    public function mpicBarangMasuk()
    {
        return $this->hasMany(mpicBarangMasuk::class, 'barang_id', 'id');
    }
}
