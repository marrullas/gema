<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiposnc extends Model
{
    //
    protected $table = 'tiposnc';
    protected $fillable = ['hallazgo','accion','prioridad'];

}
