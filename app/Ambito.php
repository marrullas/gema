<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambito extends Model
{
    //
    protected $table = 'ambitos';
    protected $fillable = ['id','nombre','tabla','tabla_id','tabla_nombre'];
}
