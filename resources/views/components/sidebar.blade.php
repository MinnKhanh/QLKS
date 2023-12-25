<nav class="navigation">
    <ul class="nav-page justify-content-center">
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Thông kê</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.statiscal.index') }}">
                        Danh sách đơn đặt
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.statiscal.payment') }}">
                        Danh sách hóa đơn thanh toán
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Phòng</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.bookroom.list_room') }}">
                        Danh sách phòng
                    </a>
                </li>
            </ul>
        </li>
        ​
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Xử lý phòng</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.room.create') }}">
                        Loại phòng
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.room.create_room') }}">
                        Chi tiết phòng
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.room.type_room') }}">
                        Kiểu phòng
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.room.room_capacity') }}">
                        Loại sức chứa
                    </a>
                </li>
            </ul>
        </li>
        ​
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Nhân viên</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.employee.index') }}">
                        Danh sách nhân viên
                    </a>
                </li>
            </ul>
        </li>
        ​
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Người dùng</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.customer.index') }}">
                        Danh sách người dùng
                    </a>
            </ul>
        </li>
        ​
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Sản phẩm</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.product.index') }}">
                        Trang thiết bị
                    </a>
            </ul>
        </li>
        ​
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Dịch vụ</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.service.index') }}">
                        Danh sách dịch vụ
                    </a>
                </li>
            </ul>
        </li>
        ​
        <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
                <span class="nav-title">Tài khoản</span>
            </a>
            <ul class="nav-page-1">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.auth.logout') }}">
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
