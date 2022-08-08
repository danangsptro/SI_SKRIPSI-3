<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class poPurchasing extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
