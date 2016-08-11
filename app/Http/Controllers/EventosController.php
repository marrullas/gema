<?php namespace App\Http\Controllers;

use App\Bitacora;
use App\Evento;
use App\Ficha;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\EditEventoRequest;
use App\Repositories\EventoRepository;
use App\Tipoactividad;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Message\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EventosController extends Controller {

    protected $request, $user_logged;
    /**
     * @var EventoRepository
     */
    private $eventoRepository;

    function __construct(\Illuminate\Http\Request $request, EventoRepository $eventoRepository)
    {
        $this->middleware('auth');
        $this->request = $request;
        //$this->user_logged = $this->request->user()->id;


        $this->eventoRepository = $eventoRepository;
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

        Session::put('regresar', 'calendario');

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

        $user = User::find($user_id);

        $fichas = Ficha::where('user_id',$user_id)->where('estado','activa')->lists('full_name','id');
        $calendar = Evento::getCalendar($this->request->user(),$user_id);
        $tipoactividades = Tipoactividad::all()->lists('nombre','id');
        $calId = $calendar->getId();

        return view('calendar.index', compact('calendar', 'calId','user_id','fichas','nombreuser','tipoactividades','regresar','user'));
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
            $fecha_ini = new Carbon(\Carbon\carbon::createFromFormat('d/m/Y H:i',$data['start']));
            $fecha_fin = new Carbon(\Carbon\carbon::createFromFormat('d/m/Y H:i',$data['end']));
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
        $volverlista = true;
        $evento = Evento::findOrfail($id);
        //validar que sea un evento del usuario o que sea un usuario admin o lider

        $isAdminOrLider = $this->request->user()->isAdminOrLider();
        $tipoactividades = Tipoactividad::all()->lists('nombre','id');


        if($this->request->user()->id == $evento->user_id || $isAdminOrLider)         //validar tipos de usuario
        {

            //$fichas = Ficha::lists('codigo', 'id');
            $fichas = Ficha::where('user_id',$this->request->user()->id)->where('estado','activa')->lists('full_name','id');
            return view('calendar.edit', compact('evento', 'fichas','isAdminOrLider','tipoactividades','volverlista','regresar'));
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

        //Session::put('regresar', Session::get('regresar'));
        //dd(Session  ::get('regresar'));
        $data = $request->all();
        $evento = Evento::findOrfail($id);

        $hoy = Carbon::now();
        //$fechaevento = Carbon::create($evento->start);
        if($hoy->diffInDays($evento->start,false)<0)//si modifica datos de fechas anteriores almacena el cambio
            $this->addbitacora(\Auth::user()->id,'actualizar',$evento);

        $evento->fill($data);

        if (!$this->request->get('all_day') ) {
            $evento->all_day = 0;
            //calcular numero de horas
            $fecha_ini = new Carbon(\Carbon\carbon::createFromFormat('d/m/Y H:i',$data['start']));
            $fecha_fin = new Carbon(\Carbon\carbon::createFromFormat('d/m/Y H:i',$data['end']));
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

        $evento = Evento::findOrfail($id);
        $hoy = Carbon::now();
        if($hoy->diffInDays($evento->start,false)<0)//si borra datos de fechas anteriores almacena el cambio
            $this->addbitacora(\Auth::user()->id,'borrar',$evento);
        $evento->delete();
        $message = trans('validation.attributes.eventodelete').' : '.$evento->actividad . ' para la fecha: ' . $evento->start;
        if($this->request->ajax()){

            return response()->json([
                'id'=>$evento->id,
                'message'=>$message
            ]);
        }

        //User::destroy($id); eliminar directamente
        Session::flash('message',$message);
        return redirect()->route('calendar.index');
	}

    public function agenda($userId = null)
    {

        Session::put('regresar', 'eventos');

        if(empty($userId))
            $user = \Auth::user();
        else
            $user = User::find($userId);

        //Session::flash('regresar', 'eventos');


        $fichasasignadas = Evento::fichasAsignadas($user->id);

        $horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;
        //$totalhorasmes = $horasUser->first()->horas;
        $reporte = false;

        switch($user->type)
        {
            case 'admin':
                //return view('admin.users.home',compact('user','fichasasignadas'));
                return view('instructor.eventos',compact('user','fichasasignadas','totalhorasmes','reporte'));
                break;
            case 'auditor':
                //return view('admin.users.home',compact('user','fichasasignadas'));
                return view('instructor.eventos',compact('user','fichasasignadas','totalhorasmes','reporte'));
                break;
            case 'user':
                return view('user.home',compact('user','fichasasignadas'));
            case 'instructor':
                return view('instructor.eventos',compact('user','fichasasignadas','totalhorasmes','reporte'));
            default:
                return view('auth.login');


        }
    }
    public function agendaexcel($userId = null)
    {

        if(empty($userId))
            $user = \Auth::user();
        else
            $user = User::find($userId);

        //Session::flash('regresar', 'eventos');
        $horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;

        $fichasasignadas = Evento::fichasAsignadas($user->id);

        Excel::create('reporte agenda', function($excel) use($fichasasignadas,$horasUser,$totalhorasmes){

            $excel->sheet('agenda', function($sheet) use($fichasasignadas,$horasUser,$totalhorasmes){

                $sheet->loadView('instructor.partials.tableedit',['fichasasignadas'=>$fichasasignadas,
                    'horasUser'=>$horasUser,'totalhorasmes'=>$totalhorasmes,'reporte'=>true]);

            });

        })->export('xls');

/*        if(!empty($user)) {
                Excel::create('Informe agenda', function ($excel) use($fichasasignadas){

                    $excel->sheet('agenda', function ($sheet) use($fichasasignadas){
                        $datos = $fichasasignadas;
                        $sheet->fromArray($datos);
                    });
                })->export('xls');
        }*/


    }

    public function actividades($userId = null)
    {

        //Session::put('regresar', 'eventos');
        $userId = $this->request->get('userId');

        if(empty($userId))
            $user = \Auth::user();
        else
            $user = User::find($userId);

        //Session::flash('regresar', 'eventos');

        $start =  $this->request->get('start');
        $end = $this->request->get('end');
        if(!empty($start) && !empty($end))
        {
            $actividades = Evento::actividadesxmes($user->id,[$start,$end]);
            $actividadestotal = Evento::actividadesxmestotal($user->id,[$start,$end]);
            $horasUser = Evento::HorasAcumuladas($user->id,[$start,$end]);

        }
        else {
            $actividades = Evento::actividadesxmes($user->id);
            $actividadestotal = Evento::actividadesxmestotal($user->id);
            $horasUser = User::find($user->id)->horas_acumuladas;
        }

        //$horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;
        //$totalhorasmes = $horasUser->first()->horas;
        $reporte = false;

        switch($user->type)
        {
            case 'admin':
            //return view('admin.users.home',compact('user','fichasasignadas'));
            return view('instructor.actividades',compact('user','actividades','actividadestotal','totalhorasmes','reporte','start','end'));
            break;
            case 'auditor':
                //return view('admin.users.home',compact('user','fichasasignadas'));
                return view('instructor.actividades',compact('user','actividades','actividadestotal','totalhorasmes','reporte','start','end'));
                break;
            case 'user':
                return view('user.home',compact('user','actividades'));
            case 'instructor':
                return view('instructor.actividades',compact('user','actividades','actividadestotal','totalhorasmes','reporte','start','end'));
            default:
                return view('auth.login');


        }
    }
    public function actividadesexcel($userId = null)
    {

        if(empty($userId))
            $user = \Auth::user();
        else
            $user = User::find($userId);

        $start =  $this->request->get('start');
        $end = $this->request->get('end');
        if(!empty($start) && !empty($end))
        {
            $actividades = Evento::actividadesxmes($user->id,[$start,$end]);
            $actividadestotal = Evento::actividadesxmestotal($user->id,[$start,$end]);
            $horasUser = Evento::HorasAcumuladas($user->id,[$start,$end]);

        }
        else {
            $actividades = Evento::actividadesxmes($user->id);
            $actividadestotal = Evento::actividadesxmestotal($user->id);
            $horasUser = User::find($user->id)->horas_acumuladas;
        }
        //$horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;

        Excel::create('reporte actividades', function($excel) use($actividades,$actividadestotal,$horasUser,$totalhorasmes){

            $excel->sheet('actividadesxficha', function($sheet) use($actividades,$horasUser,$totalhorasmes){

/*                $sheet->row(1, array(
                    'test1', 'test2'
                ));*/

                $sheet->loadView('instructor.partials.tableactividades',['actividades'=>$actividades,
                    'horasUser'=>$horasUser,'totalhorasmes'=>$totalhorasmes,'reporte'=>true]);

            });
            $excel->sheet('actividades_acumulado', function($sheet) use($actividadestotal,$horasUser,$totalhorasmes){
                $sheet->loadView('instructor.partials.tableactividadestotal',['actividadestotal'=>$actividadestotal,
                    'horasUser'=>$horasUser,'totalhorasmes'=>$totalhorasmes,'reporte'=>true]);

            });

        })->export('xls');

        /*        if(!empty($user)) {
                        Excel::create('Informe agenda', function ($excel) use($fichasasignadas){

                            $excel->sheet('agenda', function ($sheet) use($fichasasignadas){
                                $datos = $fichasasignadas;
                                $sheet->fromArray($datos);
                            });
                        })->export('xls');
                }*/


    }


    public function acumuladoxficha($userId = null)
    {

        $userId = $this->request->get('userId');

        if(empty($userId))
            $user = \Auth::user();
        else
            $user = User::find($userId);


        $start =  $this->request->get('start');
        $end = $this->request->get('end');
        if(!empty($start) && !empty($end))
        {
/*            $actividades = Evento::actividadesxmes($user->id,[$start,$end]);
            $actividadestotal = Evento::actividadesxmestotal($user->id,[$start,$end]);*/
            $horasUser = $this->eventoRepository->HorasAcumuladas($user,[$start,$end]);

            $fichasasignadas = $this->eventoRepository->acumuladoxficha($user,[$start,$end]);

        }
        else {
/*            $actividades = Evento::actividadesxmes($user->id);
            $actividadestotal = Evento::actividadesxmestotal($user->id);*/
            $horasUser = $this->eventoRepository->HorasAcumuladas($user);
            $fichasasignadas = $this->eventoRepository->acumuladoxficha($user);
        }

        //$horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;
        //$totalhorasmes = $horasUser->first()->horas;
        $reporte = false;

        switch($user->type)
        {
            case 'admin':
                //return view('admin.users.home',compact('user','fichasasignadas'));
                return view('instructor.acumuladoxficha',compact('user','fichasasignadas','totalhorasmes','reporte','start','end'));
                break;
            case 'auditor':
                //return view('admin.users.home',compact('user','fichasasignadas'));
                return view('instructor.acumuladoxficha',compact('user','fichasasignadas','totalhorasmes','reporte','start','end'));
                break;
            case 'user':
                return view('user.home',compact('user','actividades'));
            case 'instructor':
                return view('instructor.acumuladoxficha',compact('user','fichasasignadas','totalhorasmes','reporte','start','end'));
            default:
                return view('auth.login');


        }
    }

    public function acumuladoxfichaexcel($userId = null)
    {

        $userId = $this->request->get('userId');

        if(empty($userId))
            $user = \Auth::user();
        else
            $user = User::find($userId);


        $start =  $this->request->get('start');
        $end = $this->request->get('end');
        if(!empty($start) && !empty($end))
        {
            /*            $actividades = Evento::actividadesxmes($user->id,[$start,$end]);
                        $actividadestotal = Evento::actividadesxmestotal($user->id,[$start,$end]);*/
            $horasUser = $this->eventoRepository->HorasAcumuladas($user,[$start,$end]);

            $fichasasignadas = $this->eventoRepository->acumuladoxficha($user,[$start,$end]);

        }
        else {
            /*            $actividades = Evento::actividadesxmes($user->id);
                        $actividadestotal = Evento::actividadesxmestotal($user->id);*/
            $horasUser = $this->eventoRepository->HorasAcumuladas($user);
            $fichasasignadas = $this->eventoRepository->acumuladoxficha($user);
        }

        //$horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;
        //$totalhorasmes = $horasUser->first()->horas;
        $reporte = false;

        Excel::create('reporte acumulado x ficha', function($excel) use($fichasasignadas,$horasUser,$totalhorasmes){

            $excel->sheet('reporte', function($sheet) use($fichasasignadas,$horasUser,$totalhorasmes){

                $sheet->loadView('instructor.partials.table',['fichasasignadas'=>$fichasasignadas,
                    'horasUser'=>$horasUser,'totalhorasmes'=>$totalhorasmes,'reporte'=>true]);

            });

        })->export('xls');
    }



    public function addbitacora($user, $action, $data)
    {
        $bitacora = new bitacora();

        //dd($data);

        $usuario = User::select('full_name')
                    ->where('id','=',$user)
                    ->get()->toArray();
        $ficha = Ficha::select('full_name')
            ->where('id','=',$data->ficha_id)
        ->get()->toArray();

        //dd($ficha[0]['full_name']);

        $datos = 'Usuario: '.$usuario[0]['full_name'].
                 '<br> Ficha: '.$ficha[0]['full_name'].
                 '<br> inicio: '.$data->start.
                 '<br> final: '.$data->end.
                 '<br> horas: '.$data->horas.
                 '<br> todo_dia: '.$data->all_day;

        //dd($datos);

        $bitacora->user_id = $user;
        $bitacora->action = $action;
        $bitacora->evento_id = $data->id;
        $bitacora->olddata = $datos;

        $bitacora->save();

        //dd($bitacora);
    }

    public function resumen()
    {

    }

}
