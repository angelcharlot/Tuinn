<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mesa extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->belongsTo('App\Models\area');
    }
    public function documento()
    {
        return $this->hasMany('App\Models\documento');
    }

}
