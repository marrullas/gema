@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar datos funcionario</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($funcionario,['route'=> ['funcionarios.update', $funcionario], 'method' => 'PUT', 'id' =>'formfuncionarios' ]) !!}
                        @include('funcionarios.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar datos
                        </button>
                        {!! Form::close() !!}
                        @include('funcionarios.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
