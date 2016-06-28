
<div class="nav navbar-nav" style="color: white;
padding: 15px 50px 5px 5px;
float: right;
font-size: 16px;">
    <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-user"></i> {{Auth::user()->full_name}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li>
                <a href="{{ route('users.edit', Auth::user()) }}"><i class="fa fa-fw fa-user"></i> Perfil</a>
            </li>
            <li>
                <a href="{{ url('feedback') }}"><i class="fa fa-fw fa-info-circle"></i> FeedBack</a>
            </li>
            {{--                <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>--}}
            <li class="divider"></li>
            <li>
                <a href="{{ url('/auth/logout') }}"><i class="fa fa-fw fa-power-off"></i> Desconectarse</a>
            </li>

        </ul>
    </div>

</div>

<div class="nav navbar-nav" style="color: white;
padding: 15px 5px 5px 5px;
float: right;
font-size: 16px;">
    <div class="dropdown">
            <button class="btn btn-info" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                nc's pendientes <span class="badge" id="ncspendientescount"></span>
            </button>
            <ul class="dropdown-menu" id="ulpendientes" role="menu" aria-labelledby="dropdownMenu2">
            </ul>
    </div>
</div>
@if((Auth::user()->type == 'admin' || Auth::user()->type == 'auditor'))
<div class="nav navbar-nav" style="color: white;
padding: 15px 5px 5px 5px;
float: right;
font-size: 16px;">
    <div class="dropdown">
        <button class="btn btn-warning" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-expanded="true">
            nc's devueltas <span class="badge" id="ncsdevueltascount"></span>
        </button>
        <ul class="dropdown-menu" id="uldevueltas" role="menu" aria-labelledby="dropdownMenu2">
        </ul>
    </div>
</div>
@endif
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $.get('/devolverncsajax', function(data){
                var $ulsub = $("#ulpendientes");
                $("#ncspendientescount").html(data.ncspendientes.length);
                $.each(data.ncspendientes, function (i, item) {
                    console.log(item);
                    $ulsub.append( // append directly here
                            '<li data-grid-id="' + item.id +
                            '"><a href="{{ url('auditoria/auditaractividad') }}/'+item.auditoria_id+'">' + item.descripcion
                            );
                })
                @if((Auth::user()->type == 'admin' || Auth::user()->type == 'auditor'))
                var $ulsub = $("#uldevueltas");
                $("#ncsdevueltascount").html(data.ncsdevueltas.length);
                $.each(data.ncsdevueltas, function (i, item) {
                    //console.log(item);
                    $ulsub.append( // append directly here
                            '<li data-grid-id="' + item.id +
                            '"><a href="{{ url('admin/auditoria') }}/'+item.auditoria_id+'/edit">' + item.descripcion
                    );
                })
                @endif
                console.log(data);
            });

        });
    </script>
@endsection