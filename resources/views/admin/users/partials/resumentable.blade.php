<table class="table table-striped">
<caption>Total registros : {{$users->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>horas</th>
        <th>eventos</th>
        <th>dias</th>

    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr data-id="{{$user->id}}">
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->full_name}}</td>
            <td>{{$user->horas}}</td>
            <td>{{$user->nueventos}}</td>
            <td>{{$user->dias}}</td>

            <td>
                @if(!$reporte)
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$user->id) }}">Programacion</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agenda/'.$user->id) }}">Agenda</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.users.edit', $user) }}">Editar</a></li>
                        </ul>
                    </div>
                    <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>