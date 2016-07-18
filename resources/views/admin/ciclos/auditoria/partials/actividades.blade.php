<table class="table table-striped">
    <caption>Total registros : {{$totalauditoria}} </caption>
    <thead>
    <tr>
        {{--<th>#</th>--}}
        <th>Nombre</th>
        <th>Nc's pendientes</th>
        <th>Nc's Resueltas</th>
        <th>Cumple</th>
        <th>Verifico</th>
    </tr>
    </thead>
    <tbody>
    @foreach($auditoria as $actividad)
        <tr data-id="{{$actividad->id}}">
            {{--<th scope="row">{{$actividad->id}}</th>--}}
            {{--<td>{!!$actividad->actividad->nombre !!}</td>--}}
            <td data-toggle="popover" data-placement="left" title="Tips"
                data-content="{{ $actividad->actividad->descripcion }}"
                data-container="body" data-html="true" data-trigger="hover">
            {!!$actividad->actividad->nombre !!}
            <td>{!! $actividad->ncsPendientesCount !!}</td>
            <td>{!! $actividad->ncsResueltasCount !!}</td>
            <td>{!! ($actividad->certificado ? 'SI':'NO')  !!}</td>
            <td>{!! $actividad->userCertificador['full_name'] !!}</td>

            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.auditoria.edit', $actividad) }}"><i class="glyphicon glyphicon-edit">Auditar-Actividad</i></a></li>
                            @if(Auth::user()->isAdmin())
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.edit', $actividad) }}"><i class="glyphicon glyphicon-edit"> Editar</i></a></li>
                            @endif
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.show', $actividad->actividad_id) }}"><i class="fa fa-info"> Detalles</i></a></li>
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
