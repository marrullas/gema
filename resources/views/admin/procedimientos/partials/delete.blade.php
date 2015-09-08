{!! Form::open(['route'=> ['admin.procedimientos.destroy',$procedimiento], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar procedimiento</button>
{!! Form::close() !!}