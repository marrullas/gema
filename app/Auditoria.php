<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    //
    protected $table = 'auditoria';
    protected $fillable = ['usuariosxciclo_id','actividad_id','certificado','certificador','detalles','evidencia'];

    public function usuariosxciclo()
    {
        return $this->belongsTo('\App\Usuariosxciclo','usuariosxciclo_id','id');
    }
    public function userCertificador()
    {
        return $this->belongsTo('\App\User','certificador','id');
    }
    public function actividad()
    {
        return $this->belongsTo('\App\Actividad');
    }

    public function ncs()
    {
        return $this->hasMany('\App\Ncs');
    }

/*    public function ncsResueltasCount(){
        return $this->ncs()->selectRaw('auditoria_id,count(*) as conteo')
            ->where('estadoncs_id','=','3')
            ->groupBy('auditoria_id');
    }*/
    public function ncsResueltasCount(){
        return $this->hasOne('\App\Ncs')
            ->selectRaw('auditoria_id,count(*) as conteo')
            ->where('estadoncs_id','=','3')
            ->groupBy('auditoria_id');
    }
    public function getNcsResueltasCountAttribute()
    {
        if ( ! array_key_exists('ncsResueltasCount', $this->relations))
            $this->load('ncsResueltasCount');

        $related = $this->getRelation('ncsResueltasCount');

        // then return the count directly
        return ($related) ? (int) $related->conteo : 0;
    }
/*    public function ncsPendientesCount(){
        return $this->ncs()->selectRaw('auditoria_id,count(*) as conteo')
            ->whereIn('estadoncs_id',[1,2])
            ->groupBy('auditoria_id');
    }*/
    public function ncsPendientesCount(){
        return $this->hasOne('\App\Ncs')
            ->selectRaw('auditoria_id,count(*) as conteo')
            ->whereIn('estadoncs_id',[1,2])
            ->groupBy('auditoria_id');
    }
    public function getNcsPendientesCountAttribute()
    {
        if ( ! array_key_exists('ncsPendientesCount', $this->relations))
            $this->load('ncsPendientesCount');

        $related = $this->getRelation('ncsPendientesCount');

        // then return the count directly
        return ($related) ? (int) $related->conteo : 0;
    }
}
