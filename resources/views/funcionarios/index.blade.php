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
                    <div class="panel-heading">Funcionarios</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$nombre],['route'=> 'funcionarios.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                            <div class="form-group">
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        <p> <a class="btn btn-info" href="{{ url('funcionarios/create',$ie) }}" role="button">Agregar funcionario</a></p>

                    </div>
                </div>
        @include('funcionarios.partials.table')

        {{--{!! //$funcionariosie->appends(['nombre'=>$nombre])->render() !!}--}}
            </div>||
        </div>
    </div>
{{--    {!! Form::open(['route'=> ['funcionariosie.destroy',':FUNCIONARIO_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
    {!! Form::close() !!}--}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {


            $('.btn-delete').click(function(e){

                e.preventDefault();

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form =  $('#form-delete');
                var url = form.attr('action').replace(':FUNCIONARIO_ID',id);
                var data = form.serialize();
                row.fadeOut();
                $.post(url,data, function(result) {

                    alert(result.message);

                }).fail(function(){
                    alert('El funcionario no pudo ser eliminado');
                    row.show();
                });


            });

        });
    </script>
@endsection