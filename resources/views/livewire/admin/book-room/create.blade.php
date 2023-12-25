@php
    use App\Enum\EMotorbike;
@endphp

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Thông tin Loại phòng</div>
        </div>
        <div class="ibox-body">
            <form>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="customer_name" class="col-2 col-form-label ">Họ tên KH</label>
                            <div class="col-10">

                                <input name="customer_name" type="text" class="form-control"
                                    wire:model.lazy="customer_name">
                                {{-- <div wire:ignore>
                                    <select name='customerPhone' id="customerPhone"
                                        data-ajax-url="{{ route('customers.getCustomerByPhoneOrNameWithId.index') }}"
                                        class="custom-select">
                                    </select>
                                </div> --}}

                                {{-- <select id="customer" name="customer" {{ $disabled_customer ? 'disabled' : '' }}
                                    wire:model.lazy="customer" class="custom-select select2-box form-control">
                                    <option value="">--- Chọn khách hàng ---</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->name . ' - ' . $customer->phone }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                @error('customer')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_phone" class="col-2 col-form-label ">Điện thoại</label>
                            <div class="col-10">
                                <input name="customer_phone" type="text" class="form-control"
                                    onkeypress="return onlyNumberKey(event)" wire:change="onChangeCustomerPhone"
                                    wire:model.lazy="customer_phone">
                                @error('customer_phone')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sell_date" class="col-2 col-form-label ">Số CCCD</label>
                            <div class="col-10">
                                <input type="text" id="cccd" class="form-control" wire:model.lazy="cccd">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_sex" class="col-2 col-form-label ">Giới tính</label>
                            <div class="col-10">
                                <select name="customer_sex" type="text"class="form-control"
                                    wire:model.lazy="customer_sex">
                                    <option value="">--Giới tính--</option>
                                    <option value="1" {{ $sex = 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="2" {{ $sex = 2 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_age" class="col-2 col-form-label ">Tuổi</label>
                            <div class="col-10">
                                <input name="customer_age" maxlength="3" type="number" class="form-control"
                                    onkeypress="return onlyNumberKey(event)" wire:model.lazy="customer_age">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_age" class="col-2 col-form-label ">Quốc gia</label>
                            <div class="col-10">
                                <input name="country" type="text" class="form-control"
                                    wire:model.lazy="customer_age">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="customer_address" class="col-2 col-form-label ">Địa chỉ</label>
                            <div class="col-10">
                                <input name="customer_address" type="text" class="form-control"
                                    wire:model.lazy="customer_address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="province_id" class="col-2 col-form-label ">Tỉnh/TP</label>
                            <div class="col-10">
                                <select id="province_id" name="province_id" class="form-control select2-box"
                                    wire:model.lazy="province_id">
                                    <option value="">--Chọn thành phố--</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district_id" class="col-2 col-form-label ">Quận/Huyện</label>
                            <div class="col-10">
                                <select id="district_id" name="district_id" class="form-control select2-box"
                                    wire:model.lazy="district_id">
                                    <option value="">--Chọn Quận/ Huyện--</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_job" class="col-2 col-form-label ">Nghề nghiệp</label>
                            <div class="col-10">
                                <input name="customer_job" type="text" class="form-control"
                                    wire:model.lazy="customer_job">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sell_date" class="col-2 col-form-label ">Ngày sinh</label>
                            <div class="col-10">
                                <input type="date" id="birth_day" class="form-control" max='{{ date('Y-m-d') }}'
                                    wire:model.lazy="birth_day">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="category-table_filter" class="dataTables_filter">
                            <button data-target="#modal-form-view-history" data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-plus"></i> Thêm phòng</button>
                            {{-- <button name="submit" type="submit" class="btn btn-warning add-new"> Thêm mới</button> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
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
                </div>

            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="form-group row pt-4">

        <div wire:ignore.self class="modal fade" id="modal-form-view-history" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Danh sách phòng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <div class="form-group row">
                                <label for="SerialNumber" class="col-1 col-form-label">Tên phòng</label>
                                <div class="col-3">
                                    <input id="SerialNumber" wire:model.debounce.500ms='searchChassic'
                                        name="SerialNumber" type="text" class="form-control">
                                </div>
                                <label for="EngineNumber" class="col-1 col-form-label ">Mã phòng</label>
                                <div class="col-3">
                                    <input id="EngineNumber" wire:model='searchEngine' name="EngineNumber"
                                        type="text" class="form-control">
                                </div>
                                <label for="Model" class="col-1 col-form-label ">Tầng</label>
                                <div class="col-3">
                                    <input id="model" wire:model.debounce.1000ms='searchModel' type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label for="Color" class="col-1 col-form-label ">Loại phòng</label>
                                <div class="col-3">
                                    <input wire:model.debounce.1000ms='searchColor' type="text"
                                        class="form-control">
                                </div>
                                <label for="SupplyName" class="col-1 col-form-label">Theo sức chứa</label>
                                <div class="col-3">
                                    <select name="SupplyName" wire:model='searchSupplier' id="SupplyName"
                                        class="custom-select select2-box">
                                        <option value="">--Chọn Kho--</option>
                                    </select>
                                </div>
                                <label for="SupplyName" class="col-1 col-form-label">Số giường</label>
                                <div class="col-3">
                                    <input wire:model.debounce.1000ms='searchColor' type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="searchStatus" class="col-1 col-form-label">Trạng thái</label>
                                <div class="col-3">
                                    <select wire:model='searchStatus' class="custom-select" id="searchStatus">
                                        <option value="">--Chọn--</option>
                                        <option value="1"></option>
                                        <option value="1"></option>
                                        <option value="1"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:100px">Tên phòng</th>
                                    <th style="width:100px">Loại</th>
                                    <th style="width:100px">Sức chứa</th>
                                    <th style="width:120px">Tầng</th>
                                    <th style="width:50%">Ghi chú</th>
                                    <th style="width:30%">Giá thuê</th>
                                    <th style="width:200px">Phụ phí (Muộn)</th>
                                    <th style="width:200px">Phụ phí (Sớm)</th>
                                    <th style="width:200px">Trạng thái</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listRooms as $item)
                                    {{-- @php
                                        dd($item);
                                    @endphp --}}
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['type']['type_room']['name'] }}</td>
                                        <td>{{ $item['type']['room_capacity']['name'] . '- số giường ' . $item['type']['room_capacity']['number_of_bed'] . '- sức chứa ' . $item['type']['room_capacity']['max_capacity'] . ' người' }}
                                        </td>
                                        <td>{{ $item['floor']['name'] }}</td>
                                        <td>Đây lả mô tả</td>
                                        <td>{{ number_format($item['type']['price'][0]['price'], 0, ',', ',') }} Đ</td>
                                        <td>{{ number_format($item['type']['price'][0]['late_surcharge'], 0, ',', ',') }}
                                            Đ</td>
                                        <td>{{ number_format($item['type']['price'][0]['early_surcharge'], 0, ',', ',') }}
                                            Đ</td>
                                        <td>{{ $item['status'] }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        {{-- @if (count($listRooms) > 0) --}}
                        {{ $listRooms->links() }}
                        {{-- @endif --}}
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
