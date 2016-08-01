<?php

namespace App\Http\Controllers\admin;

use App\Ciclo;
use App\Ncs;
use App\User;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportesController extends Controller
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
    //
    /*
     * Consulta el estatus general de los ciclos
     */
    public function ciclosgral()
    {
        $usuario = $this->request->get('usuario');
        $auditor = $this->request->get('auditor');
        $ciclo = $this->request->get('ciclo');
        $usuariosnc = [''=>''] + Ncs::usuariosncdeauditor($auditor);
        $auditores = [''=>''] + User::where('type','auditor')->lists('full_name','id')->all();
        $ciclos = [''=>''] + Ciclo::lists('nombre','id')->all();
        $resumenciclos = Usuariosxciclo::resumenciclos($ciclo,$auditor,$usuario);
        $totalncsxciclo = Usuariosxciclo::totalncsxciclo($ciclo,$auditor,$usuario);
        $resumenncxusuario = Usuariosxciclo::resumenncsxusuario($ciclo,$auditor,$usuario);
        $ncsxauditor = Ncs::ncsxuaditor($ciclo,$auditor,$usuario);
        $ncsxactividadxciclo  = Ncs::ncsxactividadxciclo($ciclo,$auditor,$usuario);
        //dd($ncsxauditor);
        return view('admin.ciclos.reportes.home',compact('resumenciclos','totalncsxciclo','resumenncxusuario',
            'ncsxauditor','usuariosnc','usuario','auditores','ciclos','auditor','ciclo','ncsxactividadxciclo'));
    }

}
