<?php

namespace App\Http\Controllers;


use App\Lista;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListasController extends Controller
{

    protected $request;
    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @return void
     * @link http://php.net/manual/en/language.oop5.decon.php
     */
    function __construct(Request $request)
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    //public function store(Request $request)
    public function store()
    {
        //

        $data = $this->request->all();

        $userID = Auth::user()->id;
        $lista = new Lista($data);
        $lista->user_id = $userID;

        $lista->save();


        return $this->request->wantsJson() ? $lista : Redirect::back();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $data = $this->request->all();
        $userID = Auth::user()->id;
        $lista = Lista::find($id);
        if($lista->user_id == $userID){
            $lista->fill($data);
            $lista->save();
            $respues['lista'] = $lista;
            $respuesta['mensaje'] = "Lista actualizada correctamente";

        }
        else{
            $respues['lista'] = null;
            $respuesta['mensaje'] = "Lista actualizada correctamente";
        }
        return $this->request->wantsJson() ? $respuesta : Redirect::back();
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
        $userID = Auth::user()->id;
        $lista = Lista::where('id','=',$id)
                ->where('user_id','=',$userID)
                ->first();
        if($lista->count() > 0){
            $lista->delete();
            $respuesta['lista'] = $lista;
            $respuesta['mensaje'] = "Lista eliminada";
        }
        else{
            $respuesta['lista'] = null;
            $respuesta['mensaje'] = "No fue posible eliminar la lista";
        }

    }

    public function lista()
    {
        /*
         * SELECT listas. * , (

                SELECT COUNT( tareas.id )
                FROM tareas, tareasxusuario
                WHERE tareas.id = tareasxusuario.tarea_id
                AND tareas.lista = listas.id
                AND tareasxusuario.hecho =
                FALSE
                ) AS numero_tareas
                FROM listas
                LEFT JOIN tareas ON tareas.lista = listas.id
                LEFT JOIN tareasxusuario ON tareas.id = tareasxusuario.tarea_id
                WHERE user_id =6
                GROUP BY listas.id
         */
        $userID =  Auth::user()->id;

        $listatareas =  DB::table('listas')
            ->selectRaw('listas.*, (
                SELECT COUNT( tareas.id )
                FROM tareas, tareasxusuario
                WHERE tareas.id = tareasxusuario.tarea_id
                AND tareas.lista = listas.id
                AND tareasxusuario.hecho =
                FALSE
                ) AS numero_tareas')
            ->leftjoin('tareas','tareas.lista','=','listas.id')
            ->where('user_id','=', $userID)
            ->groupBy('listas.id')
            ->get();

        return $listatareas;
    }
}
