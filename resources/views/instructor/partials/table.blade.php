<table class="table table-striped">
    <caption>Total fichas asignadas : {{$fichasasignadas->count()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Programa</th>
        <th>Grado</th>
        <th>Ciudad</th>
    </tr>
    </thead>
    <tbody>

    @foreach($fichasasignadas as $ficha)
            <tr data-id="{{$ficha->id}}">
            <th scope="row">{{$ficha->id}}</th>
            <td>{{$ficha->full_name}}</td>
            <td>{{$ficha->programa->nombre}}</td>
            <td>{{$ficha->grado}}</td>
            <td>{{$ficha->ie->ciudad->nombre    }}</td>

            <td>
                <!--
                <a class="btn btn-warning btn-xs" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$ficha->id) }}">Programación</a>
                <a class="btn btn-info btn-xs" href="{{ route('admin.users.edit', $ficha) }}">Editar</a>
               <a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>