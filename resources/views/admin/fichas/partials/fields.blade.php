<div class="form-group">
    {!! Form::label('codigo', 'Codigo') !!}
    {!! Form::text('codigo', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese codigo' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('fecha_ini', 'Fecha inicio') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('fecha_ini', null, ['class' => 'form-control' ]) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('fecha_fin', 'Fecha terminación') !!}
    <div class="input-group date" id="datetimepicker2">
        {!! Form::text('fecha_fin', null, ['class' => 'form-control' ]) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('user', 'Gestor') !!}
    {!! Form::select('user_id', $usuarios, null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('grado', 'Grado / Curso') !!}
    {!! Form::select('grado',config('options.grado'), null, [ 'class' => 'form-control', 'placeholder' => 'Escoja grado' ] ) !!}
</div>

<div class="form-group">
    {!! Form::label('estado', 'Estado ') !!}
    {!! Form::select('estado',config('options.activo-inactivo'), null, [ 'class' => 'form-control', 'placeholder' => 'Escoja modalidad' ] ) !!}
</div>


<div class="form-group">
    {!! Form::label('ie', 'I.E') !!}
    {!! Form::select('ie_id', $ies, null, [ 'class' => 'form-control'] ) !!}
</div>

<div class="form-group">
    {!! Form::label('programa', 'Programa') !!}
    {!! Form::select('programa_id', $programas, null, [ 'class' => 'form-control'] ) !!}
</div>
