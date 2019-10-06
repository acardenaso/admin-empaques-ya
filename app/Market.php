<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $table = 'markets';
    protected $fillable = ['commune_id','name', 'address', 'max_packing', 'payment_day'];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

}

