@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar registro</h3></div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($usuariosxciclo,['route'=> ['admin.usuariosxciclo.update', $usuariosxciclo], 'method' => 'PUT' ]) !!}
                        @include('admin.ciclos.usuariosxciclo.partials.fields')

                        <button type="submit" class="btn btn-primary">Actualizar
                        </button>
                        {!! Form::close() !!}
                        @include('admin.ciclos.usuariosxciclo.partials.delete')
                            <span class="pull-right">
                            <a href="{{ URL::to('admin/usuariosxciclo/') }}" class="btn btn-primary btn-sm"><< Volver</a>
                         </span>

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