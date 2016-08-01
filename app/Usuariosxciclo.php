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
        return $this->belongsTo('\App\Ciclo')->where('activo',true);
    }
    public function auditoria()
    {
        return $this->hasMany('\App\Auditoria');
    }

    public static function resumenciclos($ciclo = null)
    {
        if(empty($ciclo)) {
            $resumen = DB::select(DB::raw("select (select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 1) as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 2) as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 3) as cerradas"));
        }else{
            $resumen = DB::select(DB::raw("select (select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where estadoncs_id = 1) as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where estadoncs_id = 2) as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where estadoncs_id = 3) as cerradas"));
        }


        return $resumen;
    }
    public static function resumenciclosxauditor($auditor_id)
    {
        $resumen = DB::select(DB::raw("select (select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 1 and auditor = ".$auditor_id.") as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 2 and auditor = ".$auditor_id.") as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 3 and auditor = ".$auditor_id.") as cerradas"));
        return $resumen;
    }
    public static function resumenciclosxusuario($user_id)
    {
        $resumen = DB::select(DB::raw("select (select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 1 and ncs.user_id = ".$user_id.") as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 2 and ncs.user_id = ".$user_id.") as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 3 and ncs.user_id = ".$user_id.") as cerradas"));
        return $resumen;
    }
    /*
     * Devuelve las ncs abiertas, devueltas, cerradas y el total para el usuario
     * tener en cuenta que este informe no muestra las nc donde el usuario sea el responsble pero
     * el ciclo de auditoria (usuariosxciclo) no sea suyo. Esto debe usar para el caso de implementar las
     * nc donde el responsable sea un tercero.
     */
    public static function resumenncsxusuario($ciclo = null)
    {
        //
        if(empty($ciclo)) {
            $resumen = DB::select(DB::raw("select users.id,users.full_name,(select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 1 and ncs.user_id = users.id) as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 2 and ncs.user_id = users.id) as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where estadoncs_id = 3 and ncs.user_id = users.id) as cerradas,
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1
        where ncs.user_id = users.id) as total
        from users having total > 0
        "
            ));
        }else{
            $resumen = DB::select(DB::raw("select users.id,users.full_name,(select count(*) as 'ncs_abiertas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where estadoncs_id = 1 and ncs.user_id = users.id) as abiertas,        
        (select count(*) as 'ncs_devueltas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where estadoncs_id = 2 and ncs.user_id = users.id) as devueltas,        
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where estadoncs_id = 3 and ncs.user_id = users.id) as cerradas,
        (select count(*) as 'ncs_cerradas' from ncs  
        inner join auditoria on auditoria_id = auditoria.id
        inner join usuariosxciclo on usuariosxciclo_id = usuariosxciclo.id and ncs.user_id = usuariosxciclo.user_id
        inner join ciclos on ciclos.id = ciclo_id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
        where ncs.user_id = users.id) as total
        from users having total > 0
        "
            ));
        }
        return $resumen;
    }
    public static function totalncsxciclo($ciclo = null)
    {
        if(empty($ciclo)) {
            return DB::select(DB::raw("select ciclos.nombre,count(*) as conteo from ncs 
          join auditoria on ncs.auditoria_id = auditoria.id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id
          join ciclos on usuariosxciclo.ciclo_id = ciclos.id
           group by(ciclos.nombre)
        "));
        }else{
            return DB::select(DB::raw("select ciclos.nombre,count(*) as conteo from ncs 
          join auditoria on ncs.auditoria_id = auditoria.id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id
          join ciclos on usuariosxciclo.ciclo_id = ciclos.id and ciclos.id = ".$ciclo."
           group by(ciclos.nombre)
        "));

        }
    }
    public static function totalncsxcicloxusuario($user_id)
    {
        return DB::select(DB::raw("select ciclos.nombre,count(*) as conteo from ncs 
          join auditoria on ncs.auditoria_id = auditoria.id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id and usuariosxciclo.user_id = ".$user_id."
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
            //->join('usuariosxciclo','usuariosxciclo.id','=','auditoria.usuariosxciclo_id')
            //->where('usuariosxciclo.user_id','=','ncs.user_id')
            ->whereIn('estadoncs_id',[1])
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
    public function ncsDevueltasSum(){
        return $this->hasOne('\App\Auditoria')
            ->selectRaw('usuariosxciclo_id,auditoria_id,count(ncs.id) as conteo')
            ->join('ncs','ncs.auditoria_id','=','auditoria.id')
            ->whereIn('estadoncs_id',[2])
            ->groupBy('usuariosxciclo_id');
    }
    public function getNcsDevueltasSumAttribute()
    {
        if ( ! array_key_exists('ncsDevueltasSum', $this->relations))
            $this->load('ncsDevueltasSum');

        $related = $this->getRelation('ncsDevueltasSum');

        // then return the count directly
        return ($related) ? (int) $related->conteo : 0;
    }
    public static function filtroPaginacion($userId,$nombre,$ciclo,$page)
    {
        return Usuariosxciclo::where('user_id','<>',$userId)
            ->nombre($nombre)
            ->ciclo($ciclo)
            //->get();
            ->paginate();

      /*  return Ficha::with(['user', 'ie', 'programa'])->codigo($codigo)
            ->ie($ie)
            ->orderBy('codigo', 'ASC')
            ->paginate();*/
    }


    public function scopeNombre($query, $nombre)
    {
        if (!empty($nombre)) {

            $query->whereRaw('user_id in (select id from users where full_name like "%'.$nombre.'%")');
       /*  $user = User::where('full_name', "LIKE","%$nombre%")
                ->select('id')
                ->get();
            dd($user);
            $query->whereIn('user_id',[$user->id->toArray()]);*/
            /*$query->join('users','users.id','=','usuariosxciclo.user_id')
                ->where('full_name', "LIKE","%$nombre%");*/
        }
    }

    public function scopeCiclo($query, $ciclo)
    {
        if(!empty($ciclo))
        {
            $query->where('ciclo_id', "=", $ciclo);
        }
    }
    /*
     * Esta funcion devuelve el listado de usuariosxciclo para un usuario y donde el ciclo al que pertenece esa activo
     */
    public static function usuariosxcicloactivo($user)
    {
        return Usuariosxciclo::with('ciclo')
            ->where('user_id',$user)
            ->whereIn('ciclo_id',function($queyry)
            {
                $queyry->select(DB::raw('id'))
                    ->from('ciclos')
                    ->whereRaw('activo = 1');
            })
            ->get();


    }
    /*
 * Esta funcion devuelve el listado de usuariosxciclo donde el ciclo al que pertenece esa activo
 */
    public static function usuariosxcicloactivoid($id)
    {
        return Usuariosxciclo::with('ciclo')
            ->where('id',$id)
            ->whereIn('ciclo_id',function($queyry)
            {
                $queyry->select(DB::raw('id'))
                    ->from('ciclos')
                    ->whereRaw('activo = 1');
            })
            ->first();


    }
}
