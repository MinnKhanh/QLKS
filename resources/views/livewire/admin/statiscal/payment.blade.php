@php
    use App\Enum\EMotorbike;
    use App\Enums\TypeBooking;
    use App\Enums\TypeTimeEnum;
    use App\Enums\StatusBookingEnum;
    use App\Enums\StatusPayment;
@endphp
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .row {
            margin: 0px;
        }

        .col-form-label {
            padding-right: 0px !important;
        }

        .mdal-info {
            padding-right: 0;
        }

        .modal-info>.modal-dialog {
            max-width: 100% !important;
        }

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
                            <option selected value='0'>--Chọn--</option>
                            @forelse ($listCustomer as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số điện thoại</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="phone" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số cmtnd</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="cmtnd" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Ngày tạo</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="dateCreate" type="date" class="form-control">
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Tháng</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="month" type="number" class="form-control">
                    </div>
                </div>
            </div>
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mt-5">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div id="category-table_filter" class="dataTables_filter">
                        </div>
                        <div id="category-table_filter" class="dataTables_filter">
                            <button wire:click='export' type="button" class="btn btn-outline-primary"><i
                                    class="fa fa-print"></i> In danh sách</button>
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
                                    <th style="width:100px">Điện thoại</th>
                                    <th style="width:100px">CMTND</th>
                                    <th style="width:120px">Ghi chú</th>
                                    <th style="width:120px">Tổng tiền</th>
                                    <th style="width:200px">Trạng thái</th>
                                    <th style="width:200px">Ngày tạo</th>
                                    <th style="width:200px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($listPayMent as $item)
                                    <tr>
                                        <td scope="col" class="text-center align-middle ">{{ $index++ }}</td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['customer']['name'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['phone'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['cmtnd'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['note'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['created_at'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['amount'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ StatusPayment::getName($item['satus']) }}
                                        </td>
                                        <td class="text-center">
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-sm btn-primary rounded-0" type="button"
                                                    data-toggle="modal" data-target="#modal-detail"
                                                    data-toggle="modal"
                                                    wire:click="getListBooking({{ $item['id'] }})"
                                                    data-placement="top" title="Chi tiết">chi
                                                    tiết</button>
                                            </li>
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
                        @if (count($listPayMent) > 0)
                            {{ $listPayMent->links() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal checkout --}}
    <div class="form-group row pt-4">
        <div wire:ignore.self class="modal fade modal-info" id="modal-detail" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mới thông tin khách hàng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
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
