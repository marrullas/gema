@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Revisión ncs de usuarios</div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        {!! Form::model(['name'=>$nombre,'usuario'=>$usuario],['route'=> 'auditoria.listarncsxauditores', 'method'=>'GET', 'class'=>'navbar-form navbar-left pull-right', 'role'=>'search' ]) !!}
                        <div class="form-group">
                            {!! Form::text('id', $id, ['class' => 'form-control', 'placeholder'=>'Buscar por Buscar x numero']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('estado_segumiento', 'Auditor') !!}
                            {!! Form::select('auditor', $auditores, $auditor, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('estado_segumiento', 'Instructor') !!}
                            {!! Form::select('usuario', $usuariosnc, $usuario, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vencida', 'Vencidas') !!}
                            {!! Form::checkbox('vencida', null,$vencida, [ 'class' => 'form-control'] ) !!}
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-default">Buscar</button>
                        <button type="submit" name ="exportar" value="1" class="btn btn-success">Exportar</button>
                        {!! Form::close() !!}
                    </div>
                </div>

            <div class="row"> {{--contenido--}}
                <div class="col-md-10 col-md-offset-1 toppad" >
                    {{--@include('admin.ciclos.auditoria.partials.actividades')--}}
                    @include('auditoria.partials.gridncs')
                    {!! $ncs->appends(['id'=>$id,'auditor'=>$auditor,'usuario'=>$usuario,'vencida'=>$vencida])->render() !!}
                </div>
            </div><!--row!-->
{{--            {!! $usuariosxciclo->appends(['nombre'=>$nombre,'ciclo'=>$ciclo])->render() !!}--}}
        </div>
    </div>
    </div>
{{--    {!! Form::open(['route'=> ['admin.usuariosxciclo.destroy',':USUARIOSXCICLO_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
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