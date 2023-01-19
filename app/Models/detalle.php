<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsTo('App\Models\productos');
    }
    public function documento()
    {
        return $this->belongsTo('App\Models\documento');
    }
}
