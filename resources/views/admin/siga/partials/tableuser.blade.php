<table class="table table-striped">
{{--<caption>Total registros : {{$users->total()}} </caption>--}}
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Entidad</th>
        <th>Ciclo</th>
        <th>Total Evidencias</th>
        <th>Evidencias entregadas</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ambitosxciclo as $ambitoxciclo)
        <tr data-id="{{$ambitoxciclo['id']}}">
            <th scope="row">{{$ambitoxciclo['id']}}</th>
            <td>{{$ambitoxciclo['user_nombre']}}</td>
            <td>{{$ambitoxciclo['nombre']}}</td>
            <td>{{$ambitoxciclo['ciclo_nombre']}}</td>
            <td>{{$ambitoxciclo['entregas_count'][0]['count']}}</td>
            <td>{{$ambitoxciclo['filecount']}}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Acciones
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdminOrlider())
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/admin/siga/timeline/'.$ambitoxciclo['ambitosxciclo_id']) }}">Timeline</a></li>
                        @else
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/siga/timeline/'.$ambitoxciclo['ambitosxciclo_id']) }}">Timeline</a></li>
                        @endif
{{--
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agenda/'.$ambitoxciclo->id) }}">Agenda</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividades?userId='.$ambitoxciclo->id) }}">Actividades</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.users.edit', $ambitoxciclo) }}">Editar</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.users.show', $ambitoxciclo) }}">Detalles</a></li>
--}}
                    </ul>
                </div>

                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>