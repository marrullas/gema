<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $table = "documentos";

    protected $fillable = ['nombre','descripcion','procedimiento_id','actividad_id','tipo','retencion','formato'];


    public function procedimiento()
    {
        return $this->belongsTo('\App\Procedimiento');
    }

    public function actividad()
    {
        return $this->belongsTo('\App\Actividad');
    }
    public static function filtroPaginación($nombre)
    {
        return Documento::nombre($nombre)
            ->orderBy('id','ASC')
            ->paginate();
    }
    public function scopeNombre($query, $name)
    {
        if(!empty($name))
            return $query->where('nombre', "LIKE","%$name%");

    }
}
