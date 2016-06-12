<?php
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 4:03 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\ciudad;
use App\Http\Requests\EditIeRequest;
use App\Http\Requests\EditUserRequest;
use App\Evento;
use App\Ficha;
use App\Ie;
use App\Muro;
use App\Tipoactividad;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{


    protected $request;


    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }


    /**
     *
     */
    public function getOrm()
    {
        $result = User::paginate();

        return view('admin.users.index', compact($result));
        //dd($result);
    }


    public function index()
    {
        //dd('vine!!!');
        $name =  $this->request->get('name');
        $type = $this->request->get('type');
        $page = $this->request->get('page');
        $users = User::FiltroPaginación($name,$type);

        return view('users.index', compact('users','name','type','page'));

    }


    public function Calendar($user_id = null)
    {

        $user_id = $this->request->user()->id;
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


    public function edit($id)
    {
        $user = User::findOrfail($id);

        if(Auth::user()->id != $id && !Auth::user()->isAdminOrlider())
        {
            Session::flash('message','Error, prohibido acceso a otros perfiles');
            return Redirect::back();
        }

        $ciudades = Ciudad::lists('full_name','codigo');

        return view('users.edit',compact('user','ciudades'));
    }

    public function update(EditUserRequest $request,$id)
    {
        $user = User::findOrfail($id);
        $user->full_name =  "$user->first_name $user->last_name";
        $user->fill($request->all());
        $user->save();
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
        //
        $user = User::findOrfail($id);
        $fichas = $user->fichas()->get();

        return view('users.show',compact('user','fichas'));
    }
    
    public function actualizaries()
    {
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $ies = Ie::filtroPaginaciónidpropias($nombre);
        return view('users.ies.index',compact('nombre','page','ies'));
    }
    public function editie($id)
    {
        //
        $ciudades = Ciudad::lists('full_name','codigo');
        $ie = Ie::findOrFail($id);
        return view('users.ies.edit',compact('ie','ciudades'));
    }
    public function updateie($id)
    {


        $data = $this->request->all();
        //dd($data);
        $ie = Ie::findOrfail($id);
        $ie->fill($data);
        $ie->save();
        Session::flash('message','IE Actualizada correctamente!!!');
        return redirect()->back();

    }

    public function isadmin()
    {
        //dd(Auth::user());
        if(Auth::user()->type === 'admin' || Auth::user()->type === 'lider')
            return 1;
        else
            return 0;
    }

}