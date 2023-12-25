<!DOCTYPE html>
<html lang="en">
{{-- <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon"> --}}
<link href="{{ asset('assets/css/auth-light.css') }}" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
<x-head />
<style>
    .all {
        background-color: #007bff6e;
        margin-top: 60px;
    }

    #login-form {
        width: 50%;
        padding: 8rem;
        border-radius: 1rem;
        margin: 0 auto;
        margin-top: 2rem;
    }

    .login-title {
        font-family: 'Lilita One', cursive;
    }
</style>

<body class="fixed-navbar">
    <div class="page-wrapper">
        {{-- <x-header /> --}}
        <div class="content-wrapper all">
            <div class="page-content fade-in-up">
                <div class="brand">
                    <span>{{ env('APP_HEADCODE') }}</span>
                </div>
                <form id="login-form" action="{{ route('admin.auth.sigin') }}" method="post">
                    @csrf
                    <h2 class="login-title">K.HOTEL ADMIN </h2>
                    <div class="form-group">
                        <div class="input-group-icon right">
                            <div class="input-icon"></div>
                            <input class="form-control form-login" type="text" value="{{ old('email') }}"
                                id="email" name="email" placeholder="Mã đăng nhập" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group-icon right">
                            <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                            <input class="form-control form-login" type="password" id="password" name="password"
                                placeholder="Mật khẩu">
                        </div>
                    </div>
                    <!-- <div class="form-group d-flex justify-content-between">
                                <label class="ui-checkbox ui-checkbox-info">
                                    <input type="checkbox">
                                    <span class="input-span"></span>Nhớ mật khẩu</label>
                                <a href="#">Quên mật khẩu?</a>
                            </div> -->
                    <div class="form-group">
                        <button class="btn btn-info btn-block btn-login" type="submit">Đăng nhập</button>
                    </div>
                </form>
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
        $(function() {
            if ($('#login-form').length) {
                $('#login-form').validate({
                    errorClass: "help-block",
                    rules: {
                        email: {
                            required: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        }
                    },
                    messages: {
                        email: {
                            required: "Bạn chưa nhập username"
                        },
                        password: {
                            required: "Bạn chưa nhập mật khẩu",
                            minlength: "Mật khâủ phải chứa ít nhất 6 kí tự"
                        }
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                });
            }
        });
    </script>
</body>

</html>
