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
                <a   href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Informes</a>
            </li>
            <li>
                <a  href="#"><i class="fa fa-users fa-3x"></i> Usuarios <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a  href="{{ url('/admin/users') }}"><i class="fa fa-users fa-3x"></i> Usuarios</a>
                    </li>
                    <li>
                    <a  href="{{ url('/admin/resumen') }}"><i class="fa fa-users fa-3x"></i> Programación</a>
                    </li>
                </ul>

            </li>
            <li>
                <a href="#"><i class="fa fa-gears fa-3x"></i> SIGA<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/admin/procedimientos/') }}"><i class="fa fa-list-ul fa-3x"></i>Procedimientos</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/ciclos/') }}"><i class="fa fa-refresh fa-3x"></i>Ciclos</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/usuariosxciclo/') }}"><i class="fa fa-refresh fa-3x"></i>Usuarios x ciclo</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/ciclos/reporteciclos') }}"><i class="fa fa-refresh fa-3x"></i>Gráficos</a>
                    </li>
  {{--                  <li>
                        <a href="{{ url('/admin/siga/resumen/') }}"><i class="fa fa-list fa-3x"></i>Resumen x usuario</a>
                    </li>--}}
                </ul>
            </li>
            <li>
                <a  href="#"><i class="fa fa-users fa-3x"></i> Gestion <span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>
                        <a href="{{ url('/admin/seguimientos') }}">Seguimientos</a>

                    </li>
                </ul>
            </li>
            <li>
            <li>
                <a href="#"><i class="fa fa-archive fa-3x"></i> Actas<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/actas/') }}">Lista</a>
                    </li>
                    <li>
                        <a href="{{ url('/actas/todas') }}">Ver todas</a>
                    </li>
                </ul>
            </li>
{{--            <li>
                <a  href="{{ url('/forum') }}"><i class="fa fa-comments-o fa-3x"></i> Foro</a>
            </li>--}}
            <li>
                <a href="#"><i class="fa fa-envelope-o fa-3x"></i> Mensajeria<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/message/') }}"><i class="fa fa-inbox fa-3x"></i>Bandeja</a>
                    </li>
                    <li>
                        <a href="{{ url('/message/create') }}"><i class="fa fa-file-text fa-3x"></i>Crear</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="{{ url('/calendar') }}"><i class="fa fa-calendar-o fa-3x"></i> Mi Calendario</a>
            </li>
            <li>
                <a  href="{{ url('/admin/muro') }}"><i class="fa fa-comment fa-3x"></i> Muro / Anuncios</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-tasks fa-3x"></i> Tareas<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/tareas/') }}"><i class="fa fa-list-ol fa-3x"></i>Lista</a>
                    </li>
                    <li>
                        <a href="{{ url('/tareas/create') }}"><i class="fa fa-file-o fa-3x"></i>Crear</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Gestion de catálogos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/admin/ies') }}"><i class="fa fa-building-o fa-3x"></i>I.E's</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/fichas') }}"><i class="fa fa-puzzle-piece fa-3x"></i>Fichas</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/programas') }}"><i class="fa fa-cog fa-3x"></i>Programas</a>
                    </li>
                </ul>
            </li>
{{--            <li >
                <a  href="#"><i class="fa fa-square-o fa-3x"></i> Notas</a>
            </li>--}}
        </ul>

    </div>

</nav>
</div>