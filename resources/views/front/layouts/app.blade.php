<!doctype html>
<html lang="en-us">

    @include('front.layouts.include.header')
    <body>
        @include('front.layouts.include.body_header')

        
        @yield('content')
        
        <!--@include('front.layouts.include.body_footer')-->
        @include('front.layouts.include.footer')
    </body>
</html>