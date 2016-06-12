@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar Seguimiento</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($seguimiento,['route'=> ['admin.seguimientos.update', $seguimiento], 'method' => 'PUT' ]) !!}
                        @include('admin.seguimientos.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar
                        </button>
                        <a href="{{url('admin/seguimientos')}}" class="btn btn-danger">Cancelar
                        </a>
                        {!! Form::close() !!}
                        @include('admin.seguimientos.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
