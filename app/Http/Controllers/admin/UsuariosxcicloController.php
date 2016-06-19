<?php

namespace App\Http\Controllers\admin;

use App\Auditoria;
use App\Ciclo;
use App\User;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosxcicloController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        //$ciclos = Ciclo::filtroPaginacion($nombre);
        $usuariosxciclo = Usuariosxciclo::all();
        //dd($usuariosxciclo);
        return view('admin.ciclos.usuariosxciclo.index',compact('usuariosxciclo','nombre','page','ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $usuariosxciclo = null;
        $usuarios = User::lists('full_name','id');
        $ciclos = Ciclo::lists('nombre','id');
        return view('admin.ciclos.usuariosxciclo.create',compact('usuarios','ciclos','usuariosxciclo'));
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
        //dd($request->all());
        $data = $request->all();
        foreach($data['usuarios'] as $usuario)
        {
            $usuariosxciclo = new Usuariosxciclo();
            $usuariosxciclo->user_id = $usuario;
            $usuariosxciclo->ciclo_id = $data['ciclo_id'];
            $usuariosxciclo->descripcion = $data['descripcion'];
            $usuariosxciclo->save();

            $actividades = $usuariosxciclo->ciclo->procedimiento->actividades;
            //dd($actividades);
            foreach ($actividades as $actividad)
            {
                $auditoria = new Auditoria();
                $auditoria->usuariosxciclo_id = $usuariosxciclo->id;
                $auditoria->actividad_id = $actividad->id;
                $auditoria->save();
            }
        }
        return redirect()->route('admin.usuariosxciclo.index');
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
        $usuariosxciclo = Usuariosxciclo::where('id','=',$id)
            ->first();
        return view('admin.usuariosxciclo.show',compact('ciclo'));
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
        $usuariosxciclo = Usuariosxciclo::findOrfail($id);
        $usuarios = User::lists('full_name','id');
        $ciclos = Ciclo::lists('nombre','id');
        //$activo = $this->request->get('activo');
        //dd($ciclo);

        return view('admin.ciclos.usuariosxciclo.edit',compact('ciclos','usuarios','usuariosxciclo'));

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
        //dd($request->all());
        $usuarioxciclo = Usuariosxciclo::findOrfail($id);
        $usuarioxciclo->fill($request->all());
        $usuarioxciclo->save();

        return redirect()->route('admin.usuariosxciclo.index');
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
        $usuarioxciclo = Usuariosxciclo::findOrfail($id);
        $usuarioxciclo->delete();
        return redirect()->route('admin.usuariosxciclo.index');
    }
}
