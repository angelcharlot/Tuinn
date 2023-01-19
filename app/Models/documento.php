<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documento extends Model
{
    use HasFactory;

    function detalles(){

        return $this->hasMany('App\Models\detalle','documento_id');
    
    }
}
