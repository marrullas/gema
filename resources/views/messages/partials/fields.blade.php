@if(!$respuesta)
<div class="form-group">
    {!! Form::label('destinatarios', 'Destinatarios') !!}
    {!! Form::select('destinatarios[]', $usuarios, null, [ 'class' => 'form-control selectpicker', 'multiple','data-live-search="true"'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('titulo', 'Titulo') !!}
    {!! Form::text('titulo', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el titulo' ] ) !!}
</div>

<div class="form-group">
       {!! Form::label('contenido', 'Mensaje',['class' => 'control-label col-md-4' ]) !!}
       {!! Form::textarea('contenido', null, ['class' => 'form-control col-md-4' ]) !!}
</div>
@else
    <div class="form-group">
           {!! Form::label('contenido', 'Responder',['class' => 'control-label col-md-4' ]) !!}
           {!! Form::textarea('contenido', null, ['class' => 'form-control col-md-4' ]) !!}
    </div>
@endif


@if(Auth::user()->isAdminOrLider() && !$respuesta)
    {{--{!! Form::hidden('userId',$user->id) !!}--}}
    <div class="form-group">
        {!! Form::label('start', 'Enviar') !!}
        <div class="input-group date" id="datetimepicker1">
            {!! Form::text('enviar', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div>

@endif



