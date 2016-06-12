{!! Form::open(['route'=> ['admin.programas.destroy',$funcionario], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este usuario?')" class="btn btn-danger">Eliminar Funcionario</button>
{!! Form::close() !!}