<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadosncs extends Model
{
    //
    protected $table = 'estadoncs';
    protected $fillable = ['nombre','descripcion'];
}
