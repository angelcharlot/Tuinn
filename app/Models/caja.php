<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caja extends Model
{
    use HasFactory;
    public function aperturasDeCaja()
    {
        return $this->hasMany('App\Models\apertura_de_caja');
    }
}
