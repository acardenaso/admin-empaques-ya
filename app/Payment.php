<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['market_id','pay_date', 'pay_amount'];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
