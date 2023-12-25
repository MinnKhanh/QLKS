<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/png">
    <title>K.Hotel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/vendors/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('user/vendors/owl-carousel/owl.carousel.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="{{ asset('assets/css/kendo.bootstrap-v4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    @livewireStyles
    @stack('css')
    <style>
        .login-title {
            font-family: 'Lilita One', cursive;
        }
    </style>
</head>

<body>
    <!--================Header Area =================-->
    @include('user.layout.header')
    <!--================Header Area =================-->
    @yield('content')
    <!--================ start footer Area  =================-->
    @include('user.layout.footer')
    <!--================ End footer Area  =================-->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('user/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('user/js/popper.js') }}"></script>
    {{--   <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('user/js/mail-script.js') }}"></script>
    <script src="{{ asset('user/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('user/vendors/nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('user/js/mail-script.js') }}"></script>
    <script src="{{ asset('user/js/stellar.js') }}"></script>
    <script src="{{ asset('user/vendors/lightbox/simpleLightbox.min.js') }}"></script> --}}
    <script src="{{ asset('user/js/custom.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.toast.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-core.js') }}" type="text/javascript"></script>

    @livewireScripts
    @yield('js')
</body>

</html>
