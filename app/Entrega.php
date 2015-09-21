<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    //
    protected $fillable = ['id','actividad_id','ciclo_id','fecha','numeroarchivo','descripcion'];


    public function ciclo()
    {
        return $this->belongsTo('\App\Ciclo');
    }
    public function actividad()
    {
        return $this->belongsTo('\App\Actividad');
    }
    public function procedimiento()
    {
        return $this->belongsTo('\App\Ciclo');
    }
}
