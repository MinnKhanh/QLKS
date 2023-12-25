@php
    use App\Enum\EMotorbike;
    use App\Enums\TypeBooking;
    use App\Enums\TypeTimeEnum;
    use App\Enums\StatusBookingEnum;
@endphp
<div id="page-wrap">
    <style>
    li {
        list-style: none;
    }
</style>
<div id="header" class="container-fluid text-center mb-5">
    <h3>Hóa Đơn Thanh Toán</h3>
</div>
<div id="details" class="row mb-5 justify-content-center">
    <div class="col col-6 text-center ">
        <ul>
            <li class="col-xs-12">
                <p class="d-inline-block">Tên Khách Hàng: </p><span id="partner-name">{{ $customer['name'] }}</span>
            </li>

            <li class="col-xs-12">
                <p class="d-inline-block">SĐT: </p><span id="partner-address">{{ $customer['phone'] }}</span>
            </li>

            <li class="col-xs-12">
                <p class="d-inline-block">CMTND: </p><span id="partner-tin-no">{{ $customer['cmtnd'] }}</span>
            </li>
            <li class="col-xs-12" style="">
                <p class="d-inline-block">Phương Thức Thanh Toán: </p><span
                    id="partner-tin-no">Thanh toán tại khách sạn</span>
            </li>

        </ul>

    </div>
</div>
<table class="table table-striped table-sm table-bordered dataTable no-footer"
cellspacing="0" width="100%" role="grid" aria-describedby="category-table_info"
style="width: 100%;">
<thead>
    <tr role="row">
        <th style="width:100px">#</th>
        <th style="width:100px">Phòng</th>
        <th style="width:100px">Thể loại</th>
        <th style="width:100px">Ngày vào</th>
        <th style="width:120px">Ngày ra</th>
        <th style="width:120px">Số người lớn</th>
        <th style="width:120px">Số trẻ em</th>
        <th style="width:120px">Loại thời gian thuê</th>
        <th style="width:120px">Tiền trả trước</th>
        <th style="width:120px">Tiền dịch vụ</th>
        <th style="width:120px">Phụ phí</th>
        <th style="width:120px">Tổng tiền</th>
    </tr>
</thead>
<tbody>
    @php
        $index = 0;
    @endphp
    @forelse ($listBooking as $item)
        <tr>
            <td scope="col" class="text-center align-middle ">
                {{ $index++ }}</td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['room']['name'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ TypeBooking::getName($item['type']) }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['checkin_date'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['checkout_date'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['number_of_adults'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['number_of_children'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ TypeTimeEnum::getName($item['type_time']) }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['deposit'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['price_service'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['late_checkin_fee'] + $item['early_checkIn_fee'] }}
            </td>
            <td scope="col" class="text-center align-middle ">
                {{ $item['total_price'] }}
            </td>
        </tr>
    @empty
    @endforelse
</tbody>
</table>
<br />
<br />
<br />
<p class="text-center">Thông tin hóa đơn đặt phòng</p>
<hr />
<div id="terms">
    <h3>K.HOTEL</h3>
    <ol>
        <li contenteditable="true"> Nếu có thắc mắc nào vui lòng nhắn đến sô điện thoại sau: 0704495681</li>
        <li contenteditable="true"> Rât cảm ơn quý khách đã đến với khách sạn</li>
    </ol>

</div>
<script>
    window.addEventListener("DOMContentLoaded", (event) => {
        window.print();
    });
</script>
</div>
