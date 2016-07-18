@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios x Ciclos</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$nombre,'ciclo'=>$ciclo],['route'=> 'admin.usuariosxciclo.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        <div class="form-group">
                            {!! Form::text('nombre', $nombre, ['class' => 'form-control', 'placeholder'=>'Buscar por nombre']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::select('ciclo', $ciclos, $ciclo, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        @if(Auth::user()->isAdmin())
                            <p> <a class="btn btn-info" href="{{ route('admin.usuariosxciclo.create') }}" role="button">Relacionar ciclo</a></p>
                        @endif

                    </div>
                </div>
            </div>
                @include('admin.ciclos.usuariosxciclo.partials.table')
                {!! $usuariosxciclo->appends(['nombre'=>$nombre,'ciclo'=>$ciclo])->render() !!}
            </div>
        </div>
    </div>
    {!! Form::open(['route'=> ['admin.usuariosxciclo.destroy',':USUARIOSXCICLO_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
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
                var url = form.attr('action').replace(':PROGRAMA_ID',id);
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