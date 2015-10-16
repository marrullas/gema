<div id="wrapper"> {{-- inicio--}}
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">GEMA </a>
    </div>
@include('partials.menuuser')
</nav>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                {!! Html::image('/css/assets/img/find_user.png',null, ['class'=>'user-image img-responsive']) !!}
                <h3 style="color: #ffffff   ">{{Auth::user()->full_name}}</h3>
            </li>
            <li>
                <a class="active-menu"  href="{{ url('/home') }}"><i class="fa fa-dashboard fa-3x"></i> Panel de control</a>
            </li>
            <li>
                <a  href="{{ url('/calendar') }}"><i class="fa fa-table fa-3x"></i> Calendario</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> SIGA<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a  href="{{ url('/siga') }}"><i class="fa fa-list-ul fa-3x"></i> Procedimientos</a>
                    </li>
                    <li>
                        <a href="{{ url('/siga/resumen') }}"><i class="fa fa-list fa-3x"></i>resumen</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-file-text fa-3x"></i> Informes<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/eventos/agenda') }}">Agenda</a>
                    </li>
                    <li>
                        <a href="{{ url('/eventos/actividades') }}">Actividades</a>
                    </li>
                    <li>
                        <a href="{{ url('/eventos/acumuladoxficha') }}">Acumulado x ficha</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="{{ url('/forum') }}"><i class="fa fa-group fa-3x"></i> Foro</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-envelope-o fa-3x"></i> Mensajeria<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/message/') }}">Bandeja</a>
                    </li>
                    <li>
                        <a href="{{ url('/message/create') }}">Crear</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-archive fa-3x"></i> Actas<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/actas/') }}">Lista</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-tasks fa-3x"></i> Tareas<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/tareas/') }}">Lista</a>
                    </li>
                    <li>
                        <a href="{{ url('/tareas/create') }}">Crear</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="#"><i class="fa fa-users fa-3x"></i> Usuarios <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a  href="{{ url('/users/') }}"><i class="fa fa-users fa-3x"></i> Consultar Usuarios</a>
                    </li>
                </ul>

            </li>

        </ul>

    </div>

</nav>
