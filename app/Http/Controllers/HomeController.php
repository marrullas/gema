<?php namespace App\Http\Controllers;

use App\Evento;
use App\Ficha;
use App\Muro;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $entradasMuro = Muro::getEntradas();
        $anunciosMuro = Muro::getAnuncios();
        $user = \Auth::user();
/*        $fichasasignadas = Ficha::with('ie','ie.ciudad','programa','eventos')
                            //->join('eventos','fichas.id','=','eventos.ficha_id')
                            //->sum('horas')
                            //    ->leftjoin(DB::raw('(select sum(horas) as horas from eventos GROUP BY ficha_id) as v'),',v.ficha_id', '=','fichas.id')
                            //->where('eventos.user_id',$user->id)
                            ->where('eventos.user_id',$user->id)
                            ->groupBy('ficha_id')
                            ->get();*/
        $fichasasignadas = Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            //->join('fichas','fichas.id','=','eventos.ficha_id')
            ->where('eventos.user_id',$user->id)
            ->where('eventos.start', '>=', Carbon::now()->startOfMonth())
            ->groupBy('ficha_id')
            ->orderBy('eventos.start','')
            ->get();




        $horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = $horasUser->first()->horas;

        //dd($fichasasignadas->first()->horas_fichames()->horas);

        //dd($fichasasignadas->all());
        //$fichasasignadas = Ficha::where('user_id',$user->id)->get();

        //$fichasasignadas = $data->all();
            //$user->FichasAsignadas();

        //dd($fichasasignadas->first()->ie()->first()->ciudad()->first()->nombre);

        switch($user->type)
        {
            case 'admin':
                return view('admin.users.home',compact('entradasMuro','anunciosMuro','user','fichasasignadas'));
            break;
            case 'user':
                return view('user.home',compact('entradasMuro','anunciosMuro','user','fichasasignadas'));
            case 'instructor':
                return view('instructor.home',compact('entradasMuro','anunciosMuro','user','fichasasignadas','totalhorasmes'));
            default:
                 return view('auth.login');


        }


	}
    public function vereventos()
    {
        $user = \Auth::user();
        $fichasasignadas = Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            //->join('fichas','fichas.id','=','eventos.ficha_id')
            ->where('eventos.user_id',$user->id)
            ->where('eventos.start', '>=', Carbon::now()->startOfMonth())
            //->groupBy('ficha_id')
            ->orderBy('eventos.start','')
            ->get();




        $horasUser = User::find($user->id)->horas_acumuladas;

        $totalhorasmes = $horasUser->first()->horas;

        switch($user->type)
        {
            case 'admin':
                return view('admin.users.home',compact('user','fichasasignadas'));
                break;
            case 'user':
                return view('user.home',compact('user','fichasasignadas'));
            case 'instructor':
                return view('instructor.eventos',compact('user','fichasasignadas','totalhorasmes'));
            default:
                return view('auth.login');


        }
    }

}
