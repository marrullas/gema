<table class="table table-striped">
    <caption>Total registros : {{$usuariosxciclo->count()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Ciclo</th>
        <th>Descripción</th>
        <th>Usuario</th>
        <th>Nc's Pendientes</th>
        <th>Fecha inicio</th>
        <th>Fecha final</th>

    </tr>
    </thead>
    <tbody>
    @foreach($usuariosxciclo as $ciclo)
        <tr data-id="{{$ciclo->id}}">
            <th scope="row">{{$ciclo->id}}</th>
            <td>{!!$ciclo->ciclo->nombre !!}</td>
            <td>{!!$ciclo->descripcion !!}</td>
            <td>{!!$ciclo->user->full_name !!}</td>
            <td>{!! $ciclo->ncsPendientesSum !!}</td>
            <td>{!!$ciclo->fecha_ini !!}</td>
            <td>{!!$ciclo->fecha_fin !!}</td>


            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('admin/auditoria', $ciclo) }}"><i class="fa fa-edit"> Auditar</i></a></li>
                            @if(Auth::user()->isAdmin())
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.usuariosxciclo.edit', $ciclo) }}"><i class="fa fa-edit"> Editar</i></a></li>
                            @endif
                            {{--<li role="presentation"><a role="menuitem" tabindex="-2" href="{{ route('admin.usuariosxciclo.show', $ciclo) }}"><i class="fa fa-info"> Detalles</i></a></li>--}}
{{--
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/admin/ciclos/activar/'.$ciclo->id) }}">Activar ciclo</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/admin/entregas/ciclo/'.$ciclo->id) }}">Entregas por ciclo</a></li>
--}}

                        </ul>
                    </div>
                </div>



                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>