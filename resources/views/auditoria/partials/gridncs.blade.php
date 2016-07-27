
<div class="well well-sm">
    <h2>Listado de Hallazgos</h2>
{{--    <div class="btn-group">
        <a href="#" id="listnc" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="gridnc" class="btn btn-default btn-sm"><span
                    class="glyphicon glyphicon-th"></span>Grid</a>
    </div>--}}
</div>
<div id="products" class="row list-group">
    {{--test tabla--}}

    @foreach($ncs as $nc)
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-condensed">
                    <thead class="thead-inverse">
                    <tr>
                        <th colspan="12">
                            <div align="center">
                                <span class="label label-info pull-right">#: {{$nc->id}}</span>
                                Responsable: <span class="label label-info">{{$nc->user->full_name}}</span> /
                                Plazo resolución: <span class="label label-warning">{{($nc->plazo!='0000-00-00')?$nc->plazo:'No defindo'}}</span>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th width="10%"><b>Detalles</b></th>
                        <th width="30%"><b>Descripcion</b></th>
                        <th width="22%"><b>Medida</b></th>
                        <th width="60%"><b>Seguimiento</b></th>
                        <th width="10%"><b>Acciones</b></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr class="text-centered">
                    <td ROWSPAN=2>
                        @if($nc->estadoncs->nombre == 'Abierta')
                            <span class="label label-warning pull-right">Estado: Abierto</span>
                        @elseif($nc->estadoncs->nombre == 'Devuelta')
                            <span class="label label-info pull-right">Estado: Devuelta</span>
                        @else
                            <span class="label label-success pull-right">Estado: Cerrado</span>
                        @endif

                        @if($nc->tiponc->prioridad == 'Alta')
                            <span class="label label-danger pull-right">Prioridad: Alta</span>
                        @elseif($nc->tiponc->prioridad == 'Media')
                            <span class="label label-warning pull-right">Prioridad: Media</span>
                        @else
                            <span class="label label-info pull-right">Prioridad: Baja</span>
                        @endif
                            <span class="label label-danger pull-right">Auditor:<br> {!! $nc->revisor->full_name !!}</span>
                            <hr>
                            <p>
                            <span class="label label-primary">Actividad:</span>
                                {!! $nc->auditoria->actividad->nombre !!}</p>


                    </td>
                        <td>{!! $nc->descripcion!!}</td>
                        <td>{!! $nc->medida!!}</td>
                        <td>

                            @include('admin.ciclos.auditoria.partials.chatnc')
                        </td>
                        <td class="text-centered">
                            @if($nc->estadoncs_id != 3)
                                {{--<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-pencil"></i> <strong>Agregar nota</strong></button>--}}
                                {{--solo se puede devolver una nc de la que se es responsable y que este abierta--}}
                                @if($nc->user_id == Auth::user()->id && $nc->estadoncs_id == 1)
                                    <button href="#" class="btn btn-inverse" data-toggle="modal" data-target="#myModaldevolvernc{{$nc->id}}"><i class="glyphicon glyphicon-backward"></i> <strong>Devolver</strong></button>
                                @endif
                                @if((Auth::user()->type == 'admin') || $nc->auditor == Auth::user()->id )
                                    @if(Request::segment(2) != 'listarncsxauditor') {{--Edita si no esta en el listado de nc x auditor--}}
                                        <a href="{{route('ncs.edit',$nc)}}" class="btn btn-info"><i class="glyphicon glyphicon-ok-sign"></i> <strong>Editar </strong></a>
                                    @else {{--Dirige a la opcion de auditoria de la actividad--}}
                                        <a href="{{route('admin.auditoria.edit',$nc->auditoria_id)}}" class="btn btn-default"><i class="glyphicon glyphicon-ok-sign"></i> <strong>Ir auditar </strong></a>
                                    @endif
                                @endif
                            @endif

             {{--               <a>
                                <span class="label label-success text-uppercase">5 5</span>

                            </a>--}}

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if($nc->estadoncs_id == 1)
            @include('auditoria.partials.devolvernc')
        @endif
        @endforeach

</div>

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
            $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
        });
    </script>
@endsection