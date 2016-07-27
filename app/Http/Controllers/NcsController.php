<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\Caracterizarncs;
use App\Ncs;
use App\Seguimientoncs;
use App\Tiposnc;
use App\User;
use App\Usuariosxciclo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class NcsController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        //dd($data);
        $nc = new Ncs();
        $nc->fill($data);
        $nc->estadoncs_id = 1;
        $nc->auditor = Auth::user()->id;
        $nc->certificador = Auth::user()->id;
        $nc->save();
        $seguimientonc = new Seguimientoncs();
        $text = "<em>Auditor abre nc</em><br>";
        $seguimientonc->ncs_id = $nc->id;
        $seguimientonc->user_id = Auth::user()->id;
        $seguimientonc->detalle = $text;
        $seguimientonc->save();
        if(Auth::user()->isAdmin() || Auth::user()->isAuditor())
        return redirect()->route('admin.auditoria.edit',[$this->request->all()['auditoria_id']]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //dd(URL::previous());
        $nc = Ncs::findOrfail($id);
        //dd($nc);
        $caracterizarnc = Caracterizarncs::lists('nombre','id');
        $tiposnc = Tiposnc::lists('hallazgo','id');
        $usuarios = User::lists('full_name','id');
        $auditoria = Auditoria::findOrFail($nc->auditoria_id);
        return view('admin.ciclos.auditoria.partials.editarnc',compact('nc','nombre','caracterizarnc','tiposnc',
            'usuarios','auditoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->all());
        $detalles = $request->get('detalles');
        $ncs = Ncs::findOrfail($id);
        $ncs->fill($request->all());
        //dd($detalles);
        $text = "<em>Usuario " . Auth::user()->full_name . " Actualizo la NC</em><br>";
        $estadoncsId = 1;
        if ($request->get('estadoncs_id')==1) {
            $text = "<em>Usuario " . Auth::user()->full_name . " Reabre el hallazgo para su adecuado tramite</em><br>";
        }
        if ($request->get('estadoncs_id')==2) {
            $text = "<em>Usuario " . Auth::user()->full_name . " devuelve para ser revisada</em><br>";
            $estadoncsId = 2;
        }
        if ($request->get('estadoncs_id')==3) {
            $text = "<em>Usuario Auditor Cierra</em><br>";
            $ncs->certificador = Auth::user()->id; //el que cierra la nc
            $estadoncsId = 3;
        }
        $ncs->save();

        if (!empty($detalles))
            $text = $text.$detalles;

        $seguimientonc = new Seguimientoncs();
        $seguimientonc->ncs_id = $ncs->id;
        $seguimientonc->user_id = Auth::user()->id;
        $seguimientonc->detalle = $text;
        $seguimientonc->estadoncs_id = $estadoncsId;
        $seguimientonc->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ncs = Ncs::findOrfail($id);
        $ncs->delete();
        $message = trans('validation.attributes.userdelete').' : '.$ncs->id;
        if($this->request->ajax()){

            return response()->json([
                'id'=>$ncs->id,
                'message'=>$message
            ]);
        }
        //Eliminar las actividades de la tabla auditoria que estan relacionadas con
        //este ciclo.
        //User::destroy($id); eliminar directamente
        //Session::flash('message',$message);
        return redirect()->route('admin.auditoria.edit', $ncs->auditoria_id);
    }

    public function guardarnc(){
        //dd($this->request->all());
        $nc = new Ncs();
        $nc->fill($this->request->all());
        $nc->auditor = Auth::user()->id;
        $nc->certificador = Auth::user()->id;
        $nc->save();

        return redirect()->route('admin.auditoria.edit',[$this->request->all()['auditoria_id']]);
    }

    public function devolvernc(){
        //dd($this->request->all());
        $nc = new Ncs();
        $nc->fill($this->request->all());
        $nc->auditor = Auth::user()->id;
        $nc->certificador = Auth::user()->id;
        $nc->save();

        return redirect()->route('admin.auditoria.edit',[$this->request->all()['auditoria_id']]);
    }

    public function devolverncsajax()
    {
        $ncspendientes = Ncs::where('user_id',Auth::user()->id)
            ->where('estadoncs_id','<>', 3)->get();
        $ncsdevueltas = Ncs::where('estadoncs_id','2')
        ->where('auditor',Auth::user()->id)->get()
        ;
        //dd($ncspendientes);

        return response()->json(['success' => true,'ncspendientes'=>$ncspendientes,'ncsdevueltas'=>$ncsdevueltas]);
    }

    public function exportarncs($id = null, $ver = false)
    {

        /*MEJORA PARA REALIZAR: QUE SOLO DEVUELVA LAS NCS DE CICLOS ACTIVOS*/
        $idauditoria = [];
        if(empty($id))
            abort(403, 'Unauthorized action.');


        $usuariosxciclo = Usuariosxciclo::usuariosxcicloactivoid($id);
        //dd($usuariosxciclo);
        $auditoria = Auditoria::select('id')->where('usuariosxciclo_id', '=', $usuariosxciclo->id)->get();
        foreach ($auditoria as $idauditoria) {
             $idsauditoria[] = $idauditoria->id;
        }
        //SOLO LOS ADMIN O AUDITORES PUEDEN EXPORTAR NCS DE OTROS USUARIOS
        if(Auth::user()->isAdmin() || Auth::user()->isAuditor()) {
            $ncs = Ncs::whereIn('auditoria_id', $idsauditoria)
                //->where('user_id', '=', Auth::user()->id)
                ->get();
        }else
        {
            $ncs = Ncs::whereIn('auditoria_id', $idsauditoria)
                ->where('user_id', '=', Auth::user()->id)
                ->get();
        }
        if($ver)
            return view('auditoria.partials.tablencsxauditoria',compact('ncs'));

        Excel::create('reporte hallazgos', function($excel) use($ncs){

            $excel->sheet('ncs', function($sheet) use($ncs){

                $sheet->loadView('auditoria.partials.tablencsxauditoria',['ncs'=>$ncs]);

            });

        })->export('xls');

    }
    public function exportartodasncs($ver = null)
    {

        /*MEJORA PARA REALIZAR: QUE SOLO DEVUELVA LAS NCS DE CICLOS ACTIVOS Y QUE NO PERMITA DESCARGAR NCS DE OTROS USER*/
        if(!Auth::user()->isAdmin())
            abort(403, 'Unauthorized action.');

        $ncs = Ncs::all();

        if($ver)
        return view('auditoria.partials.tablencsxauditoria',compact('ncs'));

        Excel::create('reporte hallazgos', function($excel) use($ncs){

            $excel->sheet('ncs', function($sheet) use($ncs){

                $sheet->loadView('auditoria.partials.tablencsxauditoria',['ncs'=>$ncs]);

            });

        })->export('xls');

    }

    public function listarncsxauditor(){
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $usuario = $this->request->get('usuario');
        $IdUser = Auth::user()->id;
        $usuariosnc = [''=>''] + Ncs::usuariosncdeauditor($IdUser);
        //dd($usuariosnc);
        $ncs = Ncs::ncsxusuarioxauditor($IdUser,$usuario,$page);
        return view('auditoria.listarncs',compact('ncs','nombre','usuariosnc','usuario','page'));
    }

    public function listarncsxauditores($auditor = null){
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $usuario = $this->request->get('usuario');
        $usuariosnc = [''=>''] + Ncs::usuariosncdeauditor($auditor);
        if(!empty($auditor))
            $ncs = Ncs::where('auditor',$auditor)->paginate();
        else
            $ncs = Ncs::paginate();
        return view('auditoria.listarncs',compact('ncs','nombre','usuario','page','usuariosnc'));
    }
}
