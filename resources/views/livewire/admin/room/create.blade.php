@php
    use App\Enum\EMotorbike;
    use App\Enums\StatusRoomEnum;
    use App\Enums\TypeTimeEnum;
@endphp
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .mdal-info {

            padding-right: 0;
        }

        .modal-info>.modal-dialog {
            max-width: 80% !important;
        }

        .item {
            height: 50px;
            background-color: red;
            box-sizing: border-box;
        }

        .row {
            margin: 0px;
        }

        .form-control {
            height: 100% !important;
        }


        .list-action {
            padding: 1rem 1rem 1rem 1rem;
        }

        .error {
            color: red;
        }

        .btn-warning.active {
            color: #000 !important;
            background-color: #464dee;
            border-color: #464dee;
            -webkit-box-shadow: none;
            box-shadow: none;
            background-image: none;
        }
    </style>
@endpush
@php
    use App\Enums\TypePriceEnum;
@endphp
<div class="page-content fade-in-up" id="content">
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Thông tin loại phòng</div>
            </div>
            <div class="ibox-body">
                <div>
                    <div class="form-group row mb-5">
                        <div class="col-6">
                            <label for="CustomerName" class="col-12 col-form-label ml-3 mb-3">Khoảng thời gian tính
                                1
                                ngày</label>
                            <div class="col-12 d-flex">
                                <div class="col-6 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName" type="time" class="form-control"
                                        value="" wire:model="startTimeOfDay">
                                    <span class="error">
                                        @error('startTimeOfDay')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <span class="d-flex align-items-center">~</span>
                                <div class="col-6 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName" type="time" class="form-control"
                                        value="" wire:model.defer="endTimeOfDay">
                                    <span class="error">
                                        @error('endTimeOfDay')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="CustomerName" class="col-12 col-form-label ml-3 mb-3">Khoảng thời gian tính
                                1
                                đêm</label>
                            <div class="col-12 d-flex">
                                <div class="col-6 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName" type="time" class="form-control"
                                        value="" wire:model.defer="startTimeOfNigh">
                                    <span class="error">
                                        @error('startTimeOfNigh')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <span class="d-flex align-items-center">~</span>
                                <div class="col-6 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName" type="time" class="form-control"
                                        value="" wire:model="endTimeOfNight">
                                    <span class="error">
                                        @error('endTimeOfNight')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-3">
                            <label for="CustomerName" class="col-12 col-form-label ml-3 mb-2">Số phút làm tròn
                                một giờ</label>
                            <div class="col-12 d-flex ml-3">
                                <span class="d-flex align-items-center justify-content-end">Số phút: </span>
                                <div class="col-8 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName" type="number" class="form-control"
                                        value="" wire:model.defer="minutesConvertedToHours">
                                    <span class="error">
                                        @error('minutesConvertedToHours')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <span class="d-flex align-items-center justify-content-end">Phút</span>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="CustomerName" class="col-12 col-form-label ml-3 mb-2">Số giờ làm trọng
                                một ngày</label>
                            <div class="col-12 d-flex ml-3">
                                <span class="d-flex align-items-center justify-content-end">Số giờ: </span>
                                <div class="col-8 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName" type="number" class="form-control"
                                        value="" wire:model.defer="numberOfHoursConvertedToDays">
                                    <span class="error">
                                        @error('numberOfHoursConvertedToDays')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <span class="d-flex align-items-center justify-content-end">Giờ</span>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="CustomerName" class="col-12 col-form-label ml-3 mb-2">Số giờ làm tròn một
                                đêm thuê</label>
                            <div class="col-12 d-flex ml-3">
                                <span class="d-flex align-items-center justify-content-end">Số giờ: </span>
                                <div class="col-8 d-flex flex-column">
                                    <input id="CustomerName" name="CustomerName"
                                        wire:model.defer='numberOfHoursConvertedToOneNight' type="number"
                                        class="form-control" value="">
                                    <span class="error">
                                        @error('numberOfHoursConvertedToOneNight')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <span class="d-flex align-items-center justify-content-end">Giờ</span>
                            </div>
                        </div>

                        <div class="col-3 pt-5">
                            <button type="button" class="btn btn-info add-new" wire:click="updateDataTime"
                                data-toggle="modal" data-target="#modal-form-import-cnbh">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-1">
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <div id="category-table_filter" class="dataTables_filter">
                                <button data-target="#modal-add" data-toggle="modal" data-toggle="tooltip"
                                    class="btn btn-primary" wire:click="toggleAdd"><i class="fa fa-plus"></i>
                                    Thêm mới</button>
                                {{-- <button wire:click="addRoomType" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    Add</button> --}}
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div id="category-table_filter" class="dataTables_filter">
                                <button type="button" wire:click="changeTypeTimePrice(1)"
                                    class="btn btn-warning add-new {{ $typePrice == TypeTimeEnum::DAY ? 'active' : '' }}"><i
                                        class="fa fa-file-excel-o"></i> Theo
                                    ngày</button>
                                <button type="button"
                                    class="btn btn-info add-new {{ $typePrice == TypeTimeEnum::NIGHT ? 'active' : '' }}"
                                    wire:click="changeTypeTimePrice(2)"><i class="fa fa-file-excel-o"></i> Theo
                                    đêm</button>
                                <button type="button"
                                    class="btn btn-info add-new {{ $typePrice == TypeTimeEnum::HOUR ? 'active' : '' }}"
                                    wire:click="changeTypeTimePrice(3)"><i class="fa fa-upload"
                                        aria-hidden="true"></i>
                                    Theo giờ
                                </button>
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
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" wire:click="sorting('code')"
                                            style="width: 7%;">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" wire:click="sorting('code')"
                                            style="width: 7%;">Ảnh
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" style="width: 10%;"
                                            wire:click="sorting('name')">Loại phòng</th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" style="width: 10%;"
                                            wire:click="sorting('address')">Sức chứa</th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" style="width: 10%;"
                                            wire:click="sorting('address')">Giá phòng</th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" style="width: 10%;"
                                            wire:click="sorting('phone')">Phụ phí thêm mỗi giờ (muộn)</th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table"
                                            rowspan="1" colspan="1" style="width: 7%;"
                                            wire:click="sorting('birthday')">Phụ phí thêm mỗi giờ (sớm)</th>
                                        <th tabindex="0" aria-controls="category-table" rowspan="1"
                                            colspan="1" style="width: 7%;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @forelse ($listData as $item)
                                        <tr data-parent="" data-index="1" role="row" class="odd">
                                            <td>{{ $index++ }}</td>
                                            <td class="text-center"><img style="width: 100px;height: 100px;"
                                                    src="{{ asset('storage/room/' . ($item['img'] ? $item['img'][0]['path'] : '')) }}"
                                                    alt="" srcset=""></td>
                                            <td>{{ $item['type_room']['name'] }}</td>
                                            <td> {{ $item['room_capacity']['name'] }} -
                                                {{ $item['room_capacity']['number_of_bed'] }} giường -
                                                tối
                                                đa {{ $item['room_capacity']['max_capacity'] }} người</td>
                                            <td>{{ $item['price'][0]['price'] }}</td>
                                            <td>{{ $item['price'][0]['late_surcharge'] }}</td>
                                            <td>{{ $item['price'][0]['early_surcharge'] }}</td>
                                            <td class="text-center">
                                                <a href="http://localhost/headvn/public/khachhang/xemchitiet/1"
                                                    class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                                <a wire:click="update({{ $item['id'] }})"
                                                    class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                                <button data-target="#modal-service"
                                                    wire:click="showService({{ $item['id'] }})" data-toggle="modal"
                                                    data-toggle="tooltip" class="btn btn-primary btn-xs m-r-5"
                                                    data-toggle="tooltip" data-original-title="Sửa"><i
                                                        class="fa fa-plus font-14"></i></button>
                                                {{-- <a data-target="#modal-add" data-toggle="modal" data-toggle="tooltip"
                                                    class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Sửa"
                                                    wire:click="edit({{ $item['id'] }})"><i
                                                        class="fa fa-pencil font-14"></i></a> --}}

                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    @if ($isAdd)

                                        <tr data-parent="" data-index="1" role="row" class="odd">
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                @if ($photoUpdate)
                                                    <img style="width: 100px;height: 100px;"
                                                        src='{{ $photoUpdate->temporaryUrl() }}' alt=""
                                                        srcset="">
                                                @else
                                                    <img style="width: 100px;height: 100px;"
                                                        src="{{ asset('storage/room/' . $photoEdit) }}"
                                                        alt="" srcset="">
                                                @endif
                                                <input type="file" wire:model="photoUpdate" class="mt-1">
                                            </td>
                                            <td><select wire:change="change" id="typeRoom"
                                                    class="custom-select select2-box" wire:model.defer="typeRoom">
                                                    <option value="0">--Chọn--</option>
                                                    @foreach ($listTypeRoom as $item)
                                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><select wire:change="change" id="capacityRoom"
                                                    class="custom-select select2-box" wire:model.defer="capacityRoom">
                                                    <option value="0">--Chọn--</option>
                                                    @forelse ($listCapacity as $item)
                                                        <option value="{{ $item['id'] }}">
                                                            {{ $item['name'] }} - {{ $item['number_of_bed'] }}
                                                            giường -
                                                            tối
                                                            đa {{ $item['max_capacity'] }} người
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Giá phòng"
                                                    wire:model.lazy="price" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Phụ phí trả muộn mỗi giờ"
                                                    wire:model.lazy="lateSurcharge" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Phụ phí nhận sớm mỗi giờ"
                                                    wire:model.lazy="earlySurcharge" class="form-control">
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="btn btn-warning btn-xs m-r-5"
                                                        wire:click="createRoomtype" data-toggle="tooltip"
                                                        data-original-title="Xem"><i class="bi bi-save-fill"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav class="row mt-3">
                        <div class="col-md-6 d-flex align-items-center">
                            <span>1 - 15 / 15 item</span>
                        </div>
                        <div class="col-md-6 text-right">
                            <ul class="pagination m-0 justify-content-end">

                                <li class="page-item disabled" aria-disabled="true" aria-label="« Trang sau">
                                    <span class="page-link" aria-hidden="true">&lt;</span>
                                </li>





                                <li class="page-item active" wire:key="paginator-page-1" aria-current="page">
                                    <span class="page-link">1</span>
                                </li>


                                <li class="page-item disabled" aria-disabled="true" aria-label="Trang trước »">
                                    <span class="page-link" aria-hidden="true">&gt;</span>
                                </li>
                            </ul>

                        </div>
                    </nav>
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
                                            <label for="SerialNumber" class="col-1 col-form-label text-right">Tên
                                                dịch
                                                vụ</label>
                                            <div class="col-3">
                                                <input name="SerialNumber" type="text" class="form-control">
                                            </div>
                                            <label for="EngineNumber" class="col-1 col-form-label text-right ">Loại
                                                dịch
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
                                                    <td>{{ $item['type']['name'] }}</td>
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['price'] }}</td>
                                                    <td> <a class="btn btn-info btn-xs"
                                                            wire:click="addService({{ $item['id'] }})"
                                                            data-toggle="tooltip" target="_blank"
                                                            data-original-title="Thêm"><i class="fa fa-plus"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">Trống</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <label for="">Dịch vụ hiện có</label>
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
                                                @forelse ($listServiceCurrent as $item)
                                                    <tr>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['type']['name'] }}</td>
                                                        <td>{{ $item['description'] }}</td>
                                                        <td>{{ $item['price'] }}</td>
                                                        <td> <a class="btn btn-info btn-xs"
                                                                wire:click="removeService({{ $item['id'] }})"
                                                                data-toggle="tooltip" target="_blank"
                                                                data-original-title="Xóa"><i
                                                                    class="bi bi-dash"></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">Trống</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
                {{-- modal add --}}
                <div class="form-group row pt-4">
                    <div wire:ignore.self class="modal fade modal-info" id="modal-add" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm phòng</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Loại
                                                phòng</label>
                                            <div class="col-7">
                                                <select wire:change="change" id="typeRoom"
                                                    class="custom-select select2-box" wire:model.defer="typeRoom">
                                                    <option value="0">--Chọn--</option>
                                                    @foreach ($listTypeRoom as $item)
                                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('typeRoom')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-4 col-form-label text-right">Sức
                                                chứa</label>
                                            <div class="col-8">
                                                <select wire:change="change" id="capacityRoom"
                                                    class="custom-select select2-box" wire:model.defer="capacityRoom">
                                                    <option value="0">--Chọn--</option>
                                                    @forelse ($listCapacity as $item)
                                                        <option value="{{ $item['id'] }}">
                                                            {{ $item['name'] }} - {{ $item['number_of_bed'] }}
                                                            giường -
                                                            tối
                                                            đa {{ $item['max_capacity'] }} người
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @error('capacityRoom')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label class="col-4 col-form-label text-right ">Giá theo ngày</label>
                                            <div class="col-8 row">
                                                <div class="col-12 pr-0">
                                                    <input type="number" wire:model.lazy="priceDayNew"
                                                        id="fromDateTime" class="form-control">
                                                    @error('fromDateTime')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Phụ
                                                phí(muộn)</label>
                                            <div class="col-7">
                                                <input wire:model.lazy="lateChargeDayNew" id="lateChargeDayNew"
                                                    type="number" class="form-control">
                                                @error('lateChargeDayNew')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-4 col-form-label text-right">Phụ
                                                phí (sớm)</label>
                                            <div class="col-8">
                                                <input wire:model.lazy="earlyChargeDayNew" type="number"
                                                    class="form-control">
                                                @error('earlyChargeHourNew')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label class="col-5 col-form-label text-right ">Giá theo Giờ</label>
                                            <div class="col-7 row">
                                                <div class="col-12 pr-0">
                                                    <input type="number" wire:model.lazy="priceHourNew"
                                                        id="fromDateTime" class="form-control">
                                                    @error('fromDateTime')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Phụ
                                                phí(muộn)</label>
                                            <div class="col-7">
                                                <input wire:model.lazy="lateChargeHourNew" id="lateChargeHourNew"
                                                    type="number" class="form-control">
                                                @error('lateChargeHourNew')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-4 col-form-label text-right">Phụ
                                                phí (sớm)</label>
                                            <div class="col-8">
                                                <input wire:model.lazy="earlyChargeHourNew" type="number"
                                                    class="form-control">
                                                @error('earlyChargeHourNew')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label class="col-5 col-form-label text-right ">Giá theo đêm</label>
                                            <div class="col-7 row">
                                                <div class="col-12 pr-0">
                                                    <input type="number" wire:model.lazy="priceNightNew"
                                                        id="fromDateTime" class="form-control">
                                                    @error('fromDateTime')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Phụ
                                                phí(muộn)</label>
                                            <div class="col-7">
                                                <input wire:model.lazy="lateChargeNightNew" id="lateChargeNightNew"
                                                    type="number" class="form-control">
                                                @error('lateChargeNightNew')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center mb-5">
                                            <label for="searchStatus" class="col-4 col-form-label text-right">Phụ
                                                phí (sớm)</label>
                                            <div class="col-8">
                                                <input wire:model.lazy="earlyChargeNightNew" type="number"
                                                    class="form-control">
                                                @error('earlyChargeNightNew')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 row align-items-center">
                                            <label for="photos" class="col-3 col-form-label pd-0">Ảnh</label>
                                            <div class="col-9">
                                                <input type="file" wire:model="photos" multiple>
                                                <div wire:loading wire:target="photos">Uploading...</div>
                                                @error('photos')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($photos)
                                            <div class="col-12 form-row mt-5 mb-5">
                                                <div class="col-12">
                                                    <div class="w-100">
                                                        <h6 class="mb-4">Ảnh Sản Phẩm</h6>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach ($photos as $item)
                                                                <div class="col-2">
                                                                    <img src='{{ $item->temporaryUrl() }}'
                                                                        style="width: 100%;" alt="">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    @if ($this->idEdit)
                                        <button type="button" class="btn btn-secondary"
                                            wire:click="create">Sửa</button>
                                    @else
                                        <button type="button" class="btn btn-secondary"
                                            wire:click="create">Thêm</button>
                                    @endif
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#content').on("change", "#typeRoom", function() {
                    var data = $('#typeRoom').select2("val");
                    @this.set('typeRoom', data);
                    window.livewire.emit("change");
                });
                $('#content').on("change", "#capacityRoom", function() {
                    var data = $('#capacityRoom').select2("val");
                    @this.set('capacityRoom', data);
                });
            })
        </script>
    </div>

    <!-- Livewire Component wire-end:EmrXG1mODRYvjcyJApE5 -->
</div>
@push('modal')
@endpush
