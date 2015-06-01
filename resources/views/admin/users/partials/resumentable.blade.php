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
                <a class="btn btn-warning btn-xs" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$user->id) }}">Programación</a>
                <a class="btn btn-info btn-xs" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>