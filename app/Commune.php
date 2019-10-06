<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';

    public function markets(){
        
        return $this->hasMany(Market::class);

    }
}
