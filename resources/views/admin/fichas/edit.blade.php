@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar ficha</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($ficha,['route'=> ['admin.fichas.update', $ficha], 'method' => 'PUT' ]) !!}
                        @include('admin.fichas.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar ficha
                        </button>
                        {!! Form::hidden('full_name',null) !!}
                        {!! Form::close() !!}
                        @include('admin.fichas.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>

    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'YYYY/MM/DD',
                date: '{{$ficha->fecha_ini}}'

            });
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'YYYY/MM/DD',
                date: '{{$ficha->fecha_fin}}'
                //widgetPositioning: {horizontal: 'right', vertical:'bottom'}


            });
        });
    </script>



@endsection
