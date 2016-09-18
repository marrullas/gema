<?php

namespace App\Http\Controllers\admin;

use App\Actividad;
use App\Auditoria;
use App\Caracterizarncs;
use App\Estadosncs;
use App\Ncs;
use App\Seguimientoncs;
use App\Tiposnc;
use App\User;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuditoriaController extends Controller
{

    protected $request;

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
     * @param $id codigo del registro del usuariosxciclo
     * @return \Illuminate\Http\Response
     * url: http://gema.app/admin/auditoria/13
     */
    public function index($id)
    {
        //$estadoncs = Estadosncs::lists('id','nombre');
        $caracterizarnc = Caracterizarncs::lists('id','nombre');
        $tiposnc = Tiposnc::lists('id','hallazgo');
        //$nombre = $this->request->get('nombre');
        $usuariosxciclo =  Usuariosxciclo::findOrfail($id);
        /*$usuariosxciclo =  Usuariosxciclo::where('id',$id)
                            ->where('user_id1','<>',Auth::user()->id)->get();*/
        //dd($usuariosxciclo);
        $auditoria = Auditoria::with('ncsResueltasCount','ncsPendientesCount')
        ->where('usuariosxciclo_id','=', $usuariosxciclo->id)->get();
        $totalauditoria = $auditoria->count();
        $usuarios = User::lists('full_name','id');
        //dd($auditoria);
        //
        return view('admin.ciclos.auditoria.index',compact('usuariosxciclo', 'auditoria','totalauditoria','nombre','caracterizarnc','tiposnc',
        'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //dd('hola');
        $estadoncs = Estadosncs::lists('nombre','id');
        $caracterizarnc = Caracterizarncs::lists('nombre','id');
        $tiposnc = Tiposnc::lists('hallazgo','id');

        $auditoria = Auditoria::findOrFail($id);
        $ncs = Ncs::where('auditoria_id',$auditoria->id)->get();
        $usuarios = User::lists('full_name','id');
        //dd($ncs->first()->seguimientos);

        //dd($auditoria->usuariosxciclo->user_id);
        return view('admin.ciclos.auditoria.auditaractividad',compact('auditoria','ncs','estadoncs','tiposnc','usuarios','caracterizarnc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function auditaractividad($actividad){
        dd('voy a auditar');
    }
    public function certificaractividad($actividad){

        $data = $this->request->all();
        //dd($data['detalles']);
        $auditoria = Auditoria::findOrFail($actividad);
            
        $auditoria->certificado =  true;
        $auditoria->certificador = Auth::user()->id;
        $auditoria->detalles = $data['detalles'];
        $auditoria->save();
        return redirect()->route('admin.auditoria.edit',[$auditoria]);

    }

    public function quitarcertificacion($actividad){
        $auditoria = Auditoria::findOrFail($actividad);

        $auditoria->certificado =  false;
        $auditoria->certificador = Auth::user()->id;
        $auditoria->detalles = '';
        $auditoria->save();
        return redirect()->route('admin.auditoria.edit',[$auditoria]);
    }


}
