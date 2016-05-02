<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipofuncionario extends Model
{
    //
    
    protected $table = 'tipofuncionario';
    protected $fillable = ['nombre','descripcion'];
}
