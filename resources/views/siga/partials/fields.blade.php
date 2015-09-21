
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre de la tarea' ] ) !!}
</div>

{{--<div class="form-group">
       {!! Form::label('descripcion', 'descripcion',['class' => 'control-label col-md-4' ]) !!}
       {!! Form::textarea('descripcion', null, ['class' => 'form-control col-md-4' ]) !!}
</div>

<div class="form-group">
    {!! Form::label('colaboradores', 'colaboradores') !!}
    {!! Form::select('colaboladores[]', $usuarios, null, [ 'class' => 'form-control selectpicker', 'multiple','data-live-search="true"'] ) !!}
</div>--}}

@if(Auth::user()->isAdminOrLider())
    {{--{!! Form::hidden('userId',$user->id) !!}--}}
    <div class="form-group">
        {!! Form::label('start', 'Enviar') !!}
        <div class="input-group date" id="datetimepicker1">
            {!! Form::text('enviar', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div>

@endif



