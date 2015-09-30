@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar ciclo</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($ciclo,['route'=> ['admin.ciclos.update', $ciclo], 'method' => 'PUT' ]) !!}
                        @include('admin.ciclos.partials.fields')
                        <div class="panel-footer">
                            <span class="pull-right">
                            <a href="{{ URL::to('admin/ciclos/'.$ciclo->id) }}" class="btn btn-primary btn-sm"><< Volver</a>
                         </span>
                        <button type="submit" class="btn btn-primary">Actualizar ciclo
                        </button>
                        {!! Form::close() !!}
                        @include('admin.ciclos.partials.delete')
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
