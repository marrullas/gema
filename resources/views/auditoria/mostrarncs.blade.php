@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Procesos de auditoria</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$nombre],['url'=> 'auditoria/mostrarncs', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        <div class="form-group">
                            {!! Form::label('estado_nc', 'Estado') !!}
                            {!! Form::select('estadonc', $estadosncs, $estadonc, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
                        </div>
{{--                        <div class="form-group">
                            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Buscar por ciclo']) !!}
                        </div>--}}
                        <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        {{--<p> <a class="btn btn-info" href="{{ route('admin.usuariosxciclo.create') }}" role="button">Relacionar ciclo</a></p>--}}

                    </div>
                </div>
                @include('auditoria.partials.usuariosncs')

                {{--{!! $usuariosxciclo->appends(['nombre'=>$nombre])->render() !!}--}}
            </div>||
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {


            $('.btn-delete').click(function(e){

                e.preventDefault();

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form =  $('#form-delete');
                var url = form.attr('action').replace(':PROGRAMA_ID',id);
                var data = form.serialize();
                row.fadeOut();
                $.post(url,data, function(result) {

                    alert(result.message);

                }).fail(function(){
                    alert('El usuario no pudo ser eliminado');
                    row.show();
                });


            });

        });
    </script>
@endsection