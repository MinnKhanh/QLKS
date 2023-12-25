@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush
@php
    use App\Enum\EMotorbike;
    use App\Enums\TypeBooking;
    use App\Enums\TypeTimeEnum;
    use App\Enums\StatusBookingEnum;
@endphp
<div>
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Thông tin đơn đặt</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active">Thông tin hóa đơn đặt</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->


    <!--================Booking Tabel Area  =================-->
    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="list">
            <div class="section_title text-center">
                <h2 class="title_color">Thông tin hóa đơn</h2>
            </div>
            <div class="row accomodation_two list-room justify-content-start" style="padding:2rem;">
                <table class="table">
                    <thead>
                      <tr>
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
                        <th style="width:200px">Trạng thái</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 0;
                        @endphp
                        @forelse ($listBooking as $item)
                            <tr>
                                <td scope="col" class="text-center align-middle ">{{ $index++ }}</td>
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
                                <td scope="col" class="text-center align-middle ">{{ $item['deposit'] }}
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
                                <td class="text-center">
                                    @if ($item['status'] == StatusBookingEnum::ACTIVE)
                                        <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['room']['id'], 'bookingid' => $item['id']]) }}"
                                            class="btn btn-success btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Chi tiết">{{ StatusBookingEnum::getName($item['status']) }}</a>
                                    @else
                                        <li class="list-inline-item icon-trash">
                                            <a class="btn btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Chi tiết">{{ StatusBookingEnum::getName($item['status']) }}</a>
                                        </li>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    </section>
</div>
