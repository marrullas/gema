<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambitosxciclo extends Model
{
    //
    protected $table = 'ambitosxciclo';
    protected $fillable = ['ciclo_id','entidad_id','id','user_id','ambito_id'];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function ciclo()
    {
        return $this->belongsTo('\App\Ciclo');
    }
    public function ambito()
    {
        return $this->belongsTo('\App\Ambito');
    }
}
