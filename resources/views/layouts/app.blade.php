<!doctype html>
<html lang="en-us">

    @include('layouts.include.header')
    <body class="o-page ">
        @php
        $session = Session::all();
        @endphp
        @include('layouts.include.breadcrumb')
        @include('layouts.include.message')
        
        @if($session['logindata'][0]['type'] == 'ADMIN')
            @include('layouts.include.leftpanel.admin-left-sidebar')
        @elseif($session['logindata'][0]['type'] == 'SUPERVISOR')
            @include('layouts.include.leftpanel.supervisor-left-sidebar')
        @elseif($session['logindata'][0]['type'] == 'WORKER')
            @include('layouts.include.leftpanel.worker-left-sidebar')
        @elseif($session['logindata'][0]['type'] == 'SUPERVISOR')
            @include('layouts.include.leftpanel.supervisor-left-sidebar')
        @else
        
        @endif
        
    <main class="o-page__content">
        @yield('content')
    </main>
    @include('layouts.include.footer')
</body>

</html>