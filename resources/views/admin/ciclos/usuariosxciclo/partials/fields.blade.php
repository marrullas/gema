<div class="form-group">
    {!! Form::label('usuarios', 'Usuarios') !!}
    @if($usuariosxciclo)
    {!! Form::select('user_id', $usuarios, $usuariosxciclo->user_id, [ 'class' => 'form-control'] ) !!}
    @else
        {!! Form::select('usuarios[]', $usuarios, null, [ 'class' => 'form-control selectpicker', 'multiple','data-live-search="true"'] ) !!}
    @endif
</div>
<div class="form-group">
    {!! Form::label('ciclo_id', 'Ciclo') !!}
    {!! Form::select('ciclo_id', $ciclos, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}

</div>

{{--<div class="form-group">
    {!! Form::label('titulo', 'Titulo') !!}
    {!! Form::text('titulo', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el titulo' ] ) !!}
</div>--}}

<div class="form-group">
       {!! Form::label('descripcion', 'Descripción',['class' => 'control-label col-md-4' ]) !!}
       {!! Form::textarea('descripcion', null, ['class' => 'form-control col-md-4' ]) !!}
</div>
{{--

    <div class="form-group">
           {!! Form::label('contenido', 'Responder',['class' => 'control-label col-md-4' ]) !!}
           {!! Form::textarea('contenido', null, ['class' => 'form-control col-md-4' ]) !!}
    </div>
--}}



{{--@if(Auth::user()->isAdminOrLider() && !$respuesta)
    --}}{{--{!! Form::hidden('userId',$user->id) !!}--}}{{--
    <div class="form-group">
        {!! Form::label('start', 'Enviar') !!}
        <div class="input-group date" id="datetimepicker1">
            {!! Form::text('enviar', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div>

@endif--}}



