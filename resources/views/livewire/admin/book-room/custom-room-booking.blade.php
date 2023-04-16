@php
    use App\Enum\EMotorbike;
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
            max-width: 98% !important;
        }
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Thông tin trạng thái phòng</div>
        </div>
        <div class="ibox-body">
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
                        <select wire:model="typeTime" id="typeTime" class="custom-select select2-box">
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
                        <input name="customer_name" value="{{ $earlySurcharge }}" type="text" class="form-control">
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
                    <label for="customer_name" class="col-3 col-form-label pd-0">Thời gian thuê</label>
                    <div class="col-7">
                        <input name="customer_name" wire:model="rentalTime" type="text"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label for="customer_name" class="col-2 col-form-label pd-0">Giờ</label>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Ngày CheckIn</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model.lazy="checkInDateTime" type="datetime-local"
                            class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3 ml-5 mt-2">
                    <div id="category-table_filter" class="dataTables_filter">
                        <button wire:click="update" type="button" class="btn btn-outline-primary"><i
                                class="fa fa-disk"></i> Cập nhật thông
                            tin</button>
                    </div>
                </div>
            </div>
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mt-5">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div id="category-table_filter" class="dataTables_filter">
                            <button data-target="#modal-service" data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-plus"></i> Thêm dịch vụ</button>
                        </div>
                        <div id="category-table_filter" class="dataTables_filter">
                            <button data-target="#modal-checkout" data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-money"></i> Thanh
                                toán</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-sm table-bordered dataTable no-footer" cellspacing="0"
                            width="100%" role="grid" aria-describedby="category-table_info"
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
                                        <td>{{ $item['quantity'] }}</td>
                                        <td class="text-center">
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-trash"></i></button>
                                            </li>
                                        </td>
                                    </tr>
                                @empty
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
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-12">
                        <div class="card p-2">
                            <div class="col-12">
                                <h5 class="border-bottom-1 mb-4 font-weight-bold">Thống kê chi phí</h5>
                                <p class="fw-bold">Tên khách hàng: </p>
                                <p>Tiền phòng: {{ $totalPrice }}</p>
                                <p>Phí dịch vụ: {{ $totalPriceService }}</p>
                                <p>Phụ phí phát sinh: {{ $priceEarlyChager + $priceLateChager }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                @foreach ($listServices as $item)
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
                                @endforeach
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
                                    <div class="row flex-column">
                                        <div class="col-12">
                                            <div class="card p-2">
                                                <div class="col-12">
                                                    <h5 class="border-bottom">Thông tin khách hàng</h5>
                                                    <p class="fw-bold">Tên khách hàng: </p>
                                                    <p>Điện thoại: </p>
                                                    <p>CCCD: </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
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
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#SupplyName').on('change', function(e) {
                var data = $('#SupplyName').select2("val");
                @this.set('searchSupplier', data);
            });
            $('#searchStatus').on('change', function(e) {
                var data = $('#searchStatus').select2("val");
                @this.set('searchStatus', data);
            });
            $('#seachWarehouse').on('change', function(e) {
                var data = $('#seachWarehouse').select2("val");
                @this.set('seachWarehouse', data);
            });
        })
    </script>
@endsection
