@if(\Auth::user()->isAdminOrLider())
    @include('menu.partials.admin')
@elseif(\Auth::user()->type == 'instructor')
    @include('menu.partials.instructor')
@elseif(\Auth::user()->type == 'user')
    @include('menu.partials.instructor')
@elseif(\Auth::user()->type == 'auditor')
    @include('menu.partials.auditor')
@endif