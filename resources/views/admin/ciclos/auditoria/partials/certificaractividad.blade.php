{{--
{!! Form::open(['url'=> ['admin/auditoria/certificaractividad',$auditoria], 'method' => 'PUSH' ]) !!}
<div class="btn-group">
<button type="submit" onclick="return confirm('Esta seguro que quiere certificar esta actividad?')" class="btn btn-success btn-sm"><i class="fa fa-trash-o"></i> Certificar</button>
</div>

{!! Form::close() !!}
--}}
@if($auditoria->certificado == false)
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Certificar</button>
@elseif($auditoria->certificado == true && Auth::user()->isAdmin())
    {!! Form::open(['url'=> ['admin/auditoria/quitarcertificacion',$auditoria], 'method' => 'PUSH' ]) !!}
        <button type="submit" onclick="return confirm('Esta seguro que quiere quitar certifiación?')" class="btn btn-danger btn-sm">Quitar certificación</button>
    {!! Form::close() !!}
@endif
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificar actividad</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['url'=> ['admin/auditoria/certificaractividad',$auditoria], 'method' => 'POST','files' => true ] ) !!}
{{--                    <div class="form-group">
                        {!! Form::label('Evidencia') !!}
                        {!! Form::file('file', null) !!}
                        {!! Form::hidden('codigo', $codigo) !!}
                        {!! Form::hidden('prefijo', $prefijo) !!}
                    </div>--}}
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Nota certificación') !!}
                        {!! Form::textarea('detalles', null,['class'=>'form-control textarea'])!!}
                    </div>

{{--
                <div class="btn-group">

                </div>
--}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" onclick="return confirm('Esta seguro que quiere certificar esta actividad?')" class="btn btn-success btn-sm"><i class="fa fa-trash-o"></i> Certificar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> <!-- Fin moda -->