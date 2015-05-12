<?php namespace App\Http\Controllers;

use App\Evento;
use App\Ficha;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\EditEventoRequest;
use App\Tipoactividad;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Message\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventosController extends Controller {

    protected $request, $user_logged;

    function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
        //$this->user_logged = $this->request->user()->id;


    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($userID = null)
	{
		//
        //validar que el calendario pertenesca al usuario o que sea un admistrador




        if(empty($userID)) {
            $user_id = $this->request->user()->id;
            $userID = $user_id;
        }
        else
            $user_id = $userID;

        if($userID != $this->request->user()->id && !$this->request->user()->isAdminOrlider())
        {
            Session::flash('message','Error, prohibido acceso a otros calendarios');
            return Redirect::back();
        }

        //dd($userID);

        if(empty($user_id))
        {
            Session::flash('message','Debe selecionar algun usuario');
            return redirect()->route('users.index');

        }else {

            try{

                $nombreuser = User::findOrfail($user_id)->full_name;
            }
            catch(ModelNotFoundException $e){
                Session::flash('message',$e->getMessage());
                return redirect()->route('users.index');

            }



        }

        $fichas = Ficha::where('user_id',$user_id)->where('estado','activa')->lists('full_name','id');
        $calendar = Evento::getCalendar($this->request->user(),$user_id);
        $tipoactividades = Tipoactividad::all()->lists('nombre','id');
        $calId = $calendar->getId();

        return view('calendar.index', compact('calendar', 'calId','user_id','fichas','nombreuser','tipoactividades'));
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
	 * @return Response
	 */
	public function store(CreateEventoRequest $request)
	{
		$data = $request->all();

        $evento = new Evento($data);

        if (!$this->request->get('all_day') ) {
            $evento->all_day = 0;
            //calcular numero de horas
            $fecha_ini = new Carbon($data['start']);
            $fecha_fin = new Carbon($data['end']);
            $numeroHoras = $fecha_ini->diffInHours($fecha_fin);
            $evento->horas = ($numeroHoras > 8)
                ? 8
                : $numeroHoras;

        }
        else {
            $evento->all_day = 1;
            $evento->horas = 8;
        }


        //dd($evento);

        //dd(\Carbon\Carbon::parse($data['start'])->toIso8601String());
        /*
        $evento = new Evento();
        $evento->user_id = 1;
        $evento->title = $data['title'];
        $evento->all_day = $data['all_day'];
        $evento->start = new \DateTime($data['start']);
        $evento->end = new \DateTime($data['end']);*/
        //$evento->end = \Carbon\Carbon::parse($data['end'])->toIso8601String();
        //dd($evento);
        $evento->actividad =  Tipoactividad::find($data['title'])->nombre;

        $evento->save();

        Session::flash('message','Evento Creado!!');



        return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $evento = Evento::with(['ficha','ficha.ie','ficha.ie.ciudad','tipoactividad'])->findOrfail($id);
        if ($this->request->ajax()) {
        return $evento->toArray();
        }
        //dd($evento->ficha()->first()->ie()->first()->ciudad()->first()->nombre);

        dd($evento->toArray());

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{


        //validar que sea un evento del usuario o que sea un usuario admin o lider

        $evento = Evento::findOrfail($id);
        $isAdminOrLider = $this->request->user()->isAdminOrLider();
        $tipoactividades = Tipoactividad::all()->lists('nombre','id');


        if($this->request->user()->id == $evento->user_id || $isAdminOrLider)         //validar tipos de usuario
        {

            //$fichas = Ficha::lists('codigo', 'id');
            $fichas = Ficha::where('user_id',$this->request->user()->id)->where('estado','activa')->lists('full_name','id');
            return view('calendar.edit', compact('evento', 'fichas','isAdminOrLider','tipoactividades'));
        }
        else{
            Session::flash('message','Error al editar evento, no puede editar eventos de otros usuarios');
            return Redirect::back();

        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditEventoRequest $request,$id)
    {
        //dd($request->all());
        $data = $request->all();
        $evento = Evento::findOrfail($id);
        $evento->fill($data);

        if (!$this->request->get('all_day') ) {
            $evento->all_day = 0;
            //calcular numero de horas
            $fecha_ini = new Carbon($data['start']);
            $fecha_fin = new Carbon($data['end']);
            $numeroHoras = $fecha_ini->diffInHours($fecha_fin);
            $evento->horas = ($numeroHoras > 8)
                            ? 8
                            : $numeroHoras;

        }
        else {
            $evento->all_day = 1;
            $evento->horas = 8;
        }

        $evento->actividad =  Tipoactividad::find($data['title'])->nombre;

        //dd($evento);


        $evento->save();

        return redirect()->back();
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

}
