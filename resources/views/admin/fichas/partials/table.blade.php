<table class="table table-striped">
    <caption>Total registros : {{$fichas->count()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Codigo</th>
        <th>Fecha Inicial</th>
        <th>Fecha Final</th>
        <th>Gestor</th>
        <th>I.E</th>
        <th>Estado</th>
        <th>Programa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($fichas as $ficha)
        <tr data-id="{{$ficha->id}}">
            <th scope="row">{{$ficha->id}}</th>
            <td>{{$ficha->codigo}}</td>
            <td>{{$ficha->fecha_ini}}</td>
            <td>{{$ficha->fecha_fin}}</td>
            <td>{{$ficha->user->full_name}}</td>
            <td>{{$ficha->ie->nombre}}</td>
            <td>{{$ficha->estado}}</td>
            <td>{{$ficha->programa->nombre}}</td>
            <td>
                @if(Session::get('tipouser')== 'admin')
                <a class="btn btn-info btn-xs" href="{{ route('admin.fichas.edit', $ficha) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>