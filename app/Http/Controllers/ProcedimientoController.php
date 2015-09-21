<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Procedimiento;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProcedimientoController extends Controller
{
    protected $request;
    protected $userID;

    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth');
        $this->request = $request;
        if(Auth::user())
            $this->userID = Auth::user()->id;
        else
            redirect('/');

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $procedimientos = Procedimiento::filtroPaginación($nombre);

        return view('admin.procedimientos.index',compact('nombre','page','procedimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $procedimiento = (object) ['vigencia' => \Carbon\Carbon::now()];
        //dd($procedimiento);
        return view('admin.procedimientos.create',compact('procedimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\CreateProcedimientoRequest $request)
    {
        //
        $userID = Auth::user()->id;
        $data = $request->all();

        //dd($data);
        $procedimiento  = new Procedimiento($data);
        $procedimiento->user_id = $userID;
        $procedimiento->save();
        return redirect()->route('admin.procedimientos.index');
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

        dd('test');
        $procedimiento = Procedimiento::with('user')
            ->where('id','=',$id)
            ->where('user_id','=',Auth::user()->id)
            ->first();
        $actividades = Actividad::where('procedimiento_id','=',$procedimiento->id)
            ->orderBy('orden')
            ->get();
        $totalactividades = $actividades->count();
        return view('admin.procedimientos.show',compact('procedimiento','actividades','totalactividades'));
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
        $procedimiento = Procedimiento::findOrfail($id);

        return view('admin.procedimientos.edit',compact('procedimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\EditProcedimientoRequest $request, $id)
    {
        $procedimiento = Procedimiento::findOrfail($id);
        $procedimiento->fill($request->all());
        $procedimiento->save();

        return redirect()->action('admin\ProcedimientoController@show',compact('id'));
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
        $procedimiento = Procedimiento::findOrfail($id);
        $procedimiento->delete();
        $message = trans('validation.attributes.userdelete').' : '.$procedimiento->nombre;
        if($this->request->ajax()){

            return response()->json([
                'id'=>$procedimiento->id,
                'message'=>$message
            ]);
        }

        //User::destroy($id); eliminar directamente
        Session::flash('message',$message);
        return redirect()->route('admin.procedimientos.index');
    }
    public function lista()
    {
        //$userID =  Auth::user()->id;

        $listaprocedimientos =  DB::table('procedimientos')
            ->get();

        return $listaprocedimientos;
    }
}
