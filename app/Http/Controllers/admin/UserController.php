<?php namespace App\Http\Controllers\admin;

use App\ciudad;
use App\Evento;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mensaje;
use App\Muro;
use App\Tipoactividad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use MaddHatter\LaravelFullcalendar\Event as Event;
//use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use \Illuminate\Support\Facades;
use Illuminate\Support\Facades\Request;
//use Illuminate\Support\Facades\Validator;
use App\User;
use App\Ficha;
use Illuminate\Support\Facades\Session;


class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
     *
     *
	 */

    protected $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');

        //dd(\Auth::user()->type);

       /* if(Auth::check() && Auth::user()->type != 'admin') {
            Session::flash('message','Accion no permitida, o no tiene privilegios para realizarla');
            abort(403, 'Unauthorized action.');
        }*/

        $this->request = $request;
    }


    public function index()
	{


        $name =  $this->request->get('name');
        $type = $this->request->get('type');
        $page = $this->request->get('page');
        $users = User::FiltroPaginación($name,$type);

        return view('admin.users.index', compact('users','name','type','page'));

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $user = Auth::user();
        $ciudades = Ciudad::lists('full_name','codigo');

        return view ('admin.users.create',compact('user','ciudades'));
	}

    /**
     * Store a newly created resource in storage.     *
     * @param Request $request
     * @return Response
     *validacion tradicional
     $rules = array(
    'first_name'=>'required',
    'last_name'=>'required',
    'telefono1'=>'required',
    'telefono2'=>'required',
    'email'=>'required',
    'password'=>'required',
    'type'=>'required'
    );
    $v  = Validator::make($data, $rules);

    if($v->fails())
    {
    return redirect()->back()
    ->withErrors($v->errors())
    ->withInput($this->request->except('password'));
    }
     *Metodo validacion nuevo 1
     *
     * $rules = array(
    'first_name'=>'required',
    'last_name'=>'required',
    'telefono1'=>'required',
    'telefono2'=>'required',
    'email'=>'required',
    'password'=>'required',
    'type'=>'required'
    );
    $this->validate($this->request,$rules);
     */
	public function store(CreateUserRequest $request)
	{
		//
        //dd($request->all());
        $data = $request->all();


        $user = new User($data);
        $user->full_name =  "$user->first_name $user->last_name";
        $user->save();
        return redirect()->route('admin.users.index');
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
        $user = User::findOrfail($id);
        $fichas = $user->fichas()->get();

        return view('admin.users.show',compact('user','fichas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrfail($id);
        $ciudades = Ciudad::lists('full_name','codigo');

        return view('admin.users.edit',compact('user','ciudades'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditUserRequest $request,$id)
	{
        //dd($request->all());
        $user = User::findOrfail($id);
        $user->full_name =  "$user->first_name $user->last_name";
        $user->fill(Request::all());
        $user->save();

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
        $user = User::findOrfail($id);
        $user->delete();
        $message = trans('validation.attributes.userdelete').' : '.$user->fullname;
        if($this->request->ajax()){

            return response()->json([
                'id'=>$user->id,
                'message'=>$message
            ]);
        }

        //User::destroy($id); eliminar directamente
        Session::flash('message',$message);
		return redirect()->route('admin.users.index');
	}

    public function misevento($id)
    {
        $evento = Evento::findOrfail($id);
        $fichas = Ficha::lists('codigo','id');
        return view('calendar.edit',compact('evento','fichas'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function calendar($user_id = null )
    {


        if(empty($user_id))
        {
            Session::flash('message','Debe selecionar algun usuario');
            return redirect()->route('admin.users.index');

        }else {

            try{

                $nombreuser = User::findOrfail($user_id)->full_name;

            }
            catch(ModelNotFoundException $e){
                Session::flash('message',$e->getMessage());
                return redirect()->route('admin.users.index');

            }



        }



        //$fichas = Ficha::lists('full_name','id');
        $fichas = Ficha::where('user_id',$user_id)->where('estado','activa')->lists('full_name','id');
        $calendar = Evento::getCalendar($this->request->user(),$user_id);
        $tipoactividades = Tipoactividad::all()->lists('nombre','id');
        $calId = $calendar->getId();


        return view('calendar.index', compact('calendar', 'calId','user_id','fichas','nombreuser','tipoactividades'));
    }


    public function muro()
    {
        $entradasMuro = Muro::getEntradas();
        $anunciosMuro = Muro::getAnuncios();

        return view('admin.users.muro',compact('entradasMuro','anunciosMuro'));
    }

    /**
     *funcion que se encarga de almacenar un mensaje la tabla de anuncios
     */
    public function resumen($descargar = null){

        //dd('al menos vine');
        //dd($this->request->get('periodo'));

        //dd($descargar);

        $sinprogramacion = $this->request->get('sinprogramacion');
        $periodo = $this->request->get('periodo');
        $name =  $this->request->get('name');
        $type = $this->request->get('type');
        $page = $this->request->get('page');
        $users = User::FiltroResumen($name,$type,$periodo,$sinprogramacion);
        $reporte = false;



        if(!empty($descargar)) {
            if ($descargar == 'excel') {
                $userExcel = User::resumen($name,$type,$periodo,$sinprogramacion);
                //dd($userExcel);
                Excel::create('Informe resumen', function ($excel) use($userExcel){

                    $excel->sheet('resumen', function ($sheet) use($userExcel){


                        //$datos = $userExcel;

                        //$sheet->fromArray($datos);
                        $sheet->loadView('admin.users.partials.resumentable',['users'=>$userExcel,'reporte'=>true]);

                    });
                })->export('xls');
            }
        }


        return view('admin.users.resumen', compact('users','name','type','page','periodo','sinprogramacion','reporte'));


    }

    public function detalleresumen($user=null)
    {

    }


}
