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
    public function entidad()
    {
        $ambito = $this->ambito()->get();
        //dd($ambito);
        return $this->ambito('\App\Ambito');
    }
    public function entregas()
    {
        return $this->hasMany('\App\Entrega','ciclo_id','ciclo_id');
    }
    public function entregasCount()
    {
        return $this->entregas()->selectRaw('entregas.ciclo_id, sum(numeroarchivos) as count')
            ->whereRaw('entregas.actividad_id in (select id from actividades where evidencia = 1)')
            ->groupBy('entregas.ciclo_id');
    }
    public function files()
    {
        return $this->hasMany('\App\Files','codigo','id')->where('files.prefijo','=','EN');
    }
    public function filesCount()
    {
        return $this->files()->selectRaw('count(*) as count')
            ->where('files.prefijo','=','EN');
    }
}
