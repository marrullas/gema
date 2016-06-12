<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadoseguimiento extends Model
{
    //
    protected $table = 'estadoseguimientos';
    
    protected $fillable = ['nombre','descripcion','positivo','icono','color'];
}
