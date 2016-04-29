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
                    <div class="panel-heading">Instituciones Educativas</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$nombre],['url'=> 'ies/actualizaries', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                            <div class="form-group">
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        {{--<p> <a class="btn btn-info" href="{{ route('admin.ies.create') }}" role="button">Crear IE</a></p>--}}

                    </div>
                </div>
        @include('users.ies.partials.table')

        {!! $ies->appends(['nombre'=>$nombre])->render() !!}
            </div>||
        </div>
    </div>
{{--    {!! Form::open(['route'=> ['users.ies.destroy',':IE_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
    {!! Form::close() !!}--}}
@endsection

@section('scripts')

    {!! HTML::script('/css/assets/js/custom.js') !!}
    <script>
        $(document).ready(function () {


            $('.btn-delete').click(function(e){

                e.preventDefault();

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form =  $('#form-delete');
                var url = form.attr('action').replace(':FICHA_ID',id);
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
@endsection