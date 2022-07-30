<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function JadwalProduksi()
    {
        return $this->hasMany(JadwalProduksi::class, 'customer_id', 'id');
    }

    public function JadwalProduksiSales()
    {
        return $this->hasMany(JadwalProduksiSales::class, 'customer_id', 'id');
    }

    // public function BarangSelesai()
    // {
    //     return $this->hasMany(BarangSelesai::class, 'customer_id', 'id');
    // }

    public function suratJalan()
    {
        return $this->hasMany(SuratJalan::class, 'customer_id', 'id');
    }

    public function spk()
    {
        return $this->hashMasny(Spk::class, 'customer_id', 'id');
    }
}
