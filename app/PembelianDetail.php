<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
