<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{

    use HasFactory;
    protected $fillable = ['img'];



function categorias(){

    return $this->belongsToMany('App\Models\categorias');

}
function presentaciones(){

    return $this->hasMany('App\Models\presentacion','producto_id');

}


}
