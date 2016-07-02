
    <div class="well well-sm">
        <strong>Cambiar vista</strong>
        <div class="btn-group">
            <a href="#" id="listnc" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="gridnc" class="btn btn-default btn-sm"><span
                        class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div id="products" class="row list-group">
        @foreach($ncs as $nc)
        <div class="item  col-xs-4 col-lg-4 list-group-item">
            <div><b>Responsable:</b><h3>{{$nc->user->full_name}}</h3></div>
            <div class="thumbnail">
                {{--<img class="group list-group-image" src="http://placehold.it/400x250/000/fff" alt="" />--}}
                <div class="caption">
                    <div class="nav">
                        @if($nc->estadoncs_id != 3)
                        {{--<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-pencil"></i> <strong>Agregar nota</strong></button>--}}
                            {{--solo se puede devolver una nc de la que se es responsable y que este abierta--}}
                            @if($nc->user_id == Auth::user()->id && $nc->estadoncs_id == 1)
                                <button href="#" class="btn btn-inverse" data-toggle="modal" data-target="#myModaldevolvernc{{$nc->id}}"><i class="glyphicon glyphicon-backward"></i> <strong>Devolver</strong></button>
                            @endif
                        @endif
                        @if((Auth::user()->type == 'admin' || Auth::user()->type == 'auditor') && $nc->estadoncs_id != 3 && $nc->user_id != Auth::user()->id)
                        <button href="#" class="btn btn-success" data-toggle="modal" data-target="#myModalcerrarnc{{$nc->id}}"><i class="glyphicon glyphicon-ok-sign"></i> <strong>Cerrar</strong></button>
                        @endif
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
                    </div>
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"><a href="#home{{$nc->id}}" aria-controls="home{{$nc->id}}" role="tab" data-toggle="tab">Descripcion</a></li>
                            <li role="presentation"><a href="#profile{{$nc->id}}" aria-controls="profile{{$nc->id}}" role="tab" data-toggle="tab">Medida</a></li>
                            <li role="presentation" class="active"><a href="#messages{{$nc->id}}" aria-controls="messages{{$nc->id}}" role="tab" data-toggle="tab">Notas</a></li>
                            {{--<li role="presentation"><a href="#settings{{$nc->id}}" aria-controls="settings{{$nc->id}}" role="tab" data-toggle="tab">Settings</a></li>--}}
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="home{{$nc->id}}">{!! $nc->descripcion!!}</div>
                            <div role="tabpanel" class="tab-pane" id="profile{{$nc->id}}">{!! $nc->medida !!}</div>
                            <div role="tabpanel" class="tab-pane active" id="messages{{$nc->id}}">@include('admin.ciclos.auditoria.partials.chatnc')</div>
                            {{--<div role="tabpanel" class="tab-pane" id="settings{{$nc->id}}">SETTINGS</div>--}}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                Plazo resolución: <span class="label label-info">{{($nc->plazo!='0000-00-00')?$nc->plazo:'No defindo'}}</span></p>
                        </div>
                    </div>
                </div>
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