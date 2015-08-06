<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    //
    protected $table  = "listas";
    protected $fillable = ['nombre','descripcion','es_procedimiento','user_id','activo','vencimiento'];


}
