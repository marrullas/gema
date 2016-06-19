<?php

namespace App\Http\Controllers;

use App\Ncs;
use App\Seguimientoncs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NcsController extends Controller
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
        $nc = new Ncs();
        $nc->fill($request->all());
        $nc->auditor = Auth::user()->id;
        $nc->certificador = Auth::user()->id;
        $nc->save();
        $seguimientonc = new Seguimientoncs();
        $text = "<em>Auditor abre nc</em><br>";
        $seguimientonc->ncs_id = $nc->id;
        $seguimientonc->user_id = Auth::user()->id;
        $seguimientonc->detalle = $text;
        $seguimientonc->save();
        if(Auth::user()->isAdmin())
        return redirect()->route('admin.auditoria.edit',[$this->request->all()['auditoria_id']]);

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
        $detalles = $request->get('detalles');
        $ncs = Ncs::findOrfail($id);
        $ncs->fill($request->all());

        if ($request->get('estadoncs_id')==2)
            $text = "<em>Usuario ".Auth::user()->full_name. " devuelve para ser revisada</em><br>";
        if ($request->get('estadoncs_id')==3) {
            $text = "<em>Usuario Auditor Cierra</em><br>";
            $ncs->certificador = Auth::user()->id; //el que cierra la nc
        }
        $ncs->save();

        if (!empty($detalles))
            $text = $text.$detalles;
        $seguimientonc = new Seguimientoncs();
        $seguimientonc->ncs_id = $ncs->id;
        $seguimientonc->user_id = Auth::user()->id;
        $seguimientonc->detalle = $text;
        $seguimientonc->save();
        return redirect()->back();
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

    public function guardarnc(){
        //dd($this->request->all());
        $nc = new Ncs();
        $nc->fill($this->request->all());
        $nc->auditor = Auth::user()->id;
        $nc->certificador = Auth::user()->id;
        $nc->save();

        return redirect()->route('admin.auditoria.edit',[$this->request->all()['auditoria_id']]);
    }

    public function devolvernc(){
        //dd($this->request->all());
        $nc = new Ncs();
        $nc->fill($this->request->all());
        $nc->auditor = Auth::user()->id;
        $nc->certificador = Auth::user()->id;
        $nc->save();

        return redirect()->route('admin.auditoria.edit',[$this->request->all()['auditoria_id']]);
    }
}
