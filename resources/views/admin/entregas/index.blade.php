@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Entregas</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['id'=>$id],['route'=> 'admin.entregas.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                            <div class="form-group">
                                {!! Form::text('id', null, ['class' => 'form-control', 'placeholder'=>'Buscar por id']) !!}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {!! Form::close() !!}
                        <p> <a class="btn btn-info" href="{{  \Illuminate\Support\Facades\URL::to('/admin/entregas/create/'.$ciclo) }}" role="button">Crear entrega</a></p>


                    </div>
                </div>
        @include('admin.entregas.partials.table')

        {!! $entregas->appends(['id'=>$id])->render() !!}
            </div>||
        </div>
    </div>
    {!! Form::open(['route'=> ['admin.entregas.destroy',':ENTREGA_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
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
                var url = form.attr('action').replace(':ENTREGA_ID',id);
                var data = form.serialize();
                row.fadeOut();
                $.post(url,data, function(result) {

                    alert(result.message);

                }).fail(function(){
                    alert('El registro no pudo ser eliminado');
                    row.show();
                });


            });

        });
    </script>
@endsection