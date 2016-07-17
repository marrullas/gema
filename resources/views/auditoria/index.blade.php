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
                        {!! Form::model(['name'=>$nombre],['url'=> 'auditoria', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        <div class="form-group">
                            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Buscar por ciclo']) !!}
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        {{--<p> <a class="btn btn-info" href="{{ route('admin.usuariosxciclo.create') }}" role="button">Relacionar ciclo</a></p>--}}

                    </div>
                </div>
                @include('auditoria.partials.table')
                <div class="row">
                    <div class="col-md-12">
                        <h2>Resumen revisiones activas</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Resumen total ciclos revisiones activas
                            </div>
                            <div class="panel-body">
                                <div id="donut-example"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Resumen total hallazgos por proceso de revisión
                            </div>
                            <div class="panel-body">
                                <div id="bar-example"></div>
                            </div>
                        </div>
                    </div>
                </div>
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

            var colors_array= ["#d9534f", "#f0ad4e", "#5cb85c"];
            Morris.Donut({
                element: 'donut-example',
                colors: colors_array,
                data: [
                    {label: "Nc's abiertas", value: + "{{$resumenciclos[0]->abiertas}}"},
                    {label: "Nc's devueltas", value: + "{{$resumenciclos[0]->devueltas}}"},
                    {label: "Nc's cerradas", value: + "{{$resumenciclos[0]->cerradas}}"}
                ]
            });
            Morris.Bar({
                element: 'bar-example',
                data: [
                        @foreach($totalncsxciclo as $total)
                    { y: '{!! $total->nombre !!}', a: '{{$total->conteo}}' },
                    @endforeach
                    {{--                    { y: '2006', a: 100, b: 90 },
                                        { y: '2007', a: 75,  b: 65 },
                                        { y: '2008', a: 50,  b: 40 },
                                        { y: '2009', a: 75,  b: 65 },
                                        { y: '2010', a: 50,  b: 40 },
                                        { y: '2011', a: 75,  b: 65 },
                                        { y: '2012', a: 100, b: 90 }--}}
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['# hallazgos'],
            });

        });
    </script>
@endsection