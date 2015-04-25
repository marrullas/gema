
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <p>Errores encontrados</p>
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('message'))
        <div class="alert alert-danger" role="alert">
        <p class="alert-danger">{{ Session::get('message') }}</p>
        </div>


    @endif


