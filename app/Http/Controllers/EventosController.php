<?php namespace App\Http\Controllers;

use App\Evento;
use App\Ficha;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\EditEventoRequest;
use App\Tipoactividad;
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

        $evento = Evento::with(['ficha','ficha.ie','tipoactividad'])->findOrfail($id);
        if ($this->request->ajax()) {
        return $evento->toArray();
        }
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

        //dd($this->request->user()->id);

        //validar que sea un evento del usuario o que sea un usuario admin o lider

        $evento = Evento::findOrfail($id);
        $isAdminOrLider = $this->request->user()->isAdminOrLider();
        $tipoactividades = Tipoactividad::all()->lists('nombre','id');


        if($this->request->user()->id == $evento->user_id || $isAdminOrLider)         //validar tipos de usuario
        {

            $fichas = Ficha::lists('codigo', 'id');
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
