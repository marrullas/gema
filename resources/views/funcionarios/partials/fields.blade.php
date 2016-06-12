<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre','required' ] ) !!}
    {!! Form::hidden('ie_id',$ie->id) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Telefono') !!}
    {!! Form::text('telefono', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese telefono' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('correo', 'Correo electronico') !!}
    {!! Form::email('correo', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese Correo', 'type' => 'email', 'data-parsley-trigger'=>'change' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('observaciones', 'Observaciones / Notas') !!}
    {!! Form::textarea('observaciones', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese observaciones o notas sobre el funcionario' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('tipofuncionario', 'Tipo funcionario') !!}
    {!! Form::select('tipofuncionario_id', $tipofuncionario, null, [ 'class' => 'form-control'] ) !!}
</div>