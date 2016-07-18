{{--VISTA DE TABLA DE ACTIVIDADES POR AUDITAR--}}
<table class="table table-striped">
    <caption>Total registros : {{$totalauditoria}} </caption>
    <thead>
    <tr>
        {{--<th>#</th>--}}
        <th>Nombre</th>
        <th>Nc's Abiertas</th>
        <th>Nc's Devueltas</th>
        <th>Nc's Cerradas</th>
        <th>Cumple</th>
        <th>Verifico</th>
    </tr>
    </thead>
    <tbody>
    @foreach($auditoria as $actividad)
        <tr data-id="{{$actividad->id}}">
            {{--<th scope="row">{{$actividad->id}}</th>--}}
            <td data-toggle="popover" data-placement="rigth" title="Tips"
                data-content="{{ $actividad->actividad->descripcion }}"
                data-container="body" data-html="true" data-trigger="hover">
                {!!$actividad->actividad->nombre !!}
            </td>
            <td>{!! $actividad->ncsPendientesCount !!}</td>
            <td>{!! $actividad->ncsDevueltasCount !!}</td>
            <td>{!! $actividad->ncsResueltasCount !!}</td>
            <td >{!! ($actividad->certificado ? '<span class="label label-success">SI</span>':'<span class="label label-warning">NO</span>')  !!}</td>
            <td>{!! $actividad->userCertificador['full_name'] !!}</td>

            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            @if($actividad->ncsPendientesCount >= 1)
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('auditoria/auditaractividad', $actividad) }}"><i class="glyphicon glyphicon-edit"> Revisar-hallazgos</i></a></li>
                            @endif
                            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.edit', $actividad) }}"><i class="glyphicon glyphicon-edit"> Editar</i></a></li>--}}
                            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.show', $actividad) }}"><i class="fa fa-info"> Detalles</i></a></li>--}}
                            {{--<li role="presentation"><a href="{{ URL::route('files.create','prefijo=AC&codigo='.$actividad->id) }}" class="btn btn-success btn-sm">Agregar archivo</a></li>--}}
                            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividades?userId=') }}">Documentos</a></li>--}}
                        </ul>
                    </div>
                </div>



                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
