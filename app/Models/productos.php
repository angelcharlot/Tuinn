<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{

    use HasFactory;
    protected $fillable = ['img'];
    public function usuario()
    {
        return $this->belongsTo('App\Models\User','id_usurio');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Models\categorias','id_categoria');
    }


}
