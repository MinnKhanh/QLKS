<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email hóa đơn</title>
    <style>
        /* CSS cho phần header */
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* CSS cho phần thông tin khách hàng */
        .customer-info {
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* CSS cho bảng thông tin sản phẩm */
        .product-info {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        .product-info td,
        .product-info th {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .product-info th {
            background-color: #f2f2f2;
        }

        /* CSS cho phần tổng tiền */
        .total {
            text-align: right;
            margin-top: 10px;
        }

        .total span {
            font-weight: bold;
        }
    </style>
</head>

<body>
@php
    use App\Enum\EMotorbike;
    use App\Enums\TypeBooking;
    use App\Enums\TypeTimeEnum;
    use App\Enums\StatusBookingEnum;
    use App\Enums\StatusPayment;
@endphp
    <div class="header">
        <h1>Email hóa đơn</h1>
    </div>
    <div class="customer-info">
        <h2>Thông tin khách hàng</h2>
        <p>Tên: {{ $customer['name'] }}</p>
        <p>Email: {{ $customer['email'] }}</p>
        <p>SĐT: {{ $customer['phone'] }}</p>
        <p>CMTND: {{ $customer['cmtnd'] }}</p>
    </div>
    <table class="product-info">
        <thead>
            <tr>
                <th style="width:100px">#</th>
                <th style="width:100px">Tên phòng</th>
                <th style="width:100px">Sức chứa</th>
                <th style="width:120px">Loại phòng</th>
                <th style="width:100px">Giá phòng</th>
            </tr>
        </thead>
        <tbody>
            @php
            $index = 0;
        @endphp
        @forelse ($listRoom as $item)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['capacity']['max_capacity'] }}</td>
                <td>{{$item['Type']['TypeRoom']['name']}} - {{ $item['capacity']['name'] }}</td>
                <td>{{$item->priceOfRoom(1)}}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="5">Trống</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="total">
        {{-- <span>Tổng tiền thanh toán:</span> {{ $order['total_price'] }} đồng --}}
    </div>
</body>

</html>
