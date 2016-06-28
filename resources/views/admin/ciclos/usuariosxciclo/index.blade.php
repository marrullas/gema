@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios x Ciclos</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$nombre],['route'=> 'admin.usuariosxciclo.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        <div class="form-group">
                            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        <p> <a class="btn btn-info" href="{{ route('admin.usuariosxciclo.create') }}" role="button">Relacionar ciclo</a></p>

                    </div>
                </div>
            </div>
                @include('admin.ciclos.usuariosxciclo.partials.table')
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Resumen auditorias activas
                    </div>
                    <div class="panel-body">
                        <div id="donut-example"></div>
                    </div>
                </div>
            </div>
                {{--{!! $usuariosxciclo->appends(['nombre'=>$nombre])->render() !!}--}}
            </div>||
        </div>
    </div>
    {!! Form::open(['route'=> ['admin.usuariosxciclo.destroy',':USUARIOSXCICLO_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
    {!! Form::close() !!}
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
            Morris.Donut({
                element: 'donut-example',
                data: [
                    {label: "Download Sales", value: 12},
                    {label: "In-Store Sales", value: 30},
                    {label: "Mail-Order Sales", value: 20}
                ]
            });

        });


    </script>
@endsection