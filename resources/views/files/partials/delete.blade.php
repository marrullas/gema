{!! Form::open(['route'=> ['admin.actividades.destroy',$actividad], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar actividad</button>
{!! Form::close() !!}