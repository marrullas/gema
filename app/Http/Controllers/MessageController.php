<?php

namespace App\Http\Controllers;

use App\Mensaje;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    function __construct(\Illuminate\Http\Request $request)
    {
/*        if(!Auth::check())
            redirect()->login();*/
        $this->middleware('auth');
        $this->request = $request;
        //$this->userID =
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $userID = Auth::user()->id;



        $mensajes = Mensaje::where('tarea','=',false)
            ->where('destinatario','=',$userID)
            ->OrWhere('user_id','=',$userID)
            ->groupBY('user_id','codigo')//agrupamos por usuario y codigo para no repetir cuando son mensaje multiples
            ->orderBy('created_at','desc')
            ->get();
        return view('messages.index',compact('mensajes','userID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        //
        $respuesta =  false;
        $usuarios = User::lists('full_name','id');
        return view('messages.create',compact('usuarios','respuesta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreateMessageRequest $request)
    {
        //

        //dd('hola');

        $tmp = null;
        $data = $request->all();
        $conversacion = $this->request->get('conversacion');
        $respuesta = false; //para validar si el mensaje es un respuesta a otro mensaje
        //dd($conversacion);
        $codigoMsj = $this->getRandomStr();
        //validanmos si es una respuesta a otro mensaje
        if(empty($conversacion)) {
            //dd('aki entro');
            $conversacion = $codigoMsj;
        }
        else {
            $conversacion = $this->request->get('conversacion');
            $respuesta = true;
            Mensaje::where('codigo','=',$conversacion)->update(['status'=>'enviado']);
        }

        //dd($conversacion);

        foreach($data['destinatarios'] as $destinario)
        {
            if (!$tmp)
            {
                $tmp = $destinario;
            }
            else
            {
                $tmp .= ',' . $destinario;
            }
            //crear mensaje por cada destinatario
        }
        foreach($data['destinatarios'] as $destinario)
        {

            //crear mensaje por cada destinatario
            $message =  new Mensaje();
            $message->codigo = $codigoMsj;
            $message->conversacion = $conversacion;
            $message->titulo = $data['titulo'];
            $message->contenido = $data['contenido'];
            $message->destinatario = $destinario;
            $message->destinatarios = $tmp;
            $message->user_id = Auth::user()->id;
            $message->respuesta = $respuesta;
            $message->save();

        }

        //$usuarios = User::lists('full_name','id');
        Session::flash('message','Mensaje enviado!!');
        //return view('messages.create',compact('usuarios'));
        return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {


        $mensajeOri = Mensaje::findOrfail($id);


            //buscamos el mensaje principal
            $conversacion = Mensaje::select('id','codigo','destinatarios')
                ->where('codigo','=',$mensajeOri->conversacion)
                ->where('conversacion','=',$mensajeOri->conversacion)
                ->get();

            $mensajes = Mensaje::where('id','=',$conversacion->first()->id)
                ->Orwhere(function($query) use ($conversacion){

                    return $query->where('conversacion','=',$conversacion->first()->codigo)
                        ->where('respuesta','=',true);
                })
                ->get();


        $mensajeOri->status = 'leido';
        $mensajeOri->save();
        $usuarios = User::lists('full_name','id');
        $respuesta = true;
        $userID = Auth::user()->id;
        return view('messages.show',compact('mensajes','usuarios','respuesta','mensajeOri','userID'));

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
     * @param  int  $id
     * @return Response
     */
    public function update($id)
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
        $mensaje = Mensaje::findOrfail($id);
        $mensaje->delete();
        Session::flash('message','Mensaje Eliminado!!');
        if($mensaje->respuesta) {
            //buscamos el mensaje principal
            $conversacion = Mensaje::select('id','codigo','destinatarios')
                ->where('codigo','=',$mensaje->conversacion)
                ->where('conversacion','=',$mensaje->conversacion)
                ->get();

            return redirect()->action('MessageController@show',[$conversacion->first()->id]);
        }
        else{
            Mensaje::where('conversacion','=',$mensaje->codigo)->delete();
            return redirect()->action('MessageController@index');

        }




    }

    private function getRandomStr()
    {
        return md5(microtime());
    }
}
