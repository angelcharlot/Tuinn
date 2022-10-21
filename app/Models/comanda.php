<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comanda extends Model
{
    use HasFactory;

    //relacion con productos
    public function productos(){
        return $this->belongsToMany('App\Models\productos');
    }

}
