<?php namespace App\Http\Controllers;

use App\Evento;

use App\Muro;
use App\Repositories\EventoRepository;
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
     * @var EventosRepositories
     */
    private $eventosRepository;

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(EventoRepository $eventosRepository )
	{
		$this->middleware('auth');
        $this->eventosRepository = $eventosRepository;
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
        $fichasasignadas = $this->eventosRepository->acumuladoxficha($user);
        $horasUser = $this->eventosRepository->HorasAcumuladas($user);
        $totalhorasmes = ($horasUser->first()) ? $horasUser->first()->horas : 0;

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
        $fichasasignadas = $this->eventosRepository->vereventos($user);
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
