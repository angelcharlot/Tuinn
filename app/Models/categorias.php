<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->hasMany('App\Models\productos','id_categoria');
    }



}
