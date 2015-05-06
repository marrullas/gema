<div id="wrapper"> {{-- inicio--}}
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">GEMA admin</a>
    </div>
    <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Ultimo Acceso : {{Auth::user()->last_login}} &nbsp; <a href="{{ url('/auth/logout') }}" class="btn btn-danger square-btn-adjust">Desconectarse</a> </div>
</nav>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                {!! Html::image('/css/assets/img/find_user.png',null, ['class'=>'user-image img-responsive']) !!}
                <h3 style="color: #ffffff   ">{{Auth::user()->full_name}}</h3>

                {{--<img src="assets/img/find_user.png" class="user-image img-responsive"/>--}}
            </li>


            <li>
                <a class="active-menu"  href="{{ url('/home') }}"><i class="fa fa-dashboard fa-3x"></i> Panel de control</a>
            </li>
            {{--                   <li>
                                   <a  href="ui.html"><i class="fa fa-desktop fa-3x"></i> UI Elements</a>
                               </li>
                               <li>
                                   <a  href="tab-panel.html"><i class="fa fa-qrcode fa-3x"></i> Tabs & Panels</a>
                               </li>--}}
            <li  >
                <a   href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Informes</a>
            </li>
            <li  >
                <a  href="{{ url('/calendar') }}"><i class="fa fa-table fa-3x"></i> Mi Calendario</a>
            </li>
            <li  >
                <a  href="#"><i class="fa fa-edit fa-3x"></i> Documentos </a>
            </li>


            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Gestion de catálogos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/ies') }}">I.E's</a>
                    </li>
                    <li>
                        <a href="{{ url('/fichas') }}">Fichas</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/users') }}">Usuarios</a>
                    </li>
                    <li>
                        <a href="#">Aprendices<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ url('/ficha/758645') }}">758645</a>
                            </li>
                            <li>
                                <a href="{{ url('/ficha/769899') }}">769899</a>
                            </li>
                            <li>
                                <a href="{{ url('/ficha/935687') }}">935687</a>
                            </li>

                        </ul>

                    </li>
                </ul>
            </li>
            <li >
                <a  href="#"><i class="fa fa-square-o fa-3x"></i> Notas</a>
            </li>
        </ul>

    </div>

</nav>