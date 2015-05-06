<table class="table table-striped">
    <caption>Total registros : {{$programas->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Versión</th>
    </tr>
    </thead>
    <tbody>
    @foreach($programas as $programa)
        <tr data-id="{{$programa->id}}">
            <th scope="row">{{$programa->id}}</th>
            <td>{{$programa->nombre}}</td>
            <td>{{$programa->codigo}}</td>
            <td>{{$programa->version}}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('admin.programas.edit', $programa) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>