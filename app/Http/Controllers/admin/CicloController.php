<?php

namespace App\Http\Controllers\admin;


use App\Ciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $ciclos = Ciclo::filtroPaginación($nombre);

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
        $ambitos = \App\Ambito::lists('nombre','id');
        $ciclo = (object) ['fecha_ini' => \Carbon\Carbon::now(),'activo'=>1]; //se inicializan valores por defecto
        //$ciclo = (object) ['fecha_fin' => \Carbon\Carbon::now()];
        $activo = $this->request->get('activo');
        //dd($ciclo);
        return view('admin.ciclos.create',compact('ciclo','ambitos','activo'));
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


        //dd($data);
        $ciclo  = new Ciclo($data);
        if(empty($activo))
            $ciclo->activo = false;
        //$ciclo->user_id = $userID;

        $ciclo->save();
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
        $ciclo = Ciclo::where('id','=',$id)
            //->where('user_id','=',Auth::user()->id)
            ->first();

        return view('admin.ciclos.show',compact('ciclo'));
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
        $activo = $this->request->get('activo');
        //dd($ciclo);

        return view('admin.ciclos.edit',compact('ciclo','ambitos','activo'));
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
        if(empty($activo))
            $ciclo->activo = false;
        dd($request->all());
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

        //User::destroy($id); eliminar directamente
        Session::flash('message',$message);
        return redirect()->route('admin.ciclos.index');
    }
}
