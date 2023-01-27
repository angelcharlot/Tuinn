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
      public function categorias()
      {
          return $this->hasMany('App\Models\categorias','id_negocio');
      }
      public function usuarios()
      {
          return $this->hasMany('App\Models\user','id_negocio');
      }
      public function areas(){
        return $this->hasMany('App\Models\area');
    }
    public function impresoras()
    {
        return $this->hasMany('App\Models\impresora');
    }
    public function documentos()
    {
        return $this->hasMany('App\Models\documento');
    }


}
