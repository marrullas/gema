@extends('app')

@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@endsection
@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Acumulado actividades por ficha : <b>{{$user->full_name}}</b></h3></div>

                    <div class="panel-body">
                        <div class="panel-group">
                            <a class="btn btn-success btn-xs pull-right btn-sm RbtnMargin" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividadesexcel?userId='.$user->id.'&start='.$start.'&end='.$end) }}">Exportar excel</a>
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

                        {!! Form::model(['start'=>$start,'end'=>$end],['action'=> 'EventosController@actividades', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right form-inline', 'role'=>'search' ]) !!}
                        {!! Form::hidden('userId',$user->id) !!}
                            <div class="form-group">
                                {!! Form::label('start', 'Entre') !!}
                                <div class="input-group date" id="datetimepicker1">
                                    {!! Form::text('start', null, ['class' => 'form-control']) !!}
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('end', 'Y') !!}
                                <div class="input-group date" id="datetimepicker2">
                                    {!! Form::text('end', null, ['class' => 'form-control' ]) !!}
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                </div>
                            </div>

                        <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        @include('instructor.partials.tableactividades')
                    </div>
                    <div class="panel-heading"><h3>Acumulado por actividades:</h3></div>
                    <div class="panel-body">
                        @include('instructor.partials.tableactividadestotal')
                    </div>

                </div>


            </div>
        </div>
    </div>




@endsection


@section("scripts")
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>
    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}


    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY',
                sideBySide:true,
                showClear:true

            });
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY',
                sideBySide:true,
                showClear:true

            });

            var d = new Date();
            d.setHours(12,00,00);

            //$("#datetimepicker1").data("DateTimePicker").date(moment(d));
            //$("#datetimepicker2").data("DateTimePicker").date(moment(d));

            /*$("#all_day").change(function() {
                if($('#all_day').prop('checked')) {

                    var d = new Date($('#start').val());
                    d.setHours(12,00,00);

                    //$('#start').prop( "disabled", true);
                    //$('#end').prop( "disabled", true );
                    $("#datetimepicker1").data("DateTimePicker").date(moment(d).format("DD/MM/YYYY HH:mm"));
                    $("#datetimepicker2").data("DateTimePicker").date(moment(d).format("DD/MM/YYYY HH:mm"));

                }
            });*/

            /*            $("#start").change(function(){
             $('#all_day').prop('checked',false);
             });*/
        });
    </script>




@endsection
