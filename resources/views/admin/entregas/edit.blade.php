@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar procedimiento</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($actividad,['route'=> ['admin.actividades.update', $actividad], 'method' => 'PUT' ]) !!}
                        @include('admin.actividades.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar actividad
                        </button>
                        {!! Form::close() !!}
                        @include('admin.actividades.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
