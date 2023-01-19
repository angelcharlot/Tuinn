<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;

    public function negocio()
    {
        return $this->belongsTo('App\Models\negocio');
    }
    public function mesas()
    {
        return $this->hasMany('App\Models\mesa');
    }



}
