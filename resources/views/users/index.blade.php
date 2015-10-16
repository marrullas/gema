@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$name,'type'=>$type],['route'=> 'users.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                            <div class="form-group">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                                {!! Form::select('type', config('options.types'),null, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}

                    </div>
                </div>
        @include('users.partials.table')

        {!! $users->appends(['name'=>$name,'type'=>$type])->render() !!}
            </div>||
        </div>
    </div>

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
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection