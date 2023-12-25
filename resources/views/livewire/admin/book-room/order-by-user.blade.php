@php
    use App\Enum\EMotorbike;
    use App\Enums\StatusBookingEnum;
    use App\Enums\StatusRoomEnum;
    use App\Enums\TypeTimeEnum;
@endphp
@push('css')
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
            max-width: 80% !important;
        }

        .button-checkout {
            margin-top: 15px;
            text-align: center;
        }

        .header-border {
            padding-top: 20px;
            border-top: 1px solid;
        }
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Thông tin người dùng đang sử dụng phòng</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-3 row align-items-center">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Họ tên khách hàng</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $customerInfo['name'] }}" disabled type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center">
                    <label for="gender" class="col-3 col-form-label pd-0">Giới tính</label>
                    <div class="col-9">
                        <input name="gender" value="{{ $customerInfo['gender'] == 1 ? 'Nam' : 'Nữ' }}" disabled
                            type="text" class="form-control">
                        @error('gender')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số điện thoại</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $customerInfo['phone'] }}" disabled type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số CMTND</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $customerInfo['cmtnd'] }}" disabled type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mt-5">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div id="category-table_filter" class="dataTables_filter">
                            <select style="width:100%;" class="form-control" wire:model="statusBooking"
                                wire:change="changeStatus">
                                @forelse (StatusBookingEnum::getValues() as $item)
                                    <option value="{{ $item }}">{{ StatusBookingEnum::getName($item) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div id="category-table_filter" class="dataTables_filter">
                            @if ($statusBooking == StatusBookingEnum::ACTIVE)
                                <button data-target="#modal-checkout" data-toggle="modal" type="button"
                                    class="btn btn-outline-primary" wire:click="priceAll"><i class="fa fa-money"></i>
                                    Thanh
                                    toán</button>
                            @endif
                            <button data-target="#modal-room" data-toggle="modal" type="button"
                                class="btn btn-outline-primary" wire:click="priceAll"><i class="fa fa-money"></i>
                                Đặt phòng</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-sm table-bordered dataTable no-footer" cellspacing="0"
                            width="100%" role="grid" aria-describedby="category-table_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th style="width:100px">#</th>
                                    <th style="width:100px">Tên phòng</th>
                                    <th style="width:100px">Số người lớn</th>
                                    <th style="width:100px">Số trẻ em</th>
                                    <th style="width:120px">Thời gian</th>
                                    <th style="width:120px">Tiền trả trước</th>
                                    <th style="width:120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($listBooking as $item)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $item['room']['name'] }}</td>
                                        <td>{{ $item['number_of_adults'] }}</td>
                                        <td>{{ $item['number_of_children'] }}</td>
                                        <td>{{ $item['checkin_date'] }}&nbsp @if ($item['type_time'] == TypeTimeEnum::DAY)
                                                đến &nbsp{{ $item['checkout_date'] }}
                                            @else
                                                :&nbsp{{ $item['rental_time'] . ' ' . TypeTimeEnum::getName($item['type_time']) }}
                                            @endif
                                        </td>
                                        <td>{{ $item['deposit'] }}</td>
                                        <td class="text-center">
                                            <li class="list-inline-item icon-trash">
                                                <a class="btn btn-primary btn-sm rounded-0"
                                                    href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['room']['id'], 'bookingid' => $item['id']]) }}"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Thanh toán"><i class="fa fa-money"></i></a>
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-warning btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Thanh toán"><i
                                                        class="fa fa-print"></i></button>
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                    data-target="#modal-checkout" data-toggle="modal"
                                                    data-toggle="tooltip" data-placement="top" title="Xóa"><i
                                                        class="fa fa-trash"></i></button>
                                            </li>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="7">Trống</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        {{-- modal service --}}
        <div class="form-group row pt-4">
            <div wire:ignore.self class="modal fade modal-info" id="modal-checkout" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Danh sách dịch vụ</h5>
                        </div>
                        <div class="modal-body">
                            <h5 class="border-bottom-1 mb-4 font-weight-bold">Thông tin phòng
                            </h5>
                            @if ($statusBooking == StatusBookingEnum::ACTIVE)
                                @foreach ($listBooking as $item)
                                    <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card p-2">
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <div class="col-4">
                                                                <p><span class="font-weight-bold">Tên phòng:</span>
                                                                    {{ $item['room']['name'] }}</p>
                                                                <p><span class="font-weight-bold">Giá phòng</span>:
                                                                    {{ $item->room->priceOfRoom($item['type_time']) }}
                                                                </p>
                                                                <p><span class="font-weight-bold">Ngày vào:</span>
                                                                    {{ $item['checkin_date'] }}</p>
                                                            </div>
                                                            <div class="col-4">
                                                                <p><span class="font-weight-bold">Thuê theo:</span>
                                                                    {{ TypeTimeEnum::getName($item['type_time']) }}
                                                                </p>
                                                                <p><span class="font-weight-bold">Số
                                                                        {{ TypeTimeEnum::getName($item['type_time']) }}
                                                                        thuê: </span> {{ $item['rental_time'] }}</p>
                                                                <p><span class="font-weight-bold">Ngày ra:</span>
                                                                    {{ $item['checkout_date'] }}</p>
                                                            </div>

                                                            <div class="col-4">
                                                                <p><span class="font-weight-bold">Giá thuê:</span>
                                                                    {{ $listPrice[$item['id']]['total_price'] }}
                                                                </p>
                                                                <p><span class="font-weight-bold">Phụ phí: </span>
                                                                    {{ $listPrice[$item['id']]['price_late'] + $listPrice[$item['id']]['price_early'] }}
                                                                </p>
                                                                <p><span class="font-weight-bold">Phí dịch
                                                                        vụ:</span>
                                                                    {{ $listPrice[$item['id']]['service'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div id="category-table_filter" class="dataTables_filter button-checkout">
                                <button type="button" class="btn btn-secondary" wire:click="checkOutAll">In Hóa
                                    đơn</button>
                                @if ($isCheckOut)
                                    <button type="button" class="btn btn-secondary" wire:click="checkOutAll">
                                        Thanh
                                        toán</button>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal service --}}
        <div class="form-group row pt-4">
            <div wire:ignore.self class="modal fade modal-info" id="modal-room" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Danh sách phòng có thể đặt</h5>
                        </div>
                        <div class="modal-body">
                            <h5 class="border-bottom-1 mb-4 font-weight-bold">Phòng
                            </h5>
                            <table class="table table-striped table-sm table-bordered dataTable no-footer"
                                cellspacing="0" width="100%" role="grid" aria-describedby="category-table_info"
                                style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width:100px">#</th>
                                        <th style="width:100px">Tên phòng</th>
                                        <th style="width:100px">Sức chứa</th>
                                        <th style="width:120px">Loại phòng</th>
                                        <th style="width:100px">Giá phòng</th>
                                        <th style="width:120px">Action</th>
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
                                            <td>{{ $item['capacity']['name'] }}</td>
                                            <td>1</td>
                                            <td class="text-center">
                                                <li class="list-inline-item icon-trash">
                                                    <button class="btn btn-warning btn-sm rounded-0" type="button"
                                                        data-toggle="tooltip" data-placement="top"
                                                        wire:click="addRoom({{ $item['id'] }})"
                                                        title="Thanh toán"><i class="fa fa-plus"></i></button>
                                                </li>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">Trống</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($roomActive)

                                <div id="category-table_filter" class="dataTables_filter button-checkout">
                                    <h5 class="col-12 text-center border-top-1 mb-4 font-weight-bold header-border">
                                        Phòng: {{ $roomActive['name'] }}
                                    </h5>
                                    <input type="hidden" id="idRoom" wire:model="idRoom">
                                    <div class="row">
                                        <div class="col-4 row align-items-center">
                                            <label for="customer_name" class="col-3 col-form-label pd-0">Trạng
                                                thái</label>
                                            <div class="col-9">
                                                <select wire:model="typeBooking" style="width: 100%;"
                                                    class="custom-select">
                                                    <option value="">--Chọn--</option>
                                                    <option value="1">Tạo ngay</option>
                                                    <option value="2">Đặt trước</option>
                                                </select>
                                                @error('typePrice')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 row align-items-center">
                                            <label for="customer_name" class="col-3 col-form-label pd-0">Loại thời
                                                gian</label>
                                            <div class="col-9">
                                                <select wire:model="typeTime" style="width: 100%;" id="typeTime"
                                                    class="custom-select">
                                                    <option value="">--Chọn--</option>
                                                    <option value="1">Ngày</option>
                                                    <option value="2">Đêm</option>
                                                    <option value="3">Giờ</option>
                                                </select>
                                                @error('typePrice')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 row align-items-center">
                                            <label for="customer_name" class="col-3 col-form-label pd-0">Giá
                                                phòng</label>
                                            <div class="col-9">
                                                <input name="customer_name" value="{{ $price }}"
                                                    type="text" class="form-control">
                                                @error('customer')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 row align-items-center mb-5">
                                        <label class="col-5 col-form-label text-right ">Thời gian vào</label>
                                        <div class="col-7 row">
                                            <div class="col-12 pr-0">
                                                <input type="date" wire:model.lazy="fromDateTime"
                                                    id="fromDateTime" wire:change="changeFromAndToDateTime"
                                                    class="form-control">
                                                @error('fromDateTime')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if ($typeTime == TypeTimeEnum::DAY)
                                        <div class="col-lg-3 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Thời
                                                gian
                                                ra</label>
                                            <div class="col-7">
                                                <input wire:model.lazy="toDateTime" id="toDateTime"
                                                    wire:change="changeFromAndToDateTime" type="date"
                                                    class="form-control">
                                                @error('toDateTime')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-3 row align-items-center mb-5">
                                        <label for="searchStatus" class="col-7 col-form-label text-right">Thời gian
                                            thuê
                                            phòng
                                            (Đêm/Giờ)</label>
                                        <div class="col-5">
                                            <input wire:model.lazy="rentalTime" wire:change="changeRentalTime"
                                                type="number" class="form-control"
                                                {{ $typeTime == TypeTimeEnum::NIGHT ? 'disabled' : '' }}>
                                            @error('rentalTime')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-3 row align-items-center mb-5">
                                        <label class="col-2 col-form-label text-right ">Giờ vào</label>
                                        <div class="col-6 row mr-1">
                                            <div class="col-12 pr-0">
                                                <input type="time" wire:model.lazy="hourIn" class="form-control">
                                                @error('fromDateTime')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="button" wire:click="getCurrentTime"
                                            class="col-3 btn btn-secondary" style="font-size: 12px;">nhập</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 row align-items-center mb-5">
                                        <label for="searchStatus" class="col-3 col-form-label text-right">Số người
                                            lớn</label>
                                        <div class="col-9">
                                            <input wire:model.lazy="numberOfAdults" type="number"
                                                class="form-control">
                                            @error('numberOfPeople')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 row align-items-center mb-5">
                                        <label for="searchStatus" class="col-3 col-form-label text-right">Số trẻ
                                            em</label>
                                        <div class="col-9">
                                            <input wire:model.lazy="numberOfChildren" type="number"
                                                class="form-control">
                                            @error('numberOfPeople')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 row align-items-center mb-5">
                                        <label for="searchStatus" class="col-3 col-form-label text-right">Tiền trả
                                            trước</label>
                                        <div class="col-9">
                                            <input wire:model.lazy="deposit" type="number" class="form-control">
                                            @error('deposit')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center row align-items-center mb-5">
                                    <button type="button" class="col-3 btn btn-secondary" style="font-size: 12px;"
                                        wire:click="create">Vào</button>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('change', '#typeTime', function(e) {
                console.log('ddd', $('#typeTime').val());
                var data = $('#typeTime').val();
                @this.set('typeTime', data);
                window.livewire.emit('updatePrice');
                window.livewire.emit('updateTypeTime');
            });

            function startChange() {
                window.livewire.emit('setfromDate', {
                    ['fromDateTime']: start.value()
                });
                if ($("#toDateTime").length) {
                    var startDate = start.value(),
                        endDate = end.value();
                    if (startDate) {
                        startDate = new Date(startDate);
                        startDate.setDate(startDate.getDate());
                        end.min(startDate);
                    } else if (endDate) {
                        start.max(new Date(endDate));
                    } else {
                        endDate = new Date();
                        start.max(endDate);
                        end.min(endDate);
                    }
                }
            }

            function endChange() {
                var endDate = end.value(),
                    startDate = start.value();
                window.livewire.emit('settoDate', {
                    ['toDateTime']: endDate
                });
                if (endDate) {
                    endDate = new Date(endDate);
                    endDate.setDate(endDate.getDate());
                    start.max(endDate);
                } else if (startDate) {
                    end.min(new Date(startDate));
                } else {
                    endDate = new Date();
                    start.max(endDate);
                    end.min(endDate);
                }
            }

            function compareDates(date, dates) {
                for (var i = 0; i < dates.length; i++) {
                    if (date >= dates[i][0] && date <= dates[i][1]) {
                        return true
                    }
                }
            }
            if ($("#checkOutDateTime").length) {
                var start = $("#fromDateTime").kendoDatePicker({
                    change: startChange,
                    dates: dates,
                    disableDates: function(date) {
                        var dates = $("#fromDateTime").data("kendoDatePicker").options.dates;
                        if (date && compareDates(date, dates)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }).data("kendoDatePicker");
            }
            if ($("#checkOutDateTime").length) {
                var end = $("#toDateTime").kendoDatePicker({
                    change: endChange,
                    dates: dates,
                    disableDates: function(date) {
                        var dates = $("#fromDateTime").data("kendoDatePicker").options.dates;
                        if (date && compareDates(date, dates)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }).data("kendoDatePicker");
                start.max(end.value());
                end.min(start.value());
            }
            window.addEventListener('setDatePicker', event => {
                console.log($("#toDateTime").length);
                let id = parseInt($('#idRoom').val())
                let dates = {{ Js::from($dates) }}[id]
                if (dates)
                    dates = dates.map(element => {
                        return [new Date(element[0]), new Date(element[1])]
                    });
                console.log(dates);

                function startChange() {
                    window.livewire.emit('setfromDate', {
                        ['fromDateTime']: start.value()
                    });
                    if ($("#toDateTime").length) {
                        var startDate = start.value(),
                            endDate = end.value();
                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate());
                            end.min(startDate);
                        } else if (endDate) {
                            start.max(new Date(endDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }
                }

                function endChange() {
                    var endDate = end.value(),
                        startDate = start.value();
                    window.livewire.emit('settoDate', {
                        ['toDateTime']: endDate
                    });
                    if (endDate) {
                        endDate = new Date(endDate);
                        endDate.setDate(endDate.getDate());
                        start.max(endDate);
                    } else if (startDate) {
                        end.min(new Date(startDate));
                    } else {
                        endDate = new Date();
                        start.max(endDate);
                        end.min(endDate);
                    }
                }
                if ($("#fromDateTime").length) {
                    var start = $("#fromDateTime").kendoDatePicker({
                        change: startChange,
                        dates: dates,
                        disableDates: function(date) {
                            var dates = $("#fromDateTime").data("kendoDatePicker").options
                                .dates;
                            if (date && compareDates(date, dates)) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }).data("kendoDatePicker");
                }
                if ($("#toDateTime").length) {
                    var end = $("#toDateTime").kendoDatePicker({
                        change: endChange,
                        dates: dates,
                        disableDates: function(date) {
                            var dates = $("#fromDateTime").data("kendoDatePicker").options
                                .dates;
                            if (date && compareDates(date, dates)) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }).data("kendoDatePicker");
                    start.max(end.value());
                    end.min(start.value());
                }
            });

        })
    </script>
@endsection
