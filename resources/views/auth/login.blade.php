@extends('layouts.app')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5" style="height: 80%">
                    <img style="height: 100%" src="{{ asset('user/image/blog/blog-1.jpg') }}" class="img-fluid"
                        alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="logo-page col-md-12 mb-4" style="text-align: center">
                        <h2 class="login-title">
                            K.HOTEL
                        </h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mật Khẩu') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Nhớ Mật Khẩu') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 d-flex justify-content-center" style="margin-left: 46px;">
                            <button type="submit" class="btn btn-primary" style="width: 150px;">
                                {{ __('Đăng Nhập') }}
                            </button>

                        </div>
                        <div class="col-md-9 d-flex justify-content-center" style="margin-left: 110px;">

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Quên Mật Khẩu') }}
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ 'register' }}" class="btn btn-link">
                                    {{ __('Tạo tài khoản') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
