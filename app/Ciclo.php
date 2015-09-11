<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    //
    protected $table = 'ciclos';
    protected $fillable = ['id','nombre','descripcion','ambito_id','fecha_ini','fecha_fin','activo'];

    public static function filtroPaginación($nombre)
    {
        return Ciclo::nombre($nombre)
            ->orderBy('id','ASC')
            ->paginate();
    }
    public function scopeNombre($query, $name)
    {
        if(!empty($name))
            return $query->where('nombre', "LIKE","%$name%");

    }

    public function ambito()
    {
        return $this->belongsTo('\App\Ambito');
    }

    public function setFechaIniAttribute($value)
    {

        $fecha =  \Carbon\carbon::createFromFormat('d/m/Y',$value);
        $this->attributes['fecha_ini'] = $fecha;
    }
    public function setFechaFinAttribute($value)
    {
        if(!empty($value)) {
            $fecha = \Carbon\carbon::createFromFormat('d/m/Y', $value);
            $this->attributes['fecha_fin'] = $fecha;
        }
    }
}
