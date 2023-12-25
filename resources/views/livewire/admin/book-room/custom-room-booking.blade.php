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
            max-width: 60% !important;
        }
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Thông tin trạng thái phòng</div>
        </div>
        <div class="ibox-body">
            <div class="row mb-5">
                {{-- <div class="col-3 row">
                    <label for="status" class="col-5 col-form-label pd-0">Trạng thái phòng</label>
                    <div class="col-7">
                        <select id="" wire:model='statusRoom' style="width:100%;" class="form-control"
                            disabled>
                            @foreach (StatusRoomEnum::getValues() as $item)
                                <option value="{{ $item }}">{{ StatusRoomEnum::getName($item) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                {{-- <div class="col-3 row">
                    <label for="status" class="col-5 col-form-label pd-0">Trạng thái hóa đơn</label>
                    <div class="col-7">
                        <select id="" wire:model='statusBooking' style="width:100%;" class="form-control">
                            @foreach (StatusBookingEnum::getValues() as $item)
                                <option value="{{ $item }}">{{ StatusBookingEnum::getName($item) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <label for="status" class="col-12 col-form-label pd-0 d-flex align-items-center">
                    <h5 class="mb-0">Trạng thái phòng:&nbsp;</h5>
                    {{ StatusRoomEnum::getName($statusRoom) }}&nbsp;-&nbsp;<h5 class="mb-0">Hóa đơn:&nbsp;</h5>
                    {{ $isCheckout ? 'Đã thanh toán' : StatusBookingEnum::getName($statusBooking) }}
                </label>
                {{-- <div class="col-3">
                    <button wire:click="changeStatus" type="button" class="btn btn-outline-primary mt-2"><i
                            class="fa fa-disk"></i> Kết chuyển</button>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-2 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Mã phòng</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $roomInfo['code'] }}" type="text" disabled
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-2 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Tên phòng</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $roomInfo['name'] }}" type="text" disabled
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-2 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Tầng</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $roomInfo['floor']['name'] }}" type="text" disabled
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6 row align-items-center mb-5">
                    <label for="customer_name" class="col-2 col-form-label pd-0">Loại phòng</label>
                    <div class="col-10">
                        <input name="customer_name" type="text"
                            value="{{ $roomInfo['type']['type_room']['name'] . ',' . $roomInfo['type']['room_capacity']['name'] . ',' . $roomInfo['type']['room_capacity']['number_of_bed'] . ' giường' . ', Sức chứa tối đa ' . $roomInfo['type']['room_capacity']['max_capacity'] . ' người' }}"
                            disabled class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Họ tên khách hàng</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $customerInfo['name'] }}" disabled type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số điện thoại</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $customerInfo['phone'] }}" disabled type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center mb-5">
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

            <div class="row">
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Loại thời gian</label>
                    <div class="col-9">
                        <select wire:model="typeTime" wire:change="changeTypeTime" style="width: 100%;" id="typeTime"
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
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Giá phòng</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $price }}" type="text" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Phụ phí (sớm)</label>
                    <div class="col-9">
                        <input name="customer_name" value="{{ $earlySurcharge }}" type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Phụ phí (muộn)</label>
                    <div class="col-9">
                        <input name="customer_name" type="text" value="{{ $lateSurcharge }}"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Ngày CheckIn</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model.lazy="checkInDateTime" id="checkInDateTime"
                            wire:change="changeFromAndToDateTime" type="date" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if ($typeTime == TypeTimeEnum::DAY)
                    <div class="col-3 row align-items-center mb-5">
                        <label for="customer_name" class="col-3 col-form-label pd-0">Ngày CheckOut</label>
                        <div class="col-9">
                            <input name="customer_name" wire:model="checkOutDateTime" id="checkOutDateTime"
                                {{ $typeTime == TypeTimeEnum::HOUR ? 'disabled' : '' }}
                                wire:change="changeFromAndToDateTime" type="date" class="form-control">
                            @error('customer')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Thời gian thuê</label>
                    <div class="col-7">
                        <input name="customer_name" wire:model="rentalTime"
                            {{ $typeTime == TypeTimeEnum::NIGHT ? 'disabled' : '' }} wire:change="changeRentalTime"
                            type="text" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label for="customer_name" class="col-2 col-form-label pd-0">Đêm/Giờ</label>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="deposit" class="col-4 col-form-label pd-0">Tiền đã trả(tiền cọc)</label>
                    <div class="col-6">
                        <input name="deposit" wire:model="deposit" type="text" class="form-control">
                        @error('deposit')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 row align-items-center mb-5">
                    <label class="col-4 col-form-label text-right ">Giờ vào</label>
                    <div class="col-8 row">
                        <div class="col-12 pr-0">
                            <input type="time" wire:model.lazy="hourIn" class="form-control">
                            @error('hourIn')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 row align-items-center mb-5">
                    <label class="col-2 col-form-label text-right ">Giờ ra</label>
                    <div class="col-6 row mr-1">
                        <div class="col-12 pr-0">
                            <input type="time" wire:model.lazy="hourOut" class="form-control">
                            @error('hourOut')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="button" wire:click="getCurrentTime" class="col-3 btn btn-secondary"
                        style="font-size: 12px;" data-dismiss="modal">nhập</button>
                </div>
                <div class="col-3 mt-2">
                    <div id="category-table_filter" class="dataTables_filter">
                        <button wire:click="update" type="button" class="btn btn-outline-primary"
                            {{-- {{ $statusBooking == StatusBookingEnum::ACTIVE ? '' : 'disabled' }} --}} {{ $isCheckout ? 'disabled' : '' }}><i class="fa fa-disk"></i> Cập
                            nhật thông
                            tin</button>
                    </div>
                </div>
            </div>
            @if ($statusBooking == StatusBookingEnum::ACTIVE)
                <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mt-5">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div id="category-table_filter" class="dataTables_filter">
                                <button data-target="#modal-service" data-toggle="modal" type="button"
                                    class="btn btn-outline-primary" {{ $isCheckout ? 'disabled' : '' }}><i
                                        class="fa fa-plus"></i> Thêm dịch vụ</button>
                            </div>
                            <div id="category-table_filter" class="dataTables_filter">
                                <button data-target="#modal-checkout" data-toggle="modal" type="button"
                                    class="btn btn-outline-primary"><i class="fa fa-money"></i> Thanh
                                    toán</button>
                                <button wire:click="cancelRoom" type="button" class="btn btn-outline-primary"><i
                                        class="fa fa-money"></i> Hủy Phòng</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-striped table-sm table-bordered dataTable no-footer"
                                cellspacing="0" width="100%" role="grid" aria-describedby="category-table_info"
                                style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width:100px">#</th>
                                        <th style="width:100px">Tên dịch vụ</th>
                                        <th style="width:100px">Loại dịch vụ</th>
                                        <th style="width:100px">Mô tả</th>
                                        <th style="width:120px">Giá</th>
                                        <th style="width:120px">Số lượng</th>
                                        <th style="width:120px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @forelse ($services as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item['service']['name'] }}</td>
                                            <td>{{ $item['service']['type']['name'] }}</td>
                                            <td>{{ $item['service']['description'] }}</td>
                                            <td>{{ $item['service']['price'] }}</td>
                                            <td><input class="quantity-service" {{ $isCheckout ? 'disabled' : '' }}
                                                    type="text" data-booking-id="{{ $item['booking_id'] }}"
                                                    data-service-id="{{ $item['service_id'] }})"
                                                    value="{{ $item['note'] }}"></td>
                                            <td class="text-center">
                                                <li class="list-inline-item icon-trash">
                                                    <button class="btn btn-danger btn-sm rounded-0"
                                                        wire:click="deleteService({{ $item['booking_id'] }},{{ $item['service_id'] }})"
                                                        {{ $isCheckout ? 'disabled' : '' }} type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                            class="fa fa-trash"></i></button>
                                                </li>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Trống</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-bordered dataTable no-footer" id="category-table"
                            cellspacing="0" width="100%" role="grid" aria-describedby="category-table_info"
                            style="width: 100%;display:block;overflow-x: scroll;white-space: nowrap;">
                            <thead>

                            </thead>
                            <div wire:loading class="loader"></div>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div> --}}

                </div>
            @endif
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-12">
                        <div class="card p-2">
                            <div class="col-12">
                                <h5 class="border-bottom-1 mb-4 font-weight-bold">Thống kê chi phí</h5>
                                <p>Tổng tiền phòng: {{ $totalPrice }}</p>
                                <p>Phí dịch vụ: {{ $totalPriceService }}</p>
                                <p>Phụ phí phát sinh: {{ $priceEarlyChager + $priceLateChager }}</p>
                                <p>Tiền đã trả: {{ $deposit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($isCheckout)
                <div class="d-flex justify-content-center mt-5">
                    <button wire:click="clear" type="button" class="btn btn-outline-primary">Dọn</button>
                </div>
            @elseif($statusBooking == StatusBookingEnum::PENDING)
                <div class="d-flex justify-content-center mt-5">
                    <button wire:click="cancel" type="button" class="btn btn-outline-primary mr-2">Hủy
                        Đặt</button>
                    <button wire:click="accept" type="button" class="btn btn-outline-primary">Nhận Phòng</button>
                </div>
            @endif
        </div>
    </div>
    {{-- modal service --}}
    <div class="form-group row pt-4">
        <div wire:ignore.self class="modal fade modal-info" id="modal-service" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Danh sách dịch vụ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <div class="form-group row">
                                <label for="SerialNumber" class="col-1 col-form-label text-right">Tên dịch
                                    vụ</label>
                                <div class="col-3">
                                    <input name="SerialNumber" type="text" class="form-control">
                                </div>
                                <label for="EngineNumber" class="col-1 col-form-label text-right ">Loại dịch
                                    vụ</label>
                                <div class="col-3">
                                    <input name="EngineNumber" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:100px">Tên dịch vụ</th>
                                    <th style="width:100px">Loại dịch vụ</th>
                                    <th style="width:100px">Mô tả</th>
                                    <th style="width:120px">Giá</th>
                                    <th style="width:120px">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listServices as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['type_service'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td> <a class="btn btn-info btn-xs"
                                                wire:click="addService({{ $item['id'] }})" data-toggle="tooltip"
                                                target="_blank" data-original-title="Xem"><i
                                                    class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Trống</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal checkout --}}
    <div class="form-group row pt-4">
        <div wire:ignore.self class="modal fade modal-info" id="modal-checkout" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông kê chi phí cần thanh toán</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-3">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="border-bottom-1 mb-4 font-weight-bold">Thông tin khách
                                                    hàng</h5>
                                                <p class="fw-bold">Tên khách hàng: {{ $customerInfo['name'] }}</p>
                                                <p>Điện thoại: {{ $customerInfo['phone'] }}</p>
                                                <p>CCCD: {{ $customerInfo['cmtnd'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="border-bottom-1 mb-4 font-weight-bold">Thống kê chi phí
                                                </h5>
                                                <p>Tổng tiền phòng: {{ $totalPrice }}</p>
                                                <p>Phí dịch vụ: {{ $totalPriceService }}</p>
                                                <p>Phụ phí phát sinh: {{ $priceEarlyChager + $priceLateChager }}</p>
                                                <p>Tiền đã trả: {{ $deposit }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="note" class="col-4 col-form-label pd-0">Ghi chú</label>
                                    <div class="col-12">
                                        <textarea name="note" wire:model="note" type="text" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-striped table-sm table-bordered dataTable no-footer"
                                        cellspacing="0" width="100%" role="grid"
                                        aria-describedby="category-table_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th style="width:100px">#</th>
                                                <th style="width:100px">Tên dịch vụ</th>
                                                <th style="width:100px">Loại dịch vụ</th>
                                                <th style="width:100px">Mô tả</th>
                                                <th style="width:120px">Giá</th>
                                                <th style="width:120px">Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 0;
                                            @endphp
                                            @forelse ($services as $item)
                                                <tr>
                                                    <td>{{ $index++ }}</td>
                                                    <td>{{ $item['service']['name'] }}</td>
                                                    <td>{{ $item['service']['type']['name'] }}</td>
                                                    <td>{{ $item['service']['description'] }}</td>
                                                    <td>{{ $item['service']['price'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">Trống</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p>Tổng tiền phải trả:
                                            {{ $totalPrice + $priceEarlyChager + $priceLateChager + $totalPriceService - ($deposit ? $deposit : 0) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    @if (!$isCheckout)
                                        <button type="button" class="btn btn-secondary" wire:click="checkout">Thanh
                                            toán</button>
                                    @endif
                                    @if ($idPayment)
                                        <a href="{{ route('admin.print', ['id' => $idPayment]) }}"
                                            class="btn btn-secondary">In hóa đơn</a>
                                    @endif
                                    {{-- <button type="button" class="btn btn-secondary">In hóa đơn</button> --}}
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
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
            let dates = {{ Js::from($dates) }}
            dates = dates.map(element => {
                return [new Date(element[0]), new Date(element[1])]
            });
            $('#typeTime').on('change', function(e) {
                // var data = $('#typeTime').val();
                // console.log(data)
                // @this.set('typeTime', data);
                window.livewire.emit('updateInfoPirce');
            });
            $(document).on('change', '.quantity-service', function() {
                let quantity = $(this).val();
                let booking_id = $(this).attr('data-booking-id')
                let serviceId = $(this).attr('data-service-id')
                console.log(quantity)
                window.livewire.emit('changeQuantityService', {
                    0: quantity,
                    1: booking_id,
                    2: serviceId
                });
            })

            function startChange() {
                window.livewire.emit('setfromDate', {
                    ['checkInDateTime']: start.value()
                });
                if ($("#checkOutDateTime").length) {
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
                    ['checkOutDateTime']: endDate
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
            var start = $("#checkInDateTime").kendoDatePicker({
                change: startChange,
                dates: dates,
                disableDates: function(date) {
                    var dates = $("#checkInDateTime").data("kendoDatePicker").options.dates;
                    if (date && compareDates(date, dates)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }).data("kendoDatePicker");
            if ($("#checkOutDateTime").length) {
                var end = $("#checkOutDateTime").kendoDatePicker({
                    change: endChange,
                    dates: dates,
                    disableDates: function(date) {
                        var dates = $("#checkOutDateTime").data("kendoDatePicker").options.dates;
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

                function startChange() {
                    window.livewire.emit('setfromDate', {
                        ['checkInDateTime']: start.value()
                    });
                    if ($("#checkOutDateTime").length) {
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
                        ['checkOutDateTime']: endDate
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

                var start = $("#checkInDateTime").kendoDatePicker({
                    change: startChange,
                    dates: dates,
                    disableDates: function(date) {
                        var dates = $("#checkInDateTime").data("kendoDatePicker").options
                            .dates;
                        if (date && compareDates(date, dates)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }).data("kendoDatePicker");
                if ($("#checkOutDateTime").length) {
                    var end = $("#checkOutDateTime").kendoDatePicker({
                        change: endChange,
                        dates: dates,
                        disableDates: function(date) {
                            var dates = $("#checkOutDateTime").data("kendoDatePicker").options
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
