<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Auditoria;
use App\Estadosncs;
use App\Files;
use App\Ncs;
use App\Tiposnc;
use App\User;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuditoriaController extends Controller
{
    //
    protected $request;

    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth');
        $this->request = $request;
    }

    public function index()
    {
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        //$ciclos = Ciclo::filtroPaginacion($nombre);
        $usuariosxciclo = Usuariosxciclo::where('user_id',Auth::user()->id)->get();
        //dd($usuariosxciclo);
        return view('auditoria.index',compact('usuariosxciclo','nombre','page','ciclos'));
    }
    public function veractividades($id)
    {
        $estadoncs = Estadosncs::lists('id','nombre');
        $tiposnc = Tiposnc::lists('id','hallazgo');
        //$nombre = $this->request->get('nombre');
        $usuariosxciclo =  Usuariosxciclo::findOrfail($id);
        $auditoria = Auditoria::with('ncsResueltasCount','ncsPendientesCount')
            ->where('usuariosxciclo_id','=', $usuariosxciclo->id)->get();
        $totalauditoria = $auditoria->count();
        $usuarios = User::lists('full_name','id');
        //dd($auditoria);
        //
        return view('auditoria.actividades',compact('usuariosxciclo', 'auditoria','totalauditoria','nombre','estadoncs','tiposnc',
            'usuarios'));
    }
    public function auditaractividad($id)
    {
        $estadoncs = Estadosncs::lists('nombre','id');
        $tiposnc = Tiposnc::lists('hallazgo','id');

        $auditoria = Auditoria::findOrFail($id);
        $ncs = Ncs::where('auditoria_id',$auditoria->id)->get();
        $usuarios = User::lists('full_name','id');
        //dd($ncs->first()->seguimientos);

        //dd($auditoria->usuariosxciclo->user_id);
        return view('auditoria.auditaractividad',compact('auditoria','ncs','estadoncs','tiposnc','usuarios'));

    }
    public function mostrarncs()
    {
        //dd('las ncs pendientes');
        $nombre = $this->request->get('nombre');
        $ncs = Ncs::where('user_id',Auth::user()->id)->get();
        //dd($ncs);
        return view('auditoria.mostrarncs',compact('nombre','ncs'));
    }

    public function showactividad($id)
    {
        $files = Files::where('codigo','=',$id)
            ->where('prefijo','=','AC')
            ->get();
        $actividad = Actividad::with('procedimiento')
            ->where('id','=',$id)
            //->where('user_id','=',Auth::user()->id)
            ->first();
        return view('auditoria.showactividad',compact('actividad','files'));
    }
    
}
