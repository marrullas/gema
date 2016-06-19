{!! Form::open(['route'=> ['admin.usuariosxciclo.destroy',$usuariosxciclo], 'method' => 'DELETE' ]) !!}
<button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</button>

{!! Form::close() !!}