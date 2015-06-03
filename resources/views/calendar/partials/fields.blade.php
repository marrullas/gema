<div class="form-group">
    {!! Form::label('title', 'Actividad') !!}
    {!! Form::select('title',$tipoactividades,null,['class'=> 'form-control', 'placeholder' => 'Escoja tipo de actividad' ])!!}
</div>
<div class="form-group">
    {!! Form::label('ficha', 'ficha') !!}
    {!! Form::select('ficha_id', [null=>'Ninguna'] + $fichas, null, [ 'class' => 'form-control'] ) !!}
</div>

<div class="form-group">
    {!! Form::label('all_day', 'Todo el dia') !!}
    {!! Form::checkbox('all_day', null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('start', 'Inicia') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('start', null, ['class' => 'form-control', 'disabled' ]) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('end', 'Finaliza') !!}
    <div class="input-group date" id="datetimepicker2">
        {!! Form::text('end', null, ['class' => 'form-control', 'disabled' ]) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control textarea'])!!}
</div>