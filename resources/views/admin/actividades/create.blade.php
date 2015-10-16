@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Nueva Actividad</div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::open(['route'=> 'admin.actividades.store', 'method' => 'POST' ]) !!}
                        @include('admin.actividades.partials.fields')

                        <button type="submit" class="btn btn-default">Crear actividad
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
