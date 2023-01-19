<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presentacion extends Model
{
    use HasFactory;
    protected $connection = "mysql";
    protected $fillable = ['name'];


    public function producto()
    {
        return $this->belongsTo('App\Models\productos');
    }



}
