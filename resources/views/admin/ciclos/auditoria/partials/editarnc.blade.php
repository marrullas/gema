@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar Hallazgo</h3></div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($nc,['route'=> ['ncs.update', $nc], 'method' => 'PUT' ]) !!}
                        {{--{!! Form::open(['route'  => 'ncs.update', 'method' => 'PUT','class'=>'form']) !!}--}}
                        @include('auditoria.partials.fields')
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" href="{{ route('admin.auditoria.edit', $nc->auditoria_id) }}">Volver</a>
                        <button type="submit" class="btn btn-primary">Editar NC</button>
                    </div>
                    {!! Form::close() !!}
                    @if((Auth::user()->type == 'admin'))
                        @include('admin.ciclos.auditoria.partials.deletencs')
                    @endif

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection