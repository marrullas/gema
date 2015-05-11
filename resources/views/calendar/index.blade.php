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
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
                                <div class="panel-group">
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Agregar Evento
                                </a>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="well">
                                        <div class="panel-group ">
                                            {!! Form::open(['route'  => 'eventos.store', 'method' => 'POST','class'=>'form']) !!}
                                            {!! Form::hidden('user_id',$user_id) !!}
                                            @include('calendar.partials.fields')
                                            <!-- falta la marca para todo el dia y el boton de guardar -->
                                            <button type="submit" class="btn btn-default">Registrar</button>
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

    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'MM/DD/YYYY hh:mm A'

            });
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'MM/DD/YYYY hh:mm A'
                //widgetPositioning: {horizontal: 'right', vertical:'bottom'}


            });
        });
    </script>
    {!!Html::style('css/fullcalendar.css')!!}
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.print.css"/> !-->
    {!! $calendar->script() !!}


@endsection




