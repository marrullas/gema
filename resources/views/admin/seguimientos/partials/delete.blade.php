{!! Form::open(['route'=> ['admin.seguimientos.destroy',$seguimiento], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar Seguimiento</button>
{!! Form::close() !!}