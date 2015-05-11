<?php
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 4:03 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\EditUserRequest;
use App\Evento;
use App\Ficha;
use App\Muro;
use App\Tipoactividad;
use App\User;
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


    public function getIndex(){

    	dd('cambio');

        $result = User::paginate();

        return view('admin.users.index', compact($result));

        /* Ejemplo
        $result = \DB::table('users')
            ->select('users.first_name','users.last_name')
            ->where('first_name','Mauricio')
            ->get();

        dd($result);


        return $result;
        */

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
        $ciudades = Ciudad::lists('full_name','codigo');

        return view('user.edit',compact('user','ciudades'));
    }

    public function update(EditUserRequest $request,$id)
    {
        $user = User::findOrfail($id);

        $user->fill($request->all());
        $user->save();

        return redirect()->back();
    }



}