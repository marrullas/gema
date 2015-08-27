<?php

namespace App\Http\Controllers;

use App\Acta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ActaController extends Controller
{
    protected $request;

    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth');
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
        $UserID = Auth::user()->id;
        $actas = Acta::filtroPaginación($UserID);
        $page = $this->request->get('page');
        $codigo = $this->request->get('codigo');
        //dd($actas);
        return view('actas.index',compact('page','codigo','actas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('actas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $vienearchivo = false;
        $data = $request->all();

        $acta = new Acta($data);
        $acta->prefijo = 'AR';
        $acta->user_id = Auth::user()->id;
        $acta->save();
        $idActa = $acta->id;
        if(!empty($data->archivo)) {
            if (Input::file('archivo')->isValid()) {
                $destinationPath = 'uploads/actas/' . $idActa . '/'; // upload path
                $extension = Input::file('archivo')->getClientOriginalExtension(); // getting image extension
                //$fileName = $idActa . '.' . $extension; // renameing image
                $fileName = Input::file('archivo')->getClientOriginalName();
                Input::file('archivo')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                //Session::flash('success', 'Upload successfully');
                //return Redirect::to('upload');
                $acta->archivo_nombre = $fileName;
                $acta->archivo_ext = $extension;
                $acta->archivo = $destinationPath . $fileName;
                $acta->save();
            }
        }
        return redirect()->action('ActaController@show',compact('idActa'));
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

        $acta = Acta::with('user','evento')
            ->where('id','=',$id)
            ->where('user_id','=',Auth::user()->id)
                ->first();
        return view('actas.show',compact('acta'));
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
        $acta = Acta::with('user','evento')
            ->where('id','=',$id)
            ->first();
        return view('actas.edit',compact('acta'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
    public function todas()
    {
        //dd('akientre');
        $nombre = $this->request->get('nombre');
        $actas = Acta::filtroPaginaciónTodas($nombre);
        $page = $this->request->get('page');
        $codigo = $this->request->get('codigo');
        //dd($actas);
        return view('actas.index',compact('page','codigo','actas'));
    }
}
