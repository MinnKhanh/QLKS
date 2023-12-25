<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.html">
                <h2 class="login-title">K.HOTEL</h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Liên hệ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('room.index') }}">Danh sách phòng</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.html">Blogs</a></li>
                    @if (auth()->check())
                        <li class="nav-item"><a class="nav-link" href="{{ route('information.booking') }}">Danh sách hóa đơn</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('information.index') }}">Thông tin cá nhân</a></li>
                    @endif
                    <li class="nav-item submenu dropdown">
                        @if (auth()->check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button style="background: none;border: none;" class="nav-link dropdown-toggle"
                                    type="submit">Đăng xuất</button>
                            </form>
                        @else
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Tài khoản</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
                            </ul>
                        @endif

                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="elements.html">Elemests</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li> --}}
                </ul>
            </div>
        </nav>
    </div>
</header>
