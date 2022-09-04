<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class negocio extends Model
{
    use HasFactory;

      //relaciones
      public function productos()
      {
          return $this->hasMany('App\Models\productos','id_negocio');
      }


}
