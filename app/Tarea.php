<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //
    //protected $dates = ['recordar','entrega','envio'];
    protected $fillable = [
        'nombre',
        'descripcion',
        'entrega',
        'envio',
        'estado',
        'activo',
        'creador',
        'procedimiento',
        'orden',
        'dependiente',
        'vigente',
        'prioridad',
        'lista'
    ];

    public function tareasdelusuario()
    {
        return $this->hasMany('\App\TareaxUsuario');
    }

    public function creadopor()
    {
        return $this->belongsTo('\App\User','creador','id');
    }


    public function getEntregaAttribute($value)
    {
        if($value)
        return \Carbon\Carbon::parse($value)->format('d/m/Y h:i');
    }

    public function setEntregaAttribute($value)
    {
        if($value)
        $this->attributes['entrega'] = new Carbon(Carbon::createFromFormat('d/m/Y H:i',$value));
    }
    public function getRecordarAttribute($value)
    {
        if($value)
            return \Carbon\Carbon::parse($value)->format('d/m/Y h:i');
    }
    public function setRecordarAttribute($value)
    {

        if($value)
            $this->attributes['recordar'] = new Carbon(Carbon::createFromFormat('d/m/Y H:i',$value));
    }

    public function para()
    {
        return $this->belongsTo('\App\User','responsable','id');
    }
    public function auditor()
    {
        return $this->belongsTo('\App\User','auditor','id');
    }

}
