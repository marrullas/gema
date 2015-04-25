<div class="form-group">
    {!! Form::label('title', 'Titulo') !!}
    {!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('ficha', 'ficha') !!}
    {!! Form::select('ficha_id', $fichas, null, [ 'class' => 'form-control'] ) !!}
</div>

<div class="form-group">
    {!! Form::label('all_day', 'Todo el dia') !!}
    {!! Form::checkbox('all_day', null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('start', 'Inicia') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('start', null, ['class' => 'form-control' ]) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('end', 'Inicia') !!}
    <div class="input-group date" id="datetimepicker2">
        {!! Form::text('end', null, ['class' => 'form-control' ]) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control'])!!}
</div>