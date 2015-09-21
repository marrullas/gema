<?php

namespace App\Http\Controllers;

use App\Ambito;
use App\Ambitosxciclo;
use App\Ciclo;
use App\Entrega;
use App\Files;
use App\Tarea;
use App\TareaxUsuario;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * @property Request request
 * @property  userID
 */
class SigaController extends Controller
{

    protected $request;
    protected $userID;

    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth');
        $this->request = $request;
        if(Auth::user())
            $this->userID = Auth::user()->id;
        else
            redirect('/');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $userID = Auth::user()->id;


/*        $tareas = TareaxUsuario::join('tareas', 'tareas.id', '=', 'tarea_id')
            ->where('tareasxusuario.responsable', '=', $userID)
            ->where('activo', '=', true)
            ->get();
        $tareas = Tarea::where('responsable','=',$userID)
            ->where('activo','=',true)

            ->get();
*/

        return view('siga.index2');
    }

    public function tareas(){
        $userID = Auth::user()->id;

        $tareas = Tarea::with('creadopor')
           // ->join('tareasxusuario','tareasxusuario.tarea_id','=','tareas.id')
            ->where('tareas.responsable','=',$userID)
            //->where('tareasxusuario.hecho','=',false)
            ->where('activo','=',true)
            //->where('tareas.id','=', 2)
            ->get();

        //dd($tareas);
        return $tareas;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $usuarios = User::lists('full_name','id');
        return view('tareas.create',compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        $tmp = null;
        $data = $this->request->all();
        $userID = Auth::user()->id;
        $tarea =  new Tarea($data);
        $tarea->creador = $userID;
        $tarea->envio = \Carbon\Carbon::now();//enviar
        $tarea->tareasdelusuario()->hecho = false;
        $tarea->responsable = $userID;
        $tarea->colaborador = false;
        $tarea->save();


        $colaboladores[] = $this->request->get('colaboladores');

        if(empty($colaboladores)) {
            foreach ($data['colaboradores'] as $colaborador) {

                //crear mensaje por cada destinatario
                $tareaxusuario = new TareaxUsuario();
                $tareaxusuario->tarea_id = $tarea->id;
                $tareaxusuario->responsable = $colaborador;
                $tareaxusuario->colaborador = true;
                $tareaxusuario->save();

            }
        }
/*        else{
            $tareaxusuario = new TareaxUsuario();
            $tareaxusuario->tarea_id = $tarea->id;
            $tareaxusuario->responsable = $userID;
            $tareaxusuario->colaborador = false;
            $tareaxusuario->save();
        }*/

/*        $newtarea = Tarea::join('tareasxusuario','tareasxusuario.tarea_id','=','tareas.id')
            ->where('tareas.id','=',$tarea->id)
            //->where('tareasxusuario.responsable','=',$userID)
            ->where('lista','=',$tarea->lista)
            //->where('tareasxusuario.hecho','=',false)
            ->where('activo','=',true)
            //->where('tareas.id','=', 2)
            ->first();*/
        $newtarea = Tarea::where('tareas.id','=',$tarea->id)
            //->where('tareasxusuario.responsable','=',$userID)
            ->where('lista','=',$tarea->lista)
            //->where('tareasxusuario.hecho','=',false)
            ->where('activo','=',true)
            //->where('tareas.id','=', 2)
            ->first();

        //$usuarios = User::lists('full_name','id');
        Session::flash('message','Tarea creada!!');
        return $this->request->wantsJson() ? $newtarea : Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $data = $this->request->all();



        //dd($data);
        //$entrega = new Carbon(Carbon::createFromFormat('d/m/Y H:i',$data['entrega']));
        //$recordar = new Carbon(Carbon::createFromFormat('d/m/Y H:i',$data['recordar']));
        $tarea = Tarea::find($id);
        if($tarea->creador == Auth::user()->id) {//si la tarea pertenece a usuario logueado
            //$tareaxusuario = TareaxUsuario::where('tarea_id', '=', $id)->first();
            //$tarea->done =  $this->request->input('done');
            $tarea->fill($data);
            //$tareaxusuario->fill($data);
            //$tarea->entrega = $entrega;
            //$tarea->recordar = $recordar;
            $tarea->save();
            //$tareaxusuario->save();
            $respuesta['tarea'] = $tarea;
            $respuesta['mensaje'] = "Tarea actualizada correctamente";

        }else{
            $respuesta['tarea'] = null;
            $respuesta['mensaje'] = "Tarea no pertenece al usuario";
        }
        //dd($tarea);
        return $this->request->wantsJson() ? $respuesta : Redirect::back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $tarea = Tarea::where('id','=',$id)
                    ->where('creador','=',Auth::user()->id)
            ->first();
        if($tarea->count() > 0) {
            Files::destroyxtarea($tarea->id);
            $tarea->delete();
            $respuesta['tarea'] = $tarea;
            $respuesta['mensaje'] = "Tarea eliminada";
        }
        else{
            $respuesta['tarea'] = null;
            $respuesta['mensaje'] = "No fue posible eliminar la tarea";
        }
    }
    public function terminar($id)
    {

        $tarea = Tarea::find($id);
        if($tarea->creador == Auth::user()->id) {//si la tarea pertenece a usuario logueado
            $data = $this->request->all();
            //$tareaxusuario = TareaxUsuario::where('tarea_id', '=', $id)->first();
            //$tareaxusuario->fill($data);
            //$tareaxusuario->save();
            $tarea->fill($data);
            $tarea->save();
            $respuesta['tarea'] = $tarea;
            $respuesta['mensaje'] = "Tarea actualizada correctamente";
        }
        else{
            $respuesta['tarea'] = null;
            $respuesta['mensaje'] = "Tarea actualizada correctamente";
        }

/*        $newtarea = Tarea::join('tareasxusuario','tareasxusuario.tarea_id','=','tareas.id')
            ->where('tareas.id','=',$id)
            ->where('tareasxusuario.responsable','=',$this->userID)
            //->where('tareasxusuario.hecho','=',false)
            ->where('activo','=',true)
            //->where('tareas.id','=', 2)
            ->first();*/
        return $this->request->wantsJson() ? $respuesta : Redirect::back();


    }

    public function tareasxlista($id){

        $tareas = Tarea::with('creadopor')
            ->where('lista','=',$id)
            //->join('tareasxusuario','tareasxusuario.tarea_id','=','tareas.id')
            //->where('tareasxusuario.responsable','=',$userID)
            //->where('tareasxusuario.hecho','=',false)
            ->where('activo','=',true)
            //->where('tareas.id','=', 2)
            //->selectRaw('')
            ->get();
        return $tareas;
    }

    /**
     * Esta funcion recibe una codigo de lista y retorna las tareas, tareasxusuario y lista
     * filttrada por el estado de la tarea, si esta terminada o no y retorna el numero de tareas
     * para cada estado.
     * @param $id
     * @return mixed
     */
    public function numerotareaxestado($id){

        /*
SELECT tareasxusuario.id as tareaxusuariid, tareas.id as tareasid, listas.id as listasid , COUNT( * ) AS numero_tareas
FROM tareasxusuario
JOIN tareas ON tareas.id = tareasxusuario.tarea_id
JOIN listas ON tareas.lista = listas.id
WHERE listas.id =21
GROUP BY (
tareasxusuario.hecho
)
         */
        $tareas = DB::table('tareasxusuario')
            ->selectRaw('tareasxusuario.id as tareaxusuariid, tareas.id as tareasid, listas.id as listasid ,hecho, COUNT( * ) AS numero_tareas')
            ->join('tareas','tareas.id','=','tareasxusuario.tarea_id')
            ->join('listas','tareas.lista','=','listas.id')
            ->where('listas.id','=',$id)
            ->groupby('tareasxusuario.hecho')
            ->get();

        /*$tareas = Tarea::with('creadopor')
            ->where('lista','=',$id)
            ->join('tareasxusuario','tareasxusuario.tarea_id','=','tareas.id')
            //->where('tareasxusuario.responsable','=',$userID)
            //->where('tareasxusuario.hecho','=',false)
            ->where('activo','=',true)
            //->where('tareas.id','=', 2)
            //->selectRaw('')
            ->get();*/
        return $tareas;
    }
    public function lista()
    {
        $userID =  Auth::user()->id;
        $ambiotosxciclo = Ambitosxciclo::where('user_id','=',$userID)
            ->where('activo','=',true)
            ->lists('entidad_id');
        //seleccionamos los ambitos que corresponden a los ciclos activos
        $ambitosactivos = Ciclo::join('ambitosxciclo','ambitosxciclo.ciclo_id','=','ciclos.id')
            ->where('ambitosxciclo.user_id','=',$userID)
            ->where('ambitosxciclo.activo','=',true)
            //->join()
            ->get();
        //dd($ambitosactivos);

        $lista = [];

        foreach($ambitosactivos as $ambitoactivo)
        {
            //dd($ambitoactivo->toArray());
            $ciclo = $ambitoactivo->toArray();
            $ambito = Ambito::where('id',$ambitoactivo->ambito_id)->first();
            $tabla = $ambito->nombre_tabla;
            $camponombre = $ambito->campo_nombre;
            $idtabla = $ambito->campo_id;
            $campouser = $ambito->campo_user;


            $datos = DB::table($tabla)
                ->select($camponombre,$idtabla,'ciclos.id as cicloid','ciclos.nombre as ciclonombre',
                    'ambitosxciclo.ambito_id as ambito','ambitos.nombre as ambitonombre')
                ->join('ambitosxciclo','ambitosxciclo.entidad_id','=',$idtabla)
                ->join('ciclos','ciclos.id','=','ambitosxciclo.ciclo_id')
                ->join('ambitos','ambitos.id','=','ciclos.ambito_id')
                ->where($idtabla,'=',$ambitoactivo->entidad_id)
                ->first();
            //dd($datos);
                //->lists($camponombre,$idtabla,$cam-idpouser);
            //$lista['ciclo'][] = x
            $lista[]= $datos;



        }
        //dd($lista);

 /*       $listaprocedimientos =  DB::table('procedimientos')
            ->get();*/

        return response()->json($lista);
    }
    public function actividades($id)
    {
/*        $ciclo = Ciclo::find($id)->first();
        $actividades =  $ciclo->actividades()->with('procedimiento','files')
            ->get();*/
        $entregas =  Entrega::where('ciclo_id','=',$id)
            ->with('ciclo','ciclo.procedimiento','actividad')
        ->get();
        //dd($entregas);
        return $entregas;
    }
}
