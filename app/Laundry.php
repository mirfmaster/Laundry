<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    protected $guarded = ['_token'];


    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
