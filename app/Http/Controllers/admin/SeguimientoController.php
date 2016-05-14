<?php

namespace App\Http\Controllers\admin;


use App\Estadoseguimiento;
use App\Seguimiento;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nombre = '';
        $seguimientos = Seguimiento::filtroPaginación();

        //dd($seguimientos);
        return view('admin.seguimientos.index',compact('seguimientos','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::lists('full_name','id');
        $estadoseguimiento = Estadoseguimiento::lists('nombre','id');

        return view('admin.seguimientos.create',compact('usuarios','estadoseguimiento'));


        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateSeguimientoRequest $request)
    {
        //

        $data = $request->all();
        //dd($data);
        $seguimiento =  new Seguimiento($data);
        $seguimiento->user_id = Auth::user()->id;
        $seguimiento->save();
        return redirect()->route('admin.seguimientos.index');
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
