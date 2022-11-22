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
function alargenos(){

    return $this->belongsToMany('App\Models\alargeno');

}
function presentaciones(){

    return $this->hasMany('App\Models\presentacion','producto_id');

}
function likes(){

    return $this->hasMany('App\Models\like','producto_id');

}
function idiomas(){

    return $this->hasMany('App\Models\idioma','producto_id');

}




}
