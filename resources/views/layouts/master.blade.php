<!DOCTYPE html>
<html lang="en">
<x-head />

<body class="fixed-navbar">
    <div class="page-wrapper">
        {{-- <x-header /> --}}
        <x-sidebar />
        <div class="content-wrapper">
            <div class="page-content fade-in-up">
                @yield('content')
            </div>
            {{-- <x-footer /> --}}
        </div>
    </div>
    {{-- <x-theme/> --}}
    <div class="sidenav-backdrop
                backdrop"></div>
    <!-- <div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div> -->
    {{-- <x-toast/> --}}
    @stack('modal')
    @include('layouts.partials._script')
    @livewireScripts
    @yield('js')
    <script>
        $(document).on('keyup change', '.form-control', function(e) {
            $(this).siblings('.invalid-feedback').remove();
            $(this).removeClass('is-invalid');
            $(this).parents('.form-group').removeClass('has-error');
        });

        function showToast(heading, text, icon) {
            $.toast({
                heading: heading,
                text: text,
                position: 'bottom-right',
                icon: icon,
                hideAfter: 2000
            })
        }
    </script>
</body>

</html>
