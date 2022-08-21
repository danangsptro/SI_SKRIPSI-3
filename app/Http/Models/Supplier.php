<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];

    public function poPurchasing()
    {
        return $this->hasMany(poPurchasing::class, 'supplier_id', 'id');
    }

    public function mpicBarangMasuk()
    {
        return $this->hashMany(mpicBarangMasuk::class, 'supplier_id', 'id');
    }
}
