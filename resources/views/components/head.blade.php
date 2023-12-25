<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!-- csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME', 'K.HOTEL') }} | @yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    {{-- <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/css/themify-icons.css') }}" type="text/css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/customer.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/kendo.bootstrap-v4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- PAGE LEVEL STYLES-->
    @livewireStyles
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,600;1,300&display=swap" rel="stylesheet">
    @yield('css')
    @stack('css')
</head>
