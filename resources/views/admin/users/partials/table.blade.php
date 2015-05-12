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
                <a class="btn btn-warning btn-xs" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$user->id) }}">Programación</a>
                <a class="btn btn-info btn-xs" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>