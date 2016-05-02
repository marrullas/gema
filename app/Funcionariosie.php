<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionariosie extends Model
{
    //
    protected $table = 'funcionariosie';
    protected $fillable = ['nombre','telefono','correo','observaciones','ie_id','tipofuncionario_id'];


    public function ie()
    {
        return $this->belongsTo('\App\Ie');
    }
    public function tipofuncionario()
    {
        return $this->belongsTo('\App\Tipofuncionario');
    }

}
