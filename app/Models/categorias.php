<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;


    public function cat_hijos()
    {
        return $this->hasMany('App\Models\categorias','id_categoria');
    }
    public function cat_hijos_todos()
    {
        return $this->hasMany('App\Models\categorias','id_categoria')->with('cat_hijos');
    }




    public function productos()
    {
        return $this->hasMany('App\Models\productos','id_categoria');
    }
    public function cat_padre()
    {
        return $this->belongsTo('App\Models\categorias','id_categoria');
    }



}
