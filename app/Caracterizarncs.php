<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracterizarncs extends Model
{
    //
    protected $table = 'caracterizarncs';
    protected $fillable = ['nombre','descripcion','orden'];
    
}
