<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalProduksi extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
