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
                    <div class="panel-heading">Actas</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')
                            {!! Form::model(['codigo'=>$codigo],['route'=> 'actas.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        @else
                            {!! Form::model(['codigo'=>$codigo],['action'=> 'ActaController@todas', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        @endif
                            <div class="form-group">
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Buscar por usuario']) !!}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        <p> <a class="btn btn-info" href="{{ route('actas.create') }}" role="button">Solicitar acta</a></p>

                    </div>
                </div>
        @include('actas.partials.table')

        {!! $actas->appends(['codigo'=>$codigo])->render() !!}
            </div>||
        </div>
    </div>
    {!! Form::open(['route'=> ['actas.destroy',':ACTA_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {


            $('.btn-delete').click(function(e){

                e.preventDefault();

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form =  $('#form-delete');
                var url = form.attr('action').replace(':ACTA_ID',id);
                var data = form.serialize();
                row.fadeOut();
                $.post(url,data, function(result) {

                    alert(result.message);

                }).fail(function(){
                    alert('la ficha no pudo ser eliminada');
                    row.show();
                });


            });

        });
    </script>
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection