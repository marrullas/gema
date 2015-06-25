<table class="table table-striped">
<caption>Total registros : {{$users->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Telefono</th>
        <th>Tipo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr data-id="{{$user->id}}">
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->full_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->telefono1}}</td>
            <td>{{Lang::get('typeuser.'.$user->type)}}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Acciones
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('users.show', $user) }}">Detalles</a></li>
                    </ul>
                </div>

                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>