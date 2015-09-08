<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TareaxUsuario extends Model
{
    //

    protected $table = 'tareasxusuario';

    protected $fillable = [
        'tarea_id',
        'responsable',
        'colaboradores',
        'auditado',
        'auditor',
        'vigente',
        'hecho',
        'estado',
        'cancelado',
        'termina',
        'auditado',
        'auditor',
        'recordar'
    ];

    public function tarea()
    {
        return $this->belongsTo('\App\Tarea');
    }

    public function para()
    {
        return $this->belongsTo('\App\User','responsable','id');
    }
    public function auditor()
    {
        return $this->belongsTo('\App\User','auditor','id');
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
}
