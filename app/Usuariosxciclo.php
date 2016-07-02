<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuariosxciclo extends Model
{
    //
    protected $table = "usuariosxciclo";
    protected $fillable = ['user_id','ciclo_id','disponible','autogestion',
                            'iniciado','finalizado','descripcion','fechaini',
                            'fechafin'];
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function ciclo()
    {
        return $this->belongsTo('\App\Ciclo');
    }
    public function auditoria()
    {
        return $this->hasMany('\App\Auditoria');
    }

    public static function resumenciclos()
    {
        $resumen = DB::select(DB::raw("select (select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 1) as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id
        where estadoncs_id = 2) as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id
        where estadoncs_id = 3) as cerradas"));
        return $resumen;
    }

    public static function totalncsxciclo()
    {
        return DB::select(DB::raw("select ciclos.nombre,count(*) as conteo from ncs 
          join auditoria on ncs.auditoria_id = auditoria.id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id
          join ciclos on usuariosxciclo.ciclo_id = ciclos.id
           group by(ciclos.nombre)
        "));
    }
    /*
     * select usuariosxciclo_id,count(auditoria_id) as conteo from `auditoria`
     * join `ncs` on `ncs`.`auditoria_id` = `auditoria`.`id`
     * where `estadoncs_id` in (1,2) and `auditoria`.`usuariosxciclo_id` in (13,14)
     * group by `usuariosxciclo_id`
     * */
    public function ncsPendientesSum(){
        return $this->hasOne('\App\Auditoria')
            ->selectRaw('usuariosxciclo_id,auditoria_id,count(ncs.id) as conteo')
            ->join('ncs','ncs.auditoria_id','=','auditoria.id')
            ->whereIn('estadoncs_id',[1,2])
            ->groupBy('usuariosxciclo_id');
    }
    public function getNcsPendientesSumAttribute()
    {
        if ( ! array_key_exists('ncsPendientesSum', $this->relations))
            $this->load('ncsPendientesSum');

        $related = $this->getRelation('ncsPendientesSum');

        // then return the count directly
        return ($related) ? (int) $related->conteo : 0;
    }

}
