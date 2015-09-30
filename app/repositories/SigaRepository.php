<?php
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 22/06/2015
 * Time: 11:05 PM
 */
namespace  App\Repositories;


use App\Ambito;
use App\Ambitosxciclo;
use App\Ciclo;
use App\Entrega;
use App\Evento;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SigaRepository {

    /**
     * seleccionamos los ambitosxciclo de usuario que corresponden a los ciclos activos
     * @param $userID
     * Recibe el codigo del usuario
     * @return mixed
     */
    public function cicloxambitosxciclo($userID){
       return Ciclo::join('ambitosxciclo','ambitosxciclo.ciclo_id','=','ciclos.id')
           ->where('ambitosxciclo.user_id','=',$userID)
           ->where('ambitosxciclo.activo','=',true)
           //->join()
           ->get();
   }

    /**
     * Retorna ambitosxciclo especifico relacionado con
     * @param $id
     * @return mixed
     */
    public function cicloxambitosxcicloId($id){
       return Ciclo::join('ambitosxciclo','ambitosxciclo.ciclo_id','=','ciclos.id')
           ->where('ambitosxciclo.id','=',$id)
           //->where('ambitosxciclo.activo','=',true)
           //->join()
           ->get();
   }

    /**
     * @return mixed todos los ambitiosxciclo que esten activos
     */
    public static function cicloxambitosxcicloTodos(){
        return Ciclo::join('ambitosxciclo','ambitosxciclo.ciclo_id','=','ciclos.id')
            //->where('ambitosxciclo.user_id','=',$userID)
            ->where('ambitosxciclo.activo','=',true)
            //->join()
            ->get();
    }
    /**
     * @return mixed todos los ambitiosxciclo que esten activos cpn los usurios relacionados
     */
    public static function UsuarioscicloxambitosxcicloTodos($userID = null){
        if(empty($userID)) {
            $ambitosxciclo = Ambitosxciclo::with('entregasCount')
                ->join('entregas', 'entregas.ciclo_id', '=', 'ambitosxciclo.ciclo_id')
                ->join('ciclos', 'ciclos.id', '=', 'ambitosxciclo.ciclo_id')
                ->join('users', 'users.id', '=', 'ambitosxciclo.user_id')
                ->where('ambitosxciclo.activo', '=', true)
                ->selectRaw('ciclos.id as ciclo_id, ciclos.nombre as ciclo_nombre,users.full_name as user_nombre,
                           users.id as user_id,ambitosxciclo.id as ambitosxciclo_id,ambitosxciclo.ambito_id,
                           ambitosxciclo.entidad_id,
                           (select count(*) from files where prefijo = "EN" and files.ambitosxciclo_id = ambitosxciclo.id and
                           files.codigo in (select entregas.id from entregas where entregas.ciclo_id = ciclos.id)) as filecount')
                ->groupBy('ambitosxciclo.id')
                ->get();
        }else{
            $ambitosxciclo = Ambitosxciclo::with('entregasCount')
                ->join('entregas', 'entregas.ciclo_id', '=', 'ambitosxciclo.ciclo_id')
                ->join('ciclos', 'ciclos.id', '=', 'ambitosxciclo.ciclo_id')
                ->join('users', 'users.id', '=', 'ambitosxciclo.user_id')
                ->where('ambitosxciclo.activo', '=', true)
                ->where('users.id', '=', $userID)
                ->selectRaw('ciclos.id as ciclo_id, ciclos.nombre as ciclo_nombre,users.full_name as user_nombre,
                           users.id as user_id,ambitosxciclo.id as ambitosxciclo_id,ambitosxciclo.ambito_id,
                           ambitosxciclo.entidad_id,
                           (select count(*) from files where prefijo = "EN" and files.ambitosxciclo_id = ambitosxciclo.id and
                           files.codigo in (select entregas.id from entregas where entregas.ciclo_id = ciclos.id)) as filecount')
                ->groupBy('ambitosxciclo.id')
                ->get();
        }
        //dd($ambitosxciclo);

        $data = [];

        foreach($ambitosxciclo as $ambitoxciclo){
            //dd($ambitoxciclo->ToArray());
            $ambito = Ambito::where('id','=',$ambitoxciclo->ambito_id)->first();
            $tabla = $ambito->nombre_tabla;
            $camponombre = $ambito->campo_nombre;
            $idtabla = $ambito->campo_id;

            $entidad = DB::table($tabla)
                ->select($camponombre.' as nombre',$idtabla,'ciclos.id as cicloid','ciclos.nombre as ciclonombre',
                    'ambitosxciclo.ambito_id as ambito','ambitos.nombre as ambitonombre')
                ->join('ambitosxciclo','ambitosxciclo.entidad_id','=',$idtabla)
                ->join('ciclos','ciclos.id','=','ambitosxciclo.ciclo_id')
                ->join('ambitos','ambitos.id','=','ciclos.ambito_id')
                ->where($idtabla,'=',$ambitoxciclo->entidad_id)
                ->first();
            //dd($entidad);
            $data[] = array_merge((array)$entidad,$ambitoxciclo->ToArray());
        }
        //$data = Ambitosxciclo::first()->ambito()->get();
        //dd($data);
        return $data;
    }
    /**
     *devuelve las lista de las entidades (ficha, ie, empresa, area)
     * @param $ambitosactivdos ambitosxciclo de un usuario
     * @return array con la lista de entidades activas
     */
    public function cargalistasentidades($ambitosactivos){
        $lista = [];
        foreach($ambitosactivos as $ambitoactivo)
        {
            $ambito = Ambito::where('id',$ambitoactivo->ambito_id)->first();
            $tabla = $ambito->nombre_tabla;
            $camponombre = $ambito->campo_nombre;
            $idtabla = $ambito->campo_id;

            $datos = DB::table($tabla)
                ->select($camponombre.' as nombre',$idtabla,'ciclos.id as cicloid','ciclos.nombre as ciclonombre',
                    'ambitosxciclo.ambito_id as ambito','ambitos.nombre as ambitonombre','ambitosxciclo.id as ambitosxciclo_id')
                ->join('ambitosxciclo','ambitosxciclo.entidad_id','=',$idtabla)
                ->join('ciclos','ciclos.id','=','ambitosxciclo.ciclo_id')
                ->join('ambitos','ambitos.id','=','ciclos.ambito_id')
                ->where('ambitos.id','=',$ambitoactivo->ambito_id)
                ->where($idtabla,'=',$ambitoactivo->entidad_id)
                ->first();
            $lista[]= $datos;

        }
        return $lista;
    }

    /**
     *devuelve las lista de las entidades (ficha, ie, empresa, area) que tenga algun ciclo activo
     * @param $ambitosactivdos ambitosxciclo de un usuario
     * @return array con la lista de entidades activas
     */
    public function cargalistasentidadesTodas(){

        $lista = $this->cargalistasentidades($this::cicloxambitosxcicloTodos());
        return $lista;
    }

    public function cargarcientregasxambitoxciclo($ambitoxciclo_id)
    {
        return Entrega::join('ambitosxciclo','entregas.ciclo_id','=','ambitosxciclo.ciclo_id')
            ->join('ciclos','ciclos.id','=','ambitosxciclo.ciclo_id')
            ->join('users','users.id','=','ambitosxciclo.user_id')
            ->join('actividades','entregas.actividad_id','=','actividades.id')
            //->where('ambitosxciclo.activo','=',true)
            ->where('ambitosxciclo.id','=',$ambitoxciclo_id)
            ->selectRaw('ciclos.id as ciclo_id, ciclos.nombre as ciclo_nombre,users.full_name as user_nombre,
                           users.id as user_id,ambitosxciclo.id as ambitosxciclo_id,ambitosxciclo.ambito_id,
                           ambitosxciclo.entidad_id,entregas.id as entregas_id,entregas.actividad_id,
                           actividades.nombre as actividad_nombre, actividades.descripcion as actividad_descripcion,
                           entregas.numeroarchivos,entregas.fecha as fecha,

                           (select count(*) from files where prefijo = "EN" and files.ambitosxciclo_id = ambitosxciclo.id and
                           files.codigo = entregas.id
                           ) as filecount')
            //->groupBy('ambitosxciclo.id')
            ->get();
    }


}