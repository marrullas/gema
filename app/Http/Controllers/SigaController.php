<?php

namespace App\Http\Controllers;

use App\Ambito;
use App\Ambitosxciclo;
use App\Ciclo;
use App\Entrega;
use App\Files;
use App\Repositories\SigaRepository;
use App\Tarea;
use App\TareaxUsuario;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
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

        //vista para usuarios instructores (angularJS)
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
        dd('por aca ando show');
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
        dd('por aca ando edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        dd('por aca ando update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }
    public function terminar($id)
    {


    }

    public function tareasxlista($id){


    }

    /**
     * Retorna una array con los datos de actividades pendientes del usuario logueado
     * @return \Illuminate\Http\JsonResponse
     */
    public function lista()
    {
        $userID =  Auth::user()->id;
        //dd($userID);
        $sigarepo = new SigaRepository();
        $ambitosactivos = $sigarepo->cicloxambitosxciclo($userID);
        //dd($ambitosactivos);
        $lista = $sigarepo->cargalistasentidades($ambitosactivos);
        //dd($lista);
        return response()->json($lista);
    }

    /**
     * retorna las actividades representadas en entregas de un ciclo
     * @param $id
     * @return mixed
     */
    public function actividades($id)
    {
/*        $ciclo = Ciclo::find($id)->first();
        $actividades =  $ciclo->actividades()->with('procedimiento','files')
            ->get();*/
        $entregas =  Entrega::where('ciclo_id','=',$id)
            ->with('ciclo','ciclo.procedimiento','actividad.files')
            ->join('actividades','entregas.actividad_id','=','actividades.id')
            ->orderBy('actividades.orden','ASC')
            ->select('entregas.*','actividades.nombre','actividades.descripcion','actividades.responsable')
            //->orderBy('entregas.actividad_id','ASC')
        ->get();
        //dd($entregas);
        return $entregas;
    }

    /**
     *carga la vista de usuarios con ciclos activos
     */
    public function sigausuario()
    {
        if(Auth::user()->isAdminOrlider())
        $ambitosxciclo = SigaRepository::UsuarioscicloxambitosxcicloTodos();
        else
        $ambitosxciclo = SigaRepository::UsuarioscicloxambitosxcicloTodos(Auth::user()->id);

        return view('admin.siga.resumen',compact('ambitosxciclo'));
    }
    /**
     *carga la vista de usuarios con ciclos activos
     */
    public function sigaambitoxciclo($ambito)
    {
        //dd('llegue');
        $userAmbito = Ambitosxciclo::where('id','=',$ambito)
            ->where('user_id','=',Auth::user()->id)
            ->first();
        //dd($userAmbito);
        if(!empty($userAmbito) || Auth::user()->isAdminOrlider()) {
            $sigarepo = new SigaRepository();
            $ambitoxciclo = $sigarepo->cicloxambitosxcicloId($ambito);

            $lista = $sigarepo->cargalistasentidades($ambitoxciclo);

            $entregas = $sigarepo->cargarcientregasxambitoxciclo($lista[0]->ambitosxciclo_id);
            $files = Files::where('ambitosxciclo_id', '=', $lista[0]->ambitosxciclo_id)
                ->where('prefijo', '=', 'EN')
                ->get();
            //dd($files->count());

            return view('admin.siga.timeline', compact('entregas', 'files'));
        }
    }
}
