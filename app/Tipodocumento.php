<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    //
    protected $table ='tipodocumento';
    protected $fillable =[
        'nombre',
        'descripcion',
        'id'
    ];
}
