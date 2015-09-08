<?php

namespace App\Http\Controllers\admin;

use App\Actividad;
use App\Procedimiento;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ActividadController extends Controller
{

    protected $request;


    /**
     * @param Request $request
     */
    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.

        $this->request = $request;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $actividades = Actividad::filtroPaginación($nombre);
        $totalactividades = $actividades->total();

        return view('admin.actividades.index',compact('nombre','page','actividades','totalactividades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

        $procedimientoid = $this->request->get('procedimiento');
        $procedimiento = Procedimiento::findOrfail($procedimientoid);
        $actividades = Actividad::from(DB::raw("(select * from actividades where procedimiento_id = '$procedimientoid' order by orden desc limit 3) as T"))
            ->orderBy('orden','asc')
            ->take(3)
            ->get();


        //dd($actividades->count());
        /**
         * esta variable sirve para cambiar el color del boton de referencia en la edicion
         * para la creacion no se requiere pero se envia para evitar el error de que no existe variable
         * en la vista de campos de la actividad
         */
        $actividad = new Actividad();
        $obligatorio = $this->request->get('obligatorio');
        $condicional = $this->request->get('condicional');
        $aprobo = $this->request->get('aprobo');
        $procedimientos = Procedimiento::lists('nombre','id');


        //dd($actividad);
        return view('admin.actividades.create',compact('obligatorio','condicional','aprobo','procedimientos','procedimiento','actividades','actividad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\CreateActividadRequest $request)
    {
        //

        $data = $request->all();
        $actividadSiguiente = $this->request->get('actividad_siguiente');
        $actividad  = new Actividad($data);
        if(empty($actividadSiguiente))//validamos si llega el numero de la sigueinte actividad y si no la asignamos
            $actividad->actividad_siguiente = $this->request->get('orden')+1;

        $actividad->save();
        //return redirect()->route('admin.actividades.index');
        return redirect()->route('admin.procedimientos.show',$actividad->procedimiento_id);
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
        $actividad = Actividad::with('procedimiento')
            ->where('id','=',$id)
            //->where('user_id','=',Auth::user()->id)
            ->first();
        return view('admin.actividades.show',compact('actividad'));
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

        $actividad = Actividad::findOrfail($id);
        $procedimientoid = $actividad->procedimiento_id;
        $procedimiento = Procedimiento::findOrfail($procedimientoid);
        $actividades = Actividad::from(DB::raw("(select * from actividades where procedimiento_id = '$procedimientoid' order by id desc limit 3) as T"))
            //->whereIn('orden',[$actividad->orden - 1, $actividad->orden, $actividad->orden + 1])
            ->orderBy('id','asc')
            ->take(3)
            ->get();
        $actividades = Actividad::where('procedimiento_id','=',$procedimientoid)
            ->whereIn('orden',[$actividad->orden - 1, $actividad->orden, $actividad->orden + 1])
            ->orderBy('orden','asc')
            ->take(3)
            ->get();


        //dd($actividades);

        $obligatorio = $this->request->get('obligatorio');
        $condicional = $this->request->get('condicional');
        $aprobo = $this->request->get('aprobo');
        $procedimientos = Procedimiento::lists('nombre','id');



        return view('admin.actividades.edit',compact('obligatorio','condicional','aprobo','procedimientos','procedimiento','actividades','actividad'));




        //return view('admin.actividades.edit',compact('actividad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\EditActividadRequest $request, $id)
    {
        //
        $actividad = Actividad::findOrfail($id);
        $actividad->fill($request->all());
        $actividad->save();
        $procedimientoId = $actividad->procedimiento_id;

        //return redirect()->action('admin\ActividadController@show',compact('id'));
        return redirect()->action('admin\ProcedimientoController@show',compact('procedimientoId'));
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
        $actividad = Actividad::findOrfail($id);
        $actividad->delete();
        $message = trans('validation.attributes.userdelete').' : '.$actividad->nombre;
        if($this->request->ajax()){

            return response()->json([
                'id'=>$actividad->id,
                'message'=>$message
            ]);
        }

        //User::destroy($id); eliminar directamente
        Session::flash('message',$message);
        return redirect()->route('admin.procedimientos.show',$actividad->procedimiento_id);
    }
}
