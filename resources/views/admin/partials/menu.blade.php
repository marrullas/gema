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
            <li  >
                <a  href="{{ url('/calendar') }}"><i class="fa fa-table fa-3x"></i> Mi Calendario</a>
            </li>
            <li  >
                <a  href="{{ url('/admin/muro') }}"><i class="fa fa-comment fa-3x"></i> Muro / Anuncios</a>
            </li>

            <li  >
                <a  href="#"><i class="fa fa-edit fa-3x"></i> Documentos </a>
            </li>


            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Gestion de catálogos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/admin/ies') }}">I.E's</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/fichas') }}">Fichas</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/programas') }}">Programas</a>
                    </li>
                </ul>
            </li>
            <li >
                <a  href="#"><i class="fa fa-square-o fa-3x"></i> Notas</a>
            </li>
        </ul>

    </div>

</nav>
