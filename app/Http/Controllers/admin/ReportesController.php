<?php

namespace App\Http\Controllers\admin;

use App\Ncs;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportesController extends Controller
{
    //
    /*
     * Consulta el estatus general de los ciclos
     */
    public function ciclosgral()
    {
        $resumenciclos = Usuariosxciclo::resumenciclos();
        $totalncsxciclo = Usuariosxciclo::totalncsxciclo();
        $resumenncxusuario = Usuariosxciclo::resumenncsxusuario();
        $ncsxauditor = Ncs::ncsxuaditor();
        //dd($ncsxauditor);
        return view('admin.ciclos.reportes.home',compact('resumenciclos','totalncsxciclo','resumenncxusuario','ncsxauditor'));
    }

}
