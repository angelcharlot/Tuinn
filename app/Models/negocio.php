<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class negocio extends Model
{
    use HasFactory;

      //relaciones productos
      public function productos()
      {
          return $this->hasMany('App\Models\productos','id_negocio');
      }
        //relaciones categoria
      public function categorias()
      {
          return $this->hasMany('App\Models\categorias','id_negocio');
      }
        //relaciones usuarios
      public function usuarios()
      {
          return $this->hasMany('App\Models\user','id_negocio');
      }
        //relaciones areas
      public function areas(){
        return $this->hasMany('App\Models\area');
    }
      //relaciones impresoras
    public function impresoras()
    {
        return $this->hasMany('App\Models\impresora');
    }
      //relaciones documentos
    public function documentos()
    {
        return $this->hasMany('App\Models\documento');
    }
      //relaciones configuraciones
    public function config() {
        return $this->hasOne('App\Models\config');
      }


}
