<?php

namespace App\Http\Controllers\admin;


use App\Ambito;
use App\Ambitosxciclo;
use App\Ciclo;
use App\Entrega;
use App\Files;
use App\Ncs;
use App\Procedimiento;
use App\Repositories\SigaRepository;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CicloController extends Controller
{
    protected $request;
    protected $redirectTo = '/admin';

    /**
     * @param Request $request
     */
    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.

        $this->request = $request;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $ciclos = Ciclo::filtroPaginacion($nombre);

        return view('admin.ciclos.index',compact('nombre','page','ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        //$publico = Input::get('publico');
        $ambitos = \App\Ambito::lists('nombre','id');
        $procedimientos = \App\Procedimiento::lists('nombre','id');
        $ciclo = (object) ['fecha_ini' => \Carbon\Carbon::now(),'activo'=>1,'publico'=>1]; //se inicializan valores por defecto
        //$ciclo = (object) ['fecha_fin' => \Carbon\Carbon::now()];
        $activo = $this->request->get('activo');
        //dd($ciclo);
        return view('admin.ciclos.create',compact('ciclo','ambitos','activo','procedimientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\CreateCicloRequest $request)
    {
        //
        //$userID = Auth::user()->id;
        $data = $request->all();
        $activo = Input::get('activo');
        $publico = Input::get('publico');


        //dd($data);
        $ciclo  = new Ciclo($data);
        if(empty($activo))
            $ciclo->activo = false;
        if(empty($publico))
            $ciclo->publico = false;


        $ciclo->save();
        //se crean las entregas para el ciclo
        $actividades = $ciclo->actividades()->get();
        foreach($actividades as $actividad)
        {
            $entrega = new Entrega();
            $entrega->actividad_id = $actividad->id;
            $entrega->ciclo_id = $ciclo->id;
            $entrega->save();
        }

        return redirect()->route('admin.ciclos.index');
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

        $resumenciclos = Usuariosxciclo::resumenciclos($id);
        $totalncsxciclo = Usuariosxciclo::totalncsxciclo($id);
        $resumenncxusuario = Usuariosxciclo::resumenncsxusuario($id);
        $ncsxauditor = Ncs::ncsxuaditorxciclo($id);
        $ncsxactividadxciclo  = Ncs::ncsxactividadxciclo($id);
        $ciclo = Ciclo::where('id','=',$id)
            //->where('user_id','=',Auth::user()->id)
            ->first();

        return view('admin.ciclos.show',compact('ciclo','resumenciclos','totalncsxciclo','resumenncxusuario',
            'ncsxauditor','ncsxactividadxciclo'));
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
        $ciclo = Ciclo::findOrfail($id);
        $ambitos = \App\Ambito::lists('nombre','id');
        $procedimientos = \App\Procedimiento::lists('nombre','id');
        $activo = $this->request->get('activo');
        //dd($ciclo);

        return view('admin.ciclos.edit',compact('ciclo','ambitos','activo','procedimientos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\EditCicloRequest $request, $id)
    {
        $ciclo = Ciclo::findOrfail($id);
        $ciclo->fill($request->all());
        $activo = $this->request->get('activo');
        $publico = $this->request->get('publico');
        if(empty($activo))
            $ciclo->activo = false;
        if(empty($publico))
            $ciclo->publico = false;
        //dd($request->all());
        $ciclo->save();

        return redirect()->action('admin\CicloController@show',compact('id'));
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
        $ciclo = Ciclo::findOrfail($id);
        $ciclo->delete();
        $message = trans('validation.attributes.userdelete').' : '.$ciclo->nombre;
        if($this->request->ajax()){

            return response()->json([
                'id'=>$ciclo->id,
                'message'=>$message
            ]);
        }
        //Eliminar las actividades de la tabla auditoria que estan relacionadas con
        //este ciclo.
        //User::destroy($id); eliminar directamente
        Session::flash('message',$message);
        return redirect()->route('admin.ciclos.index');
    }
    public function activar($id)
    {
        //
        $ciclo = Ciclo::findOrfail($id);
        $ambitos = \App\Ambito::lists('nombre','id');
        $procedimientos = \App\Procedimiento::lists('nombre','id');
        $ambitosxcicloactivo = \App\Ambitosxciclo::where('ciclo_id','=',$ciclo->id)
            ->where('activo','=',true)
            ->lists('entidad_id');
        $ambitosxcicloinactivo = \App\Ambitosxciclo::where('ciclo_id','=',$ciclo->id)
            ->OrWhere('activo','=',false)
            ->lists('entidad_id');
        $tabla = $ciclo->ambito->nombre_tabla;
        $camponombre = $ciclo->ambito->campo_nombre;
        $idtabla = $ciclo->ambito->campo_id;
        $iduser = $ciclo->ambito->campo_user;


        //dd($ambitosxcicloinactivo);
/*        $datos = DB::table('fichas')
            ->whereNotIn('id',$ambitosxciclo)
            ->lists('full_name','fichas.id');
        $datos2 = DB::table('fichas')
            ->whereIn('id',$ambitosxciclo)
            ->lists('full_name','fichas.id');   */
        $datos = DB::table($tabla)
            ->whereNotIn($idtabla,$ambitosxcicloactivo)
            ->OrWhereIn($idtabla,$ambitosxcicloinactivo)
            ->lists($camponombre,$idtabla);
        $datos2 = DB::table($tabla)
            ->whereIn($idtabla,$ambitosxcicloactivo)
            ->lists($camponombre,$idtabla);

/*        $datos = DB::table('fichas')
            ->join('ambitosxciclo', function($join) use($ciclo){
                $join->on('fichas.id','=','ambitosxciclo.entidad_id')
                    ->where('ambitosxciclo.ciclo_id','=',$ciclo->id);
            })
            ->get();*/
        //dd($datos);
            //->lists('full_name','fichas.id');

/*        $datos = DB::table($ciclo->ambito->tabla)
            ->where
            ->join('ambitosxciclo',$ciclo->ambito->tabla_nombre.'.'.$ciclo->ambito->tabla_id)
            ->lists($ciclo->ambito->tabla_nombre,$ciclo->ambito->tabla_id);*/


        return view('admin.ciclos.activarciclo',compact('ciclo','ambitos','procedimientos','datos','datos2'));
    }
    public function storeambitoxciclo(Request $request)
    {
        //
        //$userID = Auth::user()->id;
        $data = $request->all();
        //dd($data);
        $ambito = Ambito::find($data['ambito_id']);
        $tablaentidad = $ambito->nombre_tabla;
        $campouser = $ambito->campo_user;
        $campoid = $ambito->campo_id;
        if(!empty($data['entidades']))
        {
            //dd($data['entidades']);

            foreach($data['entidades'] as $entidad){
                $ambitoxciclo = Ambitosxciclo::where('entidad_id','=',$entidad)
                    ->where('ambito_id','=',$data['ambito_id'])
                    ->first();
                $userEntidad = DB::table($tablaentidad)->where($campoid,'=',$entidad)->select($campouser)->first();
                //dd($ambitoxciclo);
                if(empty($ambitoxciclo)) {
                    //dd($entidad->user_id);
                    $ambitoxciclo = new Ambitosxciclo();
                    $ambitoxciclo->ciclo_id = $data['ciclo_id'];
                    $ambitoxciclo->ambito_id = $data['ambito_id'];
                    $ambitoxciclo->entidad_id = $entidad;
                    $ambitoxciclo->activo = true;
                    $ambitoxciclo->user_id = $userEntidad->user_id;
                    $ambitoxciclo->save();
                }else{
                    $ambitoxciclo->activo = true;
                    $ambitoxciclo->save();
                }
                $ambitoxciclo = null;
            }
        }
        if(!empty($data['inactivos']))
        {
            //dd($data['entidades']);
            //buscamos si existe registrada alguna entidad para desabilitarla
            foreach($data['inactivos'] as $entidad){
                $ambitoxciclo = Ambitosxciclo::where('entidad_id','=',$entidad)
                    ->where('ambito_id','=',$data['ambito_id'])
                    ->first();
                if(!empty($ambitoxciclo)) {
                    $userEntidad = DB::table($tablaentidad)->where($campoid,'=',$entidad)->select($campouser)->first();
                    $ambitoxciclo->activo = false;
                    $ambitoxciclo->user_id = $userEntidad->user_id;
                    $ambitoxciclo->save();
                }
            }
        }

        return redirect()->route('admin.ciclos.activar',$data['ciclo_id']);
    }

    /**
     *carga la vista de usuarios con ciclos activos
     */
    public function sigausuarios()
    {

        $ambitosxciclo = SigaRepository::UsuarioscicloxambitosxcicloTodos();

        return view('admin.siga.resumen',compact('ambitosxciclo'));
    }
    /**
     *carga la vista de usuarios con ciclos activos
     */
    public function sigaambitoxciclo($ambito)
    {
        $sigarepo = new SigaRepository();
        $ambitoxciclo = $sigarepo->cicloxambitosxcicloId($ambito);

        $lista = $sigarepo->cargalistasentidades($ambitoxciclo);

        $entregas =  $sigarepo->cargarcientregasxambitoxciclo($lista[0]->ambitosxciclo_id);
            $files = Files::where('ambitosxciclo_id','=',$lista[0]->ambitosxciclo_id)
                ->where('prefijo','=','EN')
                ->get();
        //dd($files->count());

        return view('admin.siga.timeline',compact('entregas','files'));
    }

}
