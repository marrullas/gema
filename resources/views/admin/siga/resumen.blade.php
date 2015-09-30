@extends('app')
@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
{{--                    <div class="panel-body">
                        {!! Form::model(['name'=>$name,'type'=>$type],['action'=> 'SigaController@indexusuarios', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}

                            <div class="form-group">
                                <div class="form-control">
                                    {!! Form::label('mes', 'Mes Anterior') !!}
                                    {!! Form::radio('periodo', 'anterior',('anterior' == $periodo)) !!}
                                    {!! Form::label('semana', 'Semana') !!}
                                    {!! Form::radio('periodo', 'semana',('semana'== $periodo)) !!}
                                    {!! Form::label('mes', 'Mes Actual') !!}
                                    {!! Form::radio('periodo', 'mes', ('mes'==$periodo)) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('sinprogramacion', 'sin programación') !!}
                                    {!! Form::checkbox('sinprogramacion', null,$sinprogramacion, [ 'class' => 'form-control'] ) !!}
                                </div>

                                <div class="form-group">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                                {!! Form::select('type', config('options.types'),null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        <a class="btn btn-success btn-xs" href="{{  \Illuminate\Support\Facades\URL::to('/admin/resumen/excel') }}">Exportar excel</a>
                        {!! Form::close() !!}

                    </div>--}}
                </div>
        @include('admin.siga.partials.tableuser')

        {{--{!! $users->appends(['name'=>$name,'type'=>$type])->render() !!}--}}
            </div>||
        </div>
    </div>
{{--    {!! Form::open(['route'=> ['admin.users.destroy',':USER_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
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
                var url = form.attr('action').replace(':USER_ID',id);
                var data = form.serialize();
                row.fadeOut();
                $.post(url,data, function(result) {

                    alert(result.message);

                }).fail(function(){
                    alert('El usuario no pudo ser eliminado');
                    row.show();
                });


            });

        });
    </script>
@endsection