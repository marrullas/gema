{{--<div class="form-group">
    {!! Form::label('procedimiento_id', 'Procedimiento') !!}
    {!! Form::select('procedimientos[]', $procedimientos, $procedimiento, [ 'class' => 'form-control selectpicker', 'multiple','data-live-search="true"'] ) !!}
</div>--}}
<div class="form-group">
    {!! Form::label('procedimiento_id', 'Procedimiento') !!}
    {!! Form::label('procedimiento_id', $procedimiento->nombre,['class'=>'text-info']) !!}
    {!! Form::hidden('procedimiento_id', $procedimiento->id) !!}
</div>
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('responsable', 'Responsable') !!}
    {!! Form::textarea('responsable', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    @if($actividades->count() > 0)
    <div class="stepwizard">
        <div class="stepwizard-row">
            @foreach($actividades as $act)

                @if($act->orden == $actividad->orden)
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-info btn-circle">{{$act->orden}}</button>
                        <p>{{$act->nombre}}</p>
                    </div>
                @else
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle">{{$act->orden}}</button>
                        <p>{{$act->nombre}}</p>
                    </div>

                @endif
            @endforeach

        </div>
    </div>
    @endif

    {!! Form::label('orden', 'Orden') !!}
    {!! Form::text('orden', null, [ 'placeholder' => 'Digite el orden' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('actividad_siguiente', 'Actividad Siguiente') !!}
    {!! Form::text('actividad_siguiente', null, ['placeholder' => 'Digite numero de la actividad que continua en caso de aprobar' ] ) !!}
</div>



<div class="form-group">
    {!! Form::label('obligatorio', 'Obligatorio') !!}
    {!! Form::checkbox('obligatorio', null,$obligatorio) !!}

{{--
    {!! Form::label('condicional', 'Condicional') !!}
    {!! Form::checkbox('condicional', null,$condicional) !!}

    {!! Form::label('aprobo', 'Aprobo') !!}
    {!! Form::checkbox('aprobo', null,$aprobo) !!}
--}}



</div>



        <div class="form-group">
            {!! Form::label('evidencia', 'Requiere evidencia') !!}
            {!! Form::checkbox('evidencia', 1, $actividad->evidencia) !!}

    {!! Form::label('digital', 'Evidencia digital') !!}
    {!! Form::checkbox('digital', 1, $actividad->digital) !!}

    {!! Form::label('fisica', 'Evidencia fisica') !!}
    {!! Form::checkbox('fisica', 1, $actividad->fisica) !!}


{{--    {!! Form::label('periodico', 'Actividad periodica') !!}
    {!! Form::checkbox('periodica', null, $actividad->periodica) !!}--}}

</div>


@section('scripts')
    {!! HTML::script('/bower_resources/bootstrap-select/js/bootstrap-select.js') !!}
    {!! HTML::script('/bower_resources/bootstrap-select/js/i18n/defaults-es_CL.js') !!}
    {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}
@endsection