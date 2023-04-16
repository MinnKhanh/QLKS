<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/css/themify-icons.css') }}" type="text/css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />

    <!-- PAGE LEVEL STYLES-->
    @yield('css')
</head>

<body>
    <!-- START PAGE CONTENT-->
    <div class="bg-animate">
        <div class="content ">
            @yield('content')
        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- END PAGE CONTENT-->

    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

    <!-- CORE SCRIPTS-->
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>

    @yield('js')
    <!-- PAGE LEVEL SCRIPTS-->

</body>

</html>
