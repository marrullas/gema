<?php

namespace App\Http\Controllers;

use App\Files;
use App\Tipodocumento;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FilesController extends Controller
{
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
    protected $request;

    function __construct(Request $request)
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth');
        $this->request = $request;
        if(Auth::user())
            $this->userID = Auth::user()->id;
        else
            redirect('/');
    }


    public function upload() {


        //dd($this->request->all());
        $data = $this->request->all();

            // checking file is valid.
            if (Input::file('file')->isValid()) {
                /*
                 * Si el archivo es valido entonces creamos el registro en la DB
                 * */
                $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                $file = new Files();
                //$file->tarea_id = $data['tarea_id'];
                $file->prefijo = $data['prefijo'];
                $file->codigo = $data['codigo'];
                $file->filename = Input::file('file')->getClientOriginalName();
                $file->mime = Input::file('file')->getMimeType();
                $file->size = Input::file('file')->getSize();
                //$file->storage_path = 'uploads/'.$data['tarea_id'].'/'.$fileName;
                $file->storage_path = 'uploads/'.$data['prefijo'].'/'.$data['codigo'].'/'.$fileName;
                $file->status = true;
                $file->user_id = Auth::user()->id;
                $file->descripcion =  $data['descripcion'];
                $file->tipodocumento_id = $data['tipodocumento_id'];
                $file->ambitosxciclo_id = $data['ambitosxciclo_id'];
                $file->save();
                //$destinationPath = 'uploads/'.$data['tarea_id']; // upload path
                $destinationPath = 'uploads/'.$data['prefijo'].'/'.$data['codigo']; // upload path
                Input::file('file')->move($destinationPath,$fileName); // uploading file to given path
                // sending back with message
                //Session::flash('success', 'Upload successfully');
                //return Redirect::to('upload');
                //$filelink = array('path'=>$destinationPath.'/'.$fileName);
                //return $filelink;
                $respuesta['file'] = $file;
                $respuesta['mensaje'] = "Archivo subido";
                return $respuesta;
            }
            else {
                // sending back with error message.
                //Session::flash('error', 'uploaded file is not valid');
                //return Redirect::to('upload');
                $respuesta['file'] = null;
                $respuesta['mensaje'] = "No fue posible subir el archivo";
                return $respuesta;
            }
        //}
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        //$data = $this->request->all();
        //dd($id);
        return Files::all();
    }


    /**
     * @param $id codigo del archivo (depende de la entidad)
     * @param $axcid codigo de la tabla ambitosxciclo
     * @param $prefijo prefijo del archivo
     * @return mixed
     */
    public function filesentrega($id,$axcid,$prefijo)
    {
        //
        // $data = $this->request->all();
        //dd($prefijo);
        return Files::where('codigo','=',(integer)$id)
            ->where('prefijo','=',$prefijo)
            ->where('ambitosxciclo_id','=',$axcid)
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //

        $data = $request->all();
        //dd($data);
        $prefijo = $data['prefijo'];
        $codigo = $data['codigo'];
        $tipodocumentos = Tipodocumento::lists('nombre','id');
        return view('files.create',compact('prefijo','codigo','tipodocumentos'));
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
        //dd($this->request->all());
        $data = $this->request->all();

        // checking file is valid.
        if (Input::file('file')->isValid()) {
            /*
             * Si el archivo es valido entonces creamos el registro en la DB
             * */
            $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $file = new Files();
            //$file->tarea_id = $data['tarea_id'];
            $file->prefijo = $data['prefijo'];
            $file->codigo = $data['codigo'];
            $file->filename = Input::file('file')->getClientOriginalName();
            $file->mime = Input::file('file')->getMimeType();
            $file->size = Input::file('file')->getSize();
            $file->storage_path = 'uploads/'.$data['prefijo'].'/'.$data['codigo'].'/'.$fileName;
            $file->status = true;
            $file->user_id = Auth::user()->id;
            $file->descripcion =  $data['descripcion'];
            $file->tipodocumento_id = $data['tipodocumento_id'];
            //$file->ambitosxciclo_id = $data['ambitosxciclo_id'];
            $file->save();
            $destinationPath = 'uploads/'.$data['prefijo'].'/'.$data['codigo']; // upload path
            Input::file('file')->move($destinationPath,$fileName); // uploading file to given path
            Session::flash('message','Archivo agregado');
            // sending back with message
            //Session::flash('success', 'Upload successfully');
            //return Redirect::to('upload');
            //$filelink = array('path'=>$destinationPath.'/'.$fileName);
            //return $filelink;
            switch($data['prefijo'])
            {
                case 'AC':
                    return redirect()->route('admin.actividades.show',$data['codigo']);
            }


        }
        else {
            // sending back with error message.
            //Session::flash('error', 'uploaded file is not valid');
            //return Redirect::to('upload');
            $respuesta['file'] = null;
            $respuesta['mensaje'] = "No fue posible subir el archivo";
            return $respuesta;
        }
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
        //validar que el archivo pertenezca al usuario o sea un ADMIN
        //$userID = Auth::user()->id;

        $data = $this->request->all();
        //dd($data);
        $file = Files::where('id','=',$id)
            //->where('user_id','=',$userID)
            ->first();
        if(File::exists($file->storage_path))
        {
            File::delete($file->storage_path);
        }
        if($file->count() > 0){
            $file->delete();
            $respuesta['file'] = $file;
            $respuesta['mensaje'] = "Archivo eliminado";
            Session::flash('message','Archivo Eliminado');
        }
        else{
            $respuesta['file'] = null;
            $respuesta['mensaje'] = "No fue posible eliminar el archivo";
        }

        if ($this->request->ajax()) {
            return $respuesta;
        }
        else{
            switch ($data['desde']){
                case 'actividad':

                    return redirect()->route('admin.actividades.show',$data['actividad']);
                break;
            }
        }
    }



    /**
     * funcion para retornar los archivos que pertenecen a una tarea
     */
    public function filesxtarea($id)
    {
        $files = Files::where('tarea_id','=',$id)
            ->get();

        return $files;
    }
}
