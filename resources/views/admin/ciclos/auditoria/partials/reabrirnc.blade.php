
<!-- Modal -->
<div class="modal fade" id="myModalreabrirnc{{$nc->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reabrir hallazgo: <b>{!! $nc->descripcion !!}</b></h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=> ['ncs.update',$nc], 'method' => 'PUT','files' => true,'data-parsley-validate' ] ) !!}
{{--                    <div class="form-group">
                        {!! Form::label('Evidencia') !!}
                        {!! Form::file('file', null) !!}
                        {!! Form::hidden('codigo', $codigo) !!}
                        {!! Form::hidden('prefijo', $prefijo) !!}
                    </div>--}}
                    <div class="form-group">
                        {!! Form::hidden('estadoncs_id', 1) !!}
                        {!! Form::label('devolucion', 'Nota para reabrir') !!}
                        {!! Form::textarea('detalles', null,['class'=>'form-control textarea','required'=>'" "','name'=>'detalles'])!!}
                    </div>

{{--
                <div class="btn-group">

                </div>
--}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" onclick="return confirm('Esta seguro que quiere reabrir este hallazgo?')" class="btn btn-success btn-sm"><i class="fa fa-trash-o"></i> Reabrir Hallazgo</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> <!-- Fin moda -->