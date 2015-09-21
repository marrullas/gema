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
                    <div class="panel-heading">Recibidos</div>

                    <div class="panel-body">
                        @include('admin.partials.messages')

                        <!-- inicia seccion de mensajes!-->
                        @foreach($mensajes as $mensaje)



                            @if($mensaje->codigo == $mensaje->conversacion)
                                    @include('messages.partials.mensaje')
                            @else
                                    @include('messages.partials.respuesta')
                            @endif
                            @if($mensaje->user_id == $userID)
                                    {{--<p class="text-right"><a href="{{route('message.destroy',$mensaje)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</a></p>--}}
                                    @include('messages.partials.delete')

                            @endif


                        @endforeach
                        <div class="panel-group">


                        </div>
                            <div class="well">
                                <div class="panel-group ">
                                        {!! Form::open(['route'=> 'message.store', 'method' => 'POST' ]) !!}
                                        {!! Form::hidden('conversacion',$mensajes->first()->codigo) !!}
                                        @if($respuesta)
                                            {!! Form::hidden('destinatarios[]',$mensajeOri->user_id) !!}
                                            {!! Form::hidden('titulo',$mensajeOri->titulo) !!}
                                        @endif
                                        @include('messages.partials.fields')

                                        <button type="submit" class="btn btn-info">Enviar mensaje
                                        </button>

                                        {!! Form::close() !!}
                                </div>
                            </div>


                        <!-- termina seccion de mensajes!-->
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

    {!! HTML::script('/bower_resources/bootstrap-select/js/bootstrap-select.js') !!}
    {!! HTML::script('/bower_resources/bootstrap-select/js/i18n/defaults-es_CL.js') !!}
    {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}
    {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}

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

            $('.selectpicker').selectpicker();

        });
    </script>
    {!! HTML::script('/css/assets/js/custom.js') !!}



@endsection
