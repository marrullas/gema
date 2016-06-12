<?php

namespace App\Http\Controllers;

use App\Funcionariosie;
use App\Ie;
use App\Tipofuncionario;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FuncionarioController extends Controller
{

    protected $request;

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
    public function index($id)
    {
        //
        $ie = Ie::find($id);
        $nombre = $this->request->get('nombre');
        $funcionariosie = $ie->funcionarios()->where('ie_id',$id)->get();
        //d($funcionariosie->count()==0);//?$funcionariosie->total():$funcionariosie->count());
        $tipofuncionario = Tipofuncionario::lists('nombre','id');
        return view('funcionarios.index',compact('ie','tipofuncionario','nombre','funcionariosie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //$usuarios = User::lists('full_name','id');
        $ie = Ie::find($id);
        $funcionariosie = $ie->funcionarios()->where('ie_id',$id)->get();

        $tipofuncionario = Tipofuncionario::lists('nombre','id');
        return view('funcionarios.create',compact('ie','tipofuncionario','funcionariosie'));
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
        //dd($data['ie_id']);
        //$nombreIe = Ie::find($data['ie_id'])->nombre;

        $funcionario = new Funcionariosie($data);
        //$funcionario->full_name = $data['codigo'] . ' - ' . $nombreIe;
        $funcionario->save();
        return redirect('funcionarios/'.$data['ie_id']);
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
        //
        $funcionario = Funcionariosie::with('tipofuncionario')
                    ->findOrfail($id);
        //dd($funcionario);
        //fichas = $user->fichas()->get();

        return view('funcionarios.show',compact('funcionario'));
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
        //$usuarios = User::lists('full_name','id');
        $funcionario = Funcionariosie::findOrfail($id);
        $ie = Ie::find($funcionario->ie_id);
        //$funcionariosie = $ie->funcionarios()->where('ie_id',$id)->get();

        $tipofuncionario = Tipofuncionario::lists('nombre','id');
        return view('funcionarios.edit',compact('ie','tipofuncionario','funcionario'));
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

        $funcionario = Funcionariosie::findOrfail($id);
        //dd($funcionario);
        $funcionario->fill($request->all());
        //$ie = Ie::find($ficha->ie_id);
        //$funcionario->full_name = $ficha->codigo . ' - ' . $ie->nombre;
        $funcionario->save();
        return redirect('funcionarios/'.$request->get('ie_id'));
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
    }
}
