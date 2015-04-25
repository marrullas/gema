@include('partials.headerapp')
@if(Session::get('tipouser')== 'user')
    @include('partials.menuuser')
@else
    @include('partials.menu')
@endif


	@yield('content')
@include('partials.footerapp')
