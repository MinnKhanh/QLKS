@php
    use App\Enum\EMotorbike;
    use App\Enums\TypeBooking;
    use App\Enums\TypeTimeEnum;
    use App\Enums\StatusBookingEnum;
@endphp
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .notifi {
            position: fixed;
            top: 1rem;
            right: 2rem;
        }

        .notification {
            /* display: block; */
            background-color: white;
            /* border: 1px solid; */
            outline: 1px solid gray;
            z-index: 1;
            border-radius: 2px;
        }

        .toast-header {
            padding: 0rem .5rem;
            background-color: #ffeb00c2;
        }

        .pagination {
            padding-top: 25px;
            text-align: center !important;
            justify-content: center;
        }

        .pagination li {
            text-align: center !important;
            margin: 0px .2rem;
        }

        .page-item.active .page-link {
            border-color: #111111;
            color: black !important;
            background: transparent;
        }

        .pagination .page-link {
            display: inline-block !important;
            font-size: 16px;
            font-weight: 700;
            color: #111111;
            height: 30px;
            width: 30px;
            border-radius: 50% !important;
            line-height: 30px;
            text-align: center;
            align-items: center;
            padding: 0;

        }

        .navigation div span {
            cursor: pointer;
        }

        .pagination li.active {
            border-color: #111111;
        }

        .pagination li:hover {
            border-color: #111111;
        }

        .category {
            color: gray !important;
        }

        .category:hover,
        .category:focus {
            text-decoration: none;
            outline: none;
            color: black !important;
        }

        #logo {
            max-width: 25% !important;
            position: absolute;
            top: 2px;
        }
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Thông kê hóa đơn đặt</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-4 col-form-label pd-0">Họ tên khách hàng</label>
                    <div class="col-8">
                        <select name="customer_name" id="customer" wire:model="customer" type="text"
                            class="form-control select2-box">
                            <option value='0'>--Chọn--</option>
                            @forelse ($listCustomer as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Loại đăt phòng</label>
                    <div class="col-9">
                        <select name="customer_name" wire:model="type" type="text" class="form-control">
                            <option value="0">--Chọn--</option>
                            <option value="1">Tại khách sạn</option>
                            <option value="2">Đặt trực tuyến(đặt trước)</option>
                        </select>
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Loại thời gian</label>
                    <div class="col-9">
                        <select name="customer_name" wire:model="typeTime" type="text" class="form-control">
                            <option value="0">--Chọn--</option>
                            <option value="1">Ngày</option>
                            <option value="2">Đêm</option>
                            <option value="3">Giờ</option>
                        </select>
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Ngày đến</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="dateIn" type="date" class="form-control">
                    </div>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Ngày đi</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="dateOut" type="date" class="form-control">
                    </div>
                </div>
                <div class="col-5 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Loại phòng</label>
                    <div class="col-9">
                        <select name="customer_name" wire:model="typeRoom" type="text" class="form-control">
                            <option value="">--Chọn--</option>
                            @forelse ($listRoom as $item)
                                <option value="{{ $item['id'] }}">{{ $item['room_capacity']['name'] }} -
                                    {{ $item['room_capacity']['number_of_bed'] }} giường -
                                    tối
                                    đa {{ $item['room_capacity']['max_capacity'] }} người</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mt-5">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div id="category-table_filter" class="dataTables_filter">
                        </div>
                        <div id="category-table_filter" class="dataTables_filter">
                            <button data-target="#modal-checkout" wire:click='export' data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-print"></i> In danh sách</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive" style="overflow: auto">
                        <table class="table table-striped table-sm table-bordered dataTable no-footer" cellspacing="0"
                            width="100%" role="grid" aria-describedby="category-table_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th style="width:100px">#</th>
                                    <th style="width:100px">Người đặt</th>
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
                                    <th style="width:120px">Loại đặt</th>
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
                                            {{ $item['customer']['name'] }}
                                        </td>
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
                                        <td scope="col" class="text-center align-middle ">
                                            {{ StatusBookingEnum::getName($item['status']) }}
                                        </td>
                                        <td class="text-center" style="padding: 20px 0px 13px 0px;">
                                            @if ($item['status'] == StatusBookingEnum::ACTIVE || $item['status'] == StatusBookingEnum::PENDING)
                                                <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['room']['id'], 'bookingid' => $item['id']]) }}"
                                                    class="btn btn-success btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Chi tiết">Vào
                                                    thao tác</a>
                                            @else
                                                <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['room']['id'], 'bookingid' => $item['id']]) }}"
                                                    class="btn btn-warning btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Chi tiết">Xem
                                                    chi tiết</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-12">
                        @if (count($listBooking) > 0)
                            {{ $listBooking->links() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>

        {{-- modal checkout --}}
        <div class="form-group row pt-4">
            <div wire:ignore.self class="modal fade modal-info" id="modal-create" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm mới thông tin khách hàng</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row mb-4">
                                        <label for="sell_date" class="col-2 col-form-label ">Code</label>
                                        <div class="col-10">
                                            <input type="text" id="cccd" class="form-control"
                                                wire:model.lazy="customerCode">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="customer_name" class="col-2 col-form-label ">Họ tên
                                            KH</label>
                                        <div class="col-10">
                                            <input name="customer_name" type="text" class="form-control"
                                                wire:model.lazy="customerName">
                                            @error('customerName')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="customer_phone" class="col-2 col-form-label ">Điện
                                            thoại</label>
                                        <div class="col-10">
                                            <input name="customer_phone" type="text" class="form-control"
                                                wire:model.lazy="customerPhone">
                                            @error('customerPhone')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group row mb-4">
                                        <label for="sell_date" class="col-2 col-form-label ">Số
                                            CMTND/CCCD</label>
                                        <div class="col-10">
                                            <input type="text" id="cccd" class="form-control"
                                                wire:model.lazy="customerCmtnd">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="customer_sex" class="col-2 col-form-label ">Giới
                                            tính</label>
                                        <div class="col-10">
                                            <select name="customer_sex" type="text"class="form-control"
                                                wire:model.lazy="customerSex">
                                                <option value="">--Giới tính--</option>
                                                <option value="1" {{ $sex = 1 ? 'selected' : '' }}>Nam
                                                </option>
                                                <option value="2" {{ $sex = 2 ? 'selected' : '' }}>Nữ
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="customer_address" class="col-2 col-form-label ">Địa
                                            chỉ</label>
                                        <div class="col-10">
                                            <input name="customer_address" type="text" class="form-control"
                                                wire:model.lazy="customerAddress">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row mb-4">
                                        <label for="province_id" class="col-2 col-form-label ">Tỉnh/TP</label>
                                        <div class="col-10">
                                            <select id="province_id" name="province_id"
                                                class="form-control select2-box" wire:model.lazy="customerCity">
                                                <option value="">--Chọn thành phố--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="district_id" class="col-2 col-form-label ">Quận/Huyện</label>
                                        <div class="col-10">
                                            <select id="district_id" name="district_id"
                                                class="form-control select2-box" wire:model.lazy="customerDistrict">
                                                <option value="">--Chọn Quận/ Huyện--</option>

                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                wire:click="create">Lưu</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('js')
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    $('#customer').on('change', function(e) {
                        var data = $('#customer').select2("val");
                        @this.set('customer', data);
                    });
                })
            </script>
        @endsection
