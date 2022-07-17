<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function JadwalProduksi()
    {
        return $this->hasMany(JadwalProduksi::class, 'customer_id', 'id');
    }
}
