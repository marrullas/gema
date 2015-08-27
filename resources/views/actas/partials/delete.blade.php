{!! Form::open(['route'=> ['actas.destroy',$acta], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar ACTA</button>
{!! Form::close() !!}