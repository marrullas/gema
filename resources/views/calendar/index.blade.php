@extends('app')

@section('menu')
@if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

    @include('instructor.partials.menu')
@else

    @include('admin.partials.menu')

@endif
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle de la actividad</h4>
                </div>
                <div class="modal-body">

                    <dl class="dl-horizontal">
                        <dt>Actividad</dt>
                        <dd><span id="actividad"></span></dd>
                        <dt>Institución</dt>
                        <dd><span id="ie"></span></dd>
                        <dt>Ficha</dt>
                        <dd><span id="ficha"></span></dd>
                        <dt>Ciudad</dt>
                        <dd><span id="ciudad"></span></dd>
                        <dt>Horas reportadas</dt>
                        <dd><span id="horas"></span></dd>
                        <dt>Hora inicial</dt>
                        <dd><span id="hora_ini"></span></dd>
                        <dt>Hora final</dt>
                        <dd><span id="hora_fin"></span></dd>
                        <dt>Detalle actividad</dt>
                        <dd><span id="DetActividad"></span></dd>

                    </dl>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a href="#" id="editarEvento" type="button" class="btn btn-primary">Editar</a>
                </div>
            </div>
        </div>
    </div>

    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Calendario: {!!$nombreuser!!}</h3></div>
                            @if(Session::has('message'))
                                <p class="alert-success">{{ Session::get('message') }}</p>


                            @endif

                            <div class="panel-body">
                                @include('admin.partials.messages')
                                <div class="panel-group">
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Agregar Evento
                                </a>
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                            Enlaces rapidos
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$user->id) }}">Calendario</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agenda/'.$user->id) }}">Agenda</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividades?userId='.$user->id) }}">Actividades</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="well">
                                        <div class="panel-group ">
                                            {!! Form::open(['route'  => 'calendar.store', 'method' => 'POST','class'=>'form']) !!}
                                            {!! Form::hidden('user_id',$user_id) !!}
                                            @include('calendar.partials.fields')
                                            <!-- falta la marca para todo el dia y el boton de guardar -->
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                                {!!Form::close()!!}
                                        </div>
                                    </div>

                                </div>
                                {!! $calendar->calendar() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang-all.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.css">

    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY HH:mm',
                sideBySide:true

            });
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY HH:mm',
                sideBySide:true

            });

            var d = new Date();
            d.setHours(12,00,00);

            //$("#datetimepicker1").data("DateTimePicker").date(moment(d));
            //$("#datetimepicker2").data("DateTimePicker").date(moment(d));

            $("#all_day").change(function() {
                if($('#all_day').prop('checked')) {

                    var d = new Date($('#start').val());
                    d.setHours(12,00,00);

                    //$('#start').prop( "disabled", true);
                    //$('#end').prop( "disabled", true );
                    $("#datetimepicker1").data("DateTimePicker").date(moment(d).format("DD/MM/YYYY HH:mm"));
                    $("#datetimepicker2").data("DateTimePicker").date(moment(d).format("DD/MM/YYYY HH:mm"));

                }
            });

/*            $("#start").change(function(){
                $('#all_day').prop('checked',false);
            });*/
        });
    </script>
    {!!Html::style('css/fullcalendar.css')!!}
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.print.css"/> !-->
    {!! $calendar->script() !!}
    {!! HTML::script('/css/assets/js/custom.js') !!}


@endsection




