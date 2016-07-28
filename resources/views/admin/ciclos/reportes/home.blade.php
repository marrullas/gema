@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Panel de Graficos y reportes</h2>
                    <h5>Bienvenido </h5>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr/>
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
                            Resumen total hallazgos auditorias
                        </div>
                        <div class="panel-body">
                            <div id="bar-example"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resumen total hallazgos x usuario
                        </div>
                        <div class="panel-body">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Ncs x Auditor
                            </div>
                            <div class="panel-body">
                                <div>
                                    <canvas id="ncsxauditorChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{--                <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-red set-icon">
                            <i class="fa fa-envelope-o"></i>
                        </span>
                                    <div class="text-box" >
                                        <p class="main-text">12 Nuevos</p>
                                        <p class="text-muted">Mensajes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-bars"></i>
                        </span>
                                    <div class="text-box" >
                                        <p class="main-text">7 Tareas</p>
                                        <p class="text-muted">Pendientes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-bell-o"></i>
                        </span>
                                    <div class="text-box" >
                                        <p class="main-text">24 Nuevas</p>
                                        <p class="text-muted">Notificaciones</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-brown set-icon">
                            <i class="fa fa-rocket"></i>
                        </span>
                                    <div class="text-box" >
                                        <p class="main-text">3 Requerimientos</p>
                                        <p class="text-muted">Pendientes</p>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
        <!-- /. ROW  -->

        {{--                <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue">
                            <i class="fa fa-warning"></i>
                        </span>
                                    <div class="text-box" >
                                        <p class="main-text">52 Eventos para este mes </p>
                                        <p class="text-muted">Por favor revise su calendario</p>
                                        <hr />
                                        <p class="text-muted">
                                  <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
                                       3 eventos importantes
                                       </span>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="panel back-dash">
                                    <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; Acumulado de horas</strong>
                                    <p class="text-muted">Hasta este momento lleva registradas 96 horas de trabajo en las fichas asignadas. </p>
                                </div>

                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 ">
                                <div class="panel ">
                                    <div class="main-temp-back">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Visitas semanales pendientes</div>
                                                <div class="col-xs-6">
                                                    <div class="text-temp"> 3 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                    --}}{{--                    <div class="panel panel-back noti-box">
                                        <span class="icon-box bg-color-green set-icon">
                                        <i class="fa fa-desktop"></i>
                                        </span>
                                        <div class="text-box" >
                                        <p class="main-text">Display</p>
                                        <p class="text-muted">Looking Good</p>
                                        </div>
                                         </div>--}}{{--

                            </div>

                        </div>--}}
        <!-- /. ROW  -->
            {{--                <div class="row" >
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="panel panel-primary text-center no-boder bg-color-green">
                                        <div class="panel-body">
                                            <i class="fa fa-comments-o fa-5x"></i>
                                            <h4>20 Nuevos Comentarios </h4>
                                        </div>
                                        <div class="panel-footer back-footer-green">
                                            <i class="fa fa-rocket fa-5x"></i>
                                            Por favor confirmar asistencia consectetur adipiscing elitsit sit gthn ipsum dolor sit amet ipsum dolor sit amet

                                        </div>
                                    </div>
                                </div>--}}
            {{--                    <div class="col-md-9 col-sm-12 col-xs-12">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Aprendices que deben cambiar de documento
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre</th>
                                                        <th>Documento</th>
                                                        <th>ficha</th>
                                                        <th>Fecha cumpleaños.</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Carlos Antonio Velez</td>
                                                        <td>950101654897</td>
                                                        <td>755542</td>
                                                        <td>Ene/01/1995</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>William Vinasco</td>
                                                        <td>950101654897</td>
                                                        <td>755542</td>
                                                        <td>Ene/01/1995</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Jorge Bermudez</td>
                                                        <td>950101654897</td>
                                                        <td>755542</td>
                                                        <td>Ene/01/1995</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Carlos Augusto Londoño</td>
                                                        <td>950101654897</td>
                                                        <td>755542</td>
                                                        <td>Ene/01/1995</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Hernan Pelaez</td>
                                                        <td>950101654897</td>
                                                        <td>755542</td>
                                                        <td>Ene/01/1995</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Carlos Antonio Velez</td>
                                                        <td>950101654897</td>
                                                        <td>755542</td>
                                                        <td>Ene/01/1995</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>--}}
        </div>
        <!-- /. ROW  -->


        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {

            var colors_array = ["#d9534f", "#f0ad4e", "#5cb85c"];
            Morris.Donut({
                element: 'donut-example',
                colors: colors_array,
                data: [
                    {label: "Nc's abiertas", value: +"{{$resumenciclos[0]->abiertas}}"},
                    {label: "Nc's devueltas", value: +"{{$resumenciclos[0]->devueltas}}"},
                    {label: "Nc's cerradas", value: +"{{$resumenciclos[0]->cerradas}}"}
                ]
            });
            Morris.Bar({
                element: 'bar-example',
                data: [
                        @foreach($totalncsxciclo as $total)
                    {
                        y: '{!! $total->nombre !!}', a: '{{$total->conteo}}'
                    },
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

            var barOptions_stacked = {
                tooltips: {
                    enabled: true
                },
                hover: {
                    animationDuration: 0
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontFamily: "'Open Sans Bold', sans-serif",
                            fontSize: 11
                        },
                        scaleLabel: {
                            display: true
                        },
                        gridLines: {},
                        stacked: true
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                            color: "#fff",
                            zeroLineColor: "#fff",
                            zeroLineWidth: 0
                        },
                        ticks: {
                            fontFamily: "'Open Sans Bold', sans-serif",
                            fontSize: 11
                        },
                        stacked: true
                    }]
                },
                legend: {
                    display: true
                },

                animation: {
                    onComplete: function () {
                        var chartInstance = this.chart;
                        var ctx = chartInstance.ctx;
                        ctx.textAlign = "left";
                        ctx.font = "9px Open Sans";
                        ctx.fillStyle = "#fff";

                        /*         Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
                         var meta = chartInstance.controller.getDatasetMeta(i);
                         Chart.helpers.each(meta.data.forEach(function (bar, index) {
                         data = dataset.data[index];
                         if(i==0){
                         ctx.fillText(data, 50, bar._model.y+4);
                         } else {
                         ctx.fillText(data, bar._model.x-25, bar._model.y+4);
                         }
                         }),this)
                         }),this);*/
                    }
                },
                pointLabelFontFamily: "Quadon Extra Bold",
                scaleFontFamily: "Quadon Extra Bold",
            };

            var ctx = document.getElementById("myChart");
            var nombres = [];
            var datos1 = [];
            var datos2 = [];
            var datos3 = [];
            var datos4 = [];
            @foreach($resumenncxusuario as $data)


            nombres.push("{!! $data->full_name !!}");
            datos1.push({{$data->abiertas}});
            datos2.push({{$data->devueltas}});
            datos3.push({{$data->cerradas}});
            datos4.push({{$data->total}});


                    @endforeach

            var data = {
                        labels: nombres,
                        datasets: [/*{
                         label: "Total ncs",
                         backgroundColor: "rgba(66,139,202,0.2)",
                         borderColor: "rgba(66,139,202,1)",
                         borderWidth: 1,
                         hoverBackgroundColor: "rgba(66,139,202,0.4)",
                         hoverBorderColor: "rgba(255,99,132,1)",
                         data: datos4,
                         },*/{
                            label: "Ncs Abiertas",
                            backgroundColor: "rgba(217,83,79,1)",
                            borderColor: "rgba(217,83,79,1)",
                            borderWidth: 1,
                            hoverBackgroundColor: "rgba(217,83,79,0.4)",
                            hoverBorderColor: "rgba(255,99,132,1)",
                            data: datos1,
                        }, {
                            label: "Ncs Devueltas",
                            backgroundColor: "rgba(255,246,143,1)",
                            borderColor: "rgba(255,246,143,1)",
                            borderWidth: 1,
                            hoverBackgroundColor: "rgba(255,246,143,0.4)",
                            hoverBorderColor: "rgba(255,99,132,1)",
                            data: datos2,
                        }, {
                            label: "Ncs Cerradas",
                            backgroundColor: "rgba(92,184,92,1)",
                            borderColor: "rgba(92,184,92,1)",
                            borderWidth: 1,
                            hoverBackgroundColor: "rgba(92,184,92,0.4)",
                            hoverBorderColor: "rgba(255,99,132,1)",
                            data: datos3,
                        },
                        ]
                    };
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                barShowStroke: true,
                responsive: true,
                data: data,

                options: barOptions_stacked,
            });

            var ctx = document.getElementById("ncsxauditorChart");
            var nombres = [];
            var datos1 = [];

            @foreach($ncsxauditor as $data)


            nombres.push("{!! $data->full_name !!}");
            datos1.push({{$data->numeroncs}});


                    @endforeach

            var data = {
                        labels: nombres,
                        datasets: [{
                            label: "Ncs creadas",
                            backgroundColor: "rgba(66,139,202,1)",
                            borderColor: "rgba(66,139,202,1)",
                            borderWidth: 1,
                            hoverBackgroundColor: "rgba(66,139,202,0.4)",
                            hoverBorderColor: "rgba(255,99,132,1)",
                            data: datos1,
                        }
                        ]
                    };
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                barShowStroke: true,
                responsive: true,
                data: data,

                options: barOptions_stacked,
            });

        });


    </script>


    {{--{!! HTML::script('/css/assets/js/custom.js') !!}--}}


@endsection
