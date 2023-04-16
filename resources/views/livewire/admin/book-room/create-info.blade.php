@php
    use App\Enum\EMotorbike;
    use App\Enums\StatusRoomEnum;
@endphp
@push('css')
    <style>
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
            <div class="ibox-title">Thông tin đặt phòng</div>
        </div>
        <div class="ibox-body pt-0">
            <div>
                <div class="row mb-5">
                    <div class="col-12 font-weight-bold border bg-light p-3">Thông tin khách hàng</div>
                </div>
                @if ($customer)
                    <div class="form-group row">
                        <label for="SerialNumber" class="col-1 col-form-label text-right">Mã Khách hàng</label>
                        <div class="col-3">
                            <input wire:model="customer_code" type="text" class="form-control">
                        </div>
                        <label for="EngineNumber" class="col-1 col-form-label text-right ">Số CMTND</label>
                        <div class="col-3">
                            <input type="text" wire:model="customer_cmtnd" class="form-control">
                        </div>
                        <label for="Model" class="col-1 col-form-label text-right ">Tên khách hàng</label>
                        <div class="col-3">
                            <input type="text" wire:model="customer_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <label for="Model" class="col-1 col-form-label text-right ">Số điện thoại</label>
                        <div class="col-3">
                            <input type="text" wire:model="customer_phone" class="form-control">
                        </div>
                    </div>
                @else
                @endif
                <div class="row mb-5 mt-5">
                    <div class="col-12 text-center">
                        <div>
                            <button type="button" data-target="#modal-customer" data-toggle="modal"
                                class="btn btn-warning">chọn khách hàng trong danh
                                sách</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12 font-weight-bold border bg-light p-3">Thông tin phòng</div>
                </div>
                <div class="form-group row">
                    <label for="SerialNumber" class="col-1 col-form-label text-right">Mã phòng</label>
                    <div class="col-3">
                        <input value="{{ $room['code'] }}" disabled type="text" class="form-control">
                    </div>
                    <label for="EngineNumber" class="col-1 col-form-label text-right ">Tên phòng</label>
                    <div class="col-3">
                        <input value="{{ $room['name'] }}" disabled type="text" class="form-control">
                    </div>
                    <label for="Model" class="col-1 col-form-label text-right ">Tầng</label>
                    <div class="col-3">
                        <input value="{{ $room['floor']['name'] }}" disabled type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label text-right">Loại thời gian</label>
                    <div class="col-2">
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
                    <label class="col-1 col-form-label text-right ">Giá phòng</label>
                    <div class="col-2">
                        <input wire:model.lazy="price" type="text" class="form-control">
                        @error('price')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label class="col-1 col-form-label text-right ">Phụ phí (sớm)</label>
                    <div class="col-2">
                        <input wire:model.lazy="earlySurcharge" type="number" class="form-control">
                        @error('earlySurcharge')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label class="col-1 col-form-label text-right ">Phụ phí (muộn)</label>
                    <div class="col-2">
                        <input wire:model.lazy="lateSurcharge" type="number" class="form-control">
                        @error('lateSurcharge')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-12 font-weight-bold border bg-light p-3">Thông tin nhận phòng</div>
                </div>
                <div class="d-flex row">
                    <label class="col-1 col-form-label text-right ">Giờ vào</label>
                    <div class="col-3 row">
                        <div class="col-12 pr-0">
                            <input type="datetime-local" wire:model.lazy="fromDateTime" class="form-control">
                            @error('fromDateTime')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-2 justify-content-center align-items-center">
                            <p class="text-center pt-2">～</p>
                        </div>
                        <div class="col-5">
                            <input wire:model.lazy="toDateTime" type="datetime-local" class="form-control">
                            @error('toDateTime')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                    </div>
                    <label for="searchStatus" class="col-1 col-form-label text-right">Số người</label>
                    <div class="col-2">
                        <input wire:model.lazy="numberOfPeople" type="number" class="form-control">
                        @error('numberOfPeople')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label for="searchStatus" class="col-2 col-form-label text-right">Thời gian thuê phòng
                        (Đêm/Ngày/Giờ)</label>
                    <div class="col-3">
                        <input wire:model.lazy="rentalTime" type="number" class="form-control">
                        @error('rentalTime')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- <label for="searchStatus" class="col-1 col-form-label text-right">Trạng thái phòng</label>
                    <div class="col-3">
                        <select wire:model="statusRoom" id="seachWarehouse" class="form-control">
                            <option value="">--Chọn--</option>
                            <option value="1">Khách đặt trước</option>
                            <option value="2">Đang có khách</option>
                            <option value="3">Trống</option>
                            <option value="4">Đang sửa</option>
                            <option value="5">Chưa dọn</option>
                        </select>
                    </div> --}}
            </div>
            <div class="form-group row mt-5">
                <label for="Color" class="col-1 col-form-label text-right ">Ghi chú</label>
                <div class="col-11">
                    <textarea wire:model.lazy="note" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row mt-5 mb-5">
                <div class="ml-5 col-12 text-center">
                    <button type="button" wire:click="create" class="btn btn-warning add-new"><i
                            class="fa fa-plus mr-2"></i>Xác nhận</button>
                </div>
            </div>
        </div>
        {{-- <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="category-table_filter" class="dataTables_filter">
                            <button name="submit" type="submit" class="btn btn-warning add-new"><i
                                    class="fa fa-plus"></i> Thêm mới</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-sm table-bordered dataTable no-footer"
                            id="category-table" cellspacing="0" width="100%" role="grid"
                            aria-describedby="category-table_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" wire:click="sorting('code')" style="width: 7%;">#
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('name')">Loại phòng
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('address')">Sức chứa
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('address')">Giá
                                        phòng
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('phone')">Phụ phí
                                        thêm mỗi giờ (muộn)</th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 7%;" wire:click="sorting('birthday')">Phụ phí
                                        thêm mỗi giờ (sớm)</th>
                                    <th tabindex="0" aria-controls="category-table" rowspan="1" colspan="1"
                                        style="width: 7%;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> --}}
        {{-- <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <button type="button" data-target="#modal-service" data-toggle="modal"
                                class="btn btn-warning" {{ $status == 1 ? '' : 'disabled' }}><i
                                    class="fa fa-plus"></i>
                                Thêm
                                dịch vụ</button>
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
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" wire:click="sorting('code')" style="width: 7%;">#
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('name')">Loại phòng
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('address')">Sức chứa
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('address')">Giá
                                        phòng
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 10%;" wire:click="sorting('phone')">Phụ phí
                                        thêm mỗi giờ (muộn)</th>
                                    <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                        colspan="1" style="width: 7%;" wire:click="sorting('birthday')">Phụ phí
                                        thêm mỗi giờ (sớm)</th>
                                    <th tabindex="0" aria-controls="category-table" rowspan="1" colspan="1"
                                        style="width: 7%;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> --}}

        <div class="form-group row pt-4">

            <div wire:ignore.self class="modal fade modal-info" id="modal-customer" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Danh sách khách hàng</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-5">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
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
                                        <div class="form-group row">
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
                                        <div class="form-group row">
                                            <label for="sell_date" class="col-2 col-form-label ">Số
                                                CMTND/CCCD</label>
                                            <div class="col-10">
                                                <input type="text" id="cccd" class="form-control"
                                                    wire:model.lazy="customerCmtnd">
                                            </div>
                                        </div>

                                        <div class="form-group row">
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
                                        <div class="form-group row">
                                            <label for="customer_age" class="col-2 col-form-label ">Quốc
                                                gia</label>
                                            <div class="col-10">
                                                <input name="country" type="text" class="form-control"
                                                    wire:model.lazy="customerCountry">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="customer_address" class="col-2 col-form-label ">Địa
                                                chỉ</label>
                                            <div class="col-10">
                                                <input name="customer_address" type="text" class="form-control"
                                                    wire:model.lazy="customerAddress">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="province_id" class="col-2 col-form-label ">Tỉnh/TP</label>
                                            <div class="col-10">
                                                <select id="province_id" name="province_id"
                                                    class="form-control select2-box" wire:model.lazy="customerCity">
                                                    <option value="">--Chọn thành phố--</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="district_id"
                                                class="col-2 col-form-label ">Quận/Huyện</label>
                                            <div class="col-10">
                                                <select id="district_id" name="district_id"
                                                    class="form-control select2-box"
                                                    wire:model.lazy="customerDistrict">
                                                    <option value="">--Chọn Quận/ Huyện--</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="sell_date" class="col-2 col-form-label ">Ngày
                                                sinh</label>
                                            <div class="col-10">
                                                <input type="date" id="birth_day" class="form-control"
                                                    max='{{ date('Y-m-d') }}' wire:model.lazy="customerBirthDay">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 row d-flex mt-5 justify-content-center">
                                        <button type="button" wire:click="createCustomer"
                                            class="btn btn-warning add-new"><i class="fa fa-plus mr-2"></i>Thêm
                                            mới</button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:100px">Nhận</th>
                                        <th style="width:100px">Tên khách hàng</th>
                                        <th style="width:100px">Địa chỉ</th>
                                        <th style="width:100px">Thành phố</th>
                                        <th style="width:120px">Tỉnh</th>
                                        <th style="width:50%">CCCD</th>
                                        <th style="width:30%">Số điện thoại</th>
                                        <th style="width:200px">Giới tính</th>
                                        <th style="width:200px">Quốc gia</th>
                                        <th style="width:200px">Ngày sinh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($listCustomer as $item)
                                        <tr>
                                            <td style="width:100px"><button type="button"
                                                    class="btn btn-warning add-new" data-dismiss="modal"
                                                    wire:click="addCustomer({{ $item['id'] }})">Chọn</button>
                                            </td>
                                            <td style="width:100px">{{ $item['name'] }}</td>
                                            <td style="width:100px">{{ $item['address'] }}</td>
                                            <td style="width:100px">{{ $item['city'] }}</td>
                                            <td style="width:120px">{{ $item['district'] }}</td>
                                            <td style="width:50%">{{ $item['cmtnd'] }}</td>
                                            <td style="width:30%">{{ $item['phone'] }}</td>
                                            <td style="width:200px">{{ $item['gender'] }}</td>
                                            <td style="width:200px">{{ $item['country'] }}</td>
                                            <td style="width:200px">{{ $item['birth_day'] }}</td>
                                        </tr>
                                    @empty
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
    </div>
</div>
</div>
@section('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#typeTime').on('change', function(e) {
                var data = $('#typeTime').select2("val");
                @this.set('typeTime', data);
                window.livewire.emit('updatePrice');
            });
        })
    </script>
@endsection
