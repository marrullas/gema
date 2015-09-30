<?php

namespace App\Http\Controllers\admin;

use App\Actividad;
use App\Ciclo;
use App\Documento;
use App\Entrega;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EntregasController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //hay que buscar por nombre actividad y nombre ciclo
        $id = $this->request->get('id');
        $page = $this->request->get('page');
        $entregas = Entrega::filtroPaginacion($id);

        //dd($entregas);
        $totalentregas = $entregas->total();


        return view('admin.entregas.index',compact('id','page','entregas','totalentregas'));
    }

    public function ciclo($ciclo)
    {
        //hay que buscar por nombre actividad y nombre ciclo
        $id = $this->request->get('id');
        $page = $this->request->get('page');
        $entregas = Entrega::filtroPaginacionCiclo($ciclo);

        //dd($entregas);
        $totalentregas = $entregas->count();


        return view('admin.entregas.index',compact('ciclo','id','page','entregas','totalentregas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cicloid,$acividadid)
    {
        //
        $actividad = Actividad::find($acividadid);
        $ciclo = Ciclo::find($cicloid);
        $documentos = Documento::lists('id','nombre');
        $documento = $this->request->get('documento_id');

        return view('admin.entregas.create',compact('actividad','ciclo','documentos','documento'));
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
        $data = $request->all();
        //dd($data);
        $entrega = new Entrega($data);
        $entrega->save();
        return redirect()->route('admin.entrega.ciclo',[$entrega->ciclo_id]);
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
        $entrega = Entrega::find($id);
        return view('admin.entregas.show',compact('entrega'));
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
        $entrega = Entrega::find($id);
        $documentos = Documento::lists('id','nombre');
        $documento = $this->request->get('documento_id');

        return view('admin.entregas.edit',compact('entrega','documentos','documento'));
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
        $entrega = Entrega::findOrfail($id);
        $entrega->fill($request->all());
        $entrega->save();
        //return redirect()->back();
        return view('admin.entregas.show',compact('entrega'));
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
}
