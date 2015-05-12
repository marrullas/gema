@extends('app')
@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@section('content')
    <div class="container" id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar Evento</h3></div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($evento,['route'=> ['calendar.update', $evento], 'method' => 'PUT' ]) !!}
                        @include('calendar.partials.fields')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Actualizar evento</button>
                            @if($isAdminOrLider)
                            <a class="btn btn-info" href="{{ \Illuminate\Support\Facades\URL::to('/admin/users/calendar/'.$evento->user_id) }}" role="button">Volver</a>
                            @else
                                <a class="btn btn-info" href="{{ \Illuminate\Support\Facades\URL::to('/calendar/') }}" role="button">Volver</a>
                            @endif
{{--
                            {!! link_to(URL::previous(), 'Regresar', ['class' => 'btn btn-info']) !!}
--}}
                        </div>
                        {!! Form::close() !!}


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

    <script type="text/javascript" src="http://mediat.com/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="http://mediat.com/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'MM/DD/YYYY hh:mm A',
                date: '{{$evento->start}}'

            });
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'MM/DD/YYYY hh:mm A',
                date: '{{$evento->end}}'
                //widgetPositioning: {horizontal: 'right', vertical:'bottom'}


            });
        });
    </script>
    <link rel="stylesheet" href="http://mediat.com/css/fullcalendar.css">
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.print.css"/> !-->



@endsection