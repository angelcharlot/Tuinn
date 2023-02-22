<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class impresora extends Model
{
    use HasFactory;
    protected $fillable = ['name','default','tipo','interface','negocio_id'];
}
