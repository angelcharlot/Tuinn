<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apertura_de_caja extends Model
{
    use HasFactory;

    public function caja()
    {
        return $this->belongsTo("App\Models\caja");
    }

}
