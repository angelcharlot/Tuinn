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
    public function mesa()
    {
        return $this->belongsTo('App\Models\mesa','mesa_id');
    }
    public function negocio()
    {
        return $this->belongsTo('App\Models\negocio');
    }
}
