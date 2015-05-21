<div class="nav navbar-nav" style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">  {{--<a href="{{ url('/auth/logout') }}" class="btn btn-danger square-btn-adjust">Desconectarse</a>--}}

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
