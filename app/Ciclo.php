<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    //
    protected $table = 'ciclos';
    protected $fillable = ['id','nombre','descripcion','ambito_id','procedimiento_id','fecha_ini','fecha_fin','activo'];

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
    public function procedimiento()
    {
        return $this->belongsTo('\App\Procedimiento');
    }
    public function actividades()
    {
        return $this->belongsTo('\App\Actividad','procedimiento_id','procedimiento_id');
    }
    public function ambitoxciclo()
    {
        return $this->hasMany('\App\Ambitosxciclo');
    }
    public function ambitoxciclouser()
    {
        return $this->ambitoxciclo()->selectRaw('users.full_name, users.id')
            ->join('users','ambitosxciclo.user_id','=','users.id')
            ->groupBy('users.id');
            //->where('users.id = ambitosxciclo.user_id');
}
    public function entregas()
    {
        return $this->hasMany('\App\Entrega');
    }
    public function entregasCount()
    {
        return $this->entregas()->selectRaw('entregas.ciclo_id, count(*) as count')->groupBy('entregas.ciclo_id');
    }

    public function filesEntregasCount()
    {
        return $this->entregas()->selectRaw('entregas.ciclo_id, count(*) as count')
            ->join('files','files.codigo','=','entregas.id')
            ->where('files.prefijo','=','EN')
            ->groupBy('entregas.ciclo_id');
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
