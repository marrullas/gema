<table class="table table-striped">
    <caption>Total registros : {{$ies->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Modalidad</th>
        <th>Email</th>
        <th>Dirección</th>
        <th>Teléfono</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ies as $ie)
        <tr data-id="{{$ie->id}}">
            <th scope="row">{{$ie->id}}</th>
            <td>{{$ie->nombre}}</td>
            <td>{{$ie->tipo}}</td>
            <td>{{$ie->modalidad}}</td>
            <td>{{$ie->email}}</td>
            <td>{{$ie->direccion}}</td>
            <td>{{$ie->telefono}}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('admin.ies.edit', $ie) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>