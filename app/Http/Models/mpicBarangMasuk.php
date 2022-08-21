<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class mpicBarangMasuk extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id','id');
    }
}
