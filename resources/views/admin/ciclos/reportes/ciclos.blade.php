<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>Panel de Graficos y reportes para el ciclo <b>{{$ciclo->nombre}}</></h2>
            <h5>Bienvenido </h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr/>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Resumen total hallazgos x acitivdad
                </div>
                <div class="panel-body">
                    <div>
                        <canvas id="myChartActivdad"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

            var ctx = document.getElementById("myChartActivdad");
            var nombres = [];
            var datos1 = [];

            @foreach($ncsxactividadxciclo as $data)


            nombres.push("{!! $data->nombre !!}");
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
