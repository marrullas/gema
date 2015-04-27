<?php namespace App\Http\Controllers\Admin;

use App\Evento;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
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
        //$this->middleware('auth');

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
        return view ('admin.users.create');
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

        return view('admin.users.edit',compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditUserRequest $request,$id)
	{
        $user = User::findOrfail($id);

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

                $nombreuser = User::findOrfail($user_id)->fullname;
            }
            catch(ModelNotFoundException $e){
                Session::flash('message',$e->getMessage());
                return redirect()->route('admin.users.index');

            }



        }

        $fichas = Ficha::lists('full_name','id');
        $calendar = Evento::getCalendar($this->request->user(),$user_id);
        $calId = $calendar->getId();

        return view('calendar', compact('calendar', 'calId','user_id','fichas','nombreuser'));
    }



}
