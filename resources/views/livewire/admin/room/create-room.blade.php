@php
    use App\Enum\EMotorbike;
    use App\Enums\StatusBookingEnum;
    use App\Enums\StatusRoomEnum;
    use App\Enums\TypeTimeEnum;
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
            max-width: 90% !important;
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
            <div class="ibox-title">Thông tin phòng khách sạn</div>
        </div>
        <div class="ibox-body">
            <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer mt-5">
                <div class="row mb-5">
                    <div class="col-4 row align-items-center">
                        <label for="name" class="col-3 col-form-label pd-0">Tên phòng</label>
                        <div class="col-9">
                            <input name="name" wire:model='name' type="text" class="form-control">
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 row align-items-center">
                        <label for="type" class="col-3 col-form-label pd-0">Loại phòng</label>
                        <div class="col-9">
                            <select name="type" wire:model='type' type="text" class="form-control">
                                <option value=>--Chọn--</option>
                                @forelse ($listType as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['room_capacity']['name'] }} -
                                        {{ $item['room_capacity']['number_of_bed'] }} giường -
                                        tối
                                        đa {{ $item['room_capacity']['max_capacity'] }} người</option>
                                @empty
                                @endforelse
                            </select>
                            @error('type')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div id="category-table_filter" class="dataTables_filter">
                            <button data-target="#modal-create" data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-plus"></i>Thêm
                                mới</button>
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
                                                    data-target="#modal-create" data-toggle="modal"
                                                    data-toggle="tooltip" data-placement="top"
                                                    wire:click="edit({{ $item['id'] }})" title="Thanh toán"><i
                                                        class="fa fa-gear"></i></button>
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-warning btn-sm rounded-0" type="button"
                                                    data-target="#modal-product" data-toggle="modal"
                                                    data-toggle="tooltip" data-placement="top"
                                                    wire:click="getProduct({{ $item['id'] }})" title="Thanh toán"><i
                                                        class="fa fa-plus"></i></button>
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
            <div wire:ignore.self class="modal fade modal-info" id="modal-create" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tạo mới phòng</h5>
                        </div>
                        <div class="modal-body">
                            <h5 class="border-bottom-1 mb-4 font-weight-bold">Thông tin phòng
                            </h5>
                            <div class="row mb-5">
                                <div class="col-4 row align-items-center">
                                    <label for="code" class="col-3 col-form-label pd-0">Mã phòng</label>
                                    <div class="col-9">
                                        <input name="code" wire:model="code" type="text" class="form-control">
                                        @error('code')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 row align-items-center">
                                    <label for="name" class="col-3 col-form-label pd-0">Tên phòng</label>
                                    <div class="col-9">
                                        <input name="name" wire:model="name" type="text" class="form-control">
                                        @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 row align-items-center">
                                    <label for="type" class="col-3 col-form-label pd-0">Loại phòng</label>
                                    <div class="col-9">
                                        <select name="type" wire:model="type" type="text"
                                            class="form-control">
                                            @forelse ($listType as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['type_room']['name'] . '-' . $item['room_capacity']['name'] }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('type')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 row align-items-center">
                                    <label for="floor" class="col-3 col-form-label pd-0">Tầng</label>
                                    <div class="col-9">
                                        <select name="floor" wire:model="floor" type="text"
                                            class="form-control">
                                            @forelse ($listFloor as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('floor')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 row align-items-center">
                                    <label for="description" class="col-3 col-form-label pd-0">Mô tả</label>
                                    <div class="col-9">
                                        <input name="description" wire:model="description" type="text"
                                            class="form-control">
                                        @error('description')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
                                @if ($isEdit && $itemEdit['img'])
                                    <div class="col-12 form-row mt-5 mb-5">
                                        <div class="col-12">
                                            <div class="w-100">
                                                <h6 class="mb-4">Ảnh Sản Phẩm</h6>
                                                <div class="d-flex flex-wrap">
                                                    @php
                                                        $index = 0;
                                                    @endphp
                                                    @foreach ($listImg as $item)
                                                        <div class="col-3">
                                                            <li class="list-inline-item icon-trash"
                                                                wire:click="removeImg({{ $item['id'] }},{{ $index++ }})">
                                                                <button class="btn btn-danger btn-sm rounded-0"
                                                                    type="button" data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </li>
                                                            <img src='{{ asset('storage/room/' . $item['path']) }}'
                                                                alt="">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                            @if ($isEdit)
                                <button type="button" class="btn btn-secondary" wire:click="create">Cập
                                    nhật</button>
                            @else
                                <button type="button" class="btn btn-secondary" wire:click="create">Thêm
                                    mới</button>
                            @endif
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal product --}}
        <div class="form-group row pt-4">
            <div wire:ignore.self class="modal fade modal-info" id="modal-product" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tạo mới phòng</h5>
                        </div>
                        <div class="modal-body">
                            <h5 class="border-bottom-1 mb-4 font-weight-bold">Danh sách sản phẩm
                            </h5>
                            <div class="row">
                                <div class="col-5 row align-items-center mb-5">
                                    <label for="customer_name" class="col-3 col-form-label pd-0">Sản
                                        phẩm</label>
                                    <div class="col-9">
                                        <select name="customer_name" wire:model="productAdd" type="text"
                                            class="form-control">
                                            <option value=>--Chọn--</option>
                                            @foreach ($listAddProduct as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('productAdd')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 row align-items-center mb-5">
                                    <label for="customer_name" class="col-3 col-form-label pd-0">Số lượng</label>
                                    <div class="col-9">
                                        <input name="customer_name" wire:model="productCount" type="number"
                                            class="form-control">
                                        @error('productCount')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3 row align-items-center mb-5">
                                    <button wire:click="addProduct" type="button" class="btn btn-outline-primary"><i
                                            class="fa fa-plus"></i>Thêm</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-striped table-sm table-bordered dataTable no-footer"
                                        cellspacing="0" width="100%" role="grid"
                                        aria-describedby="category-table_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th style="width:100px">#</th>
                                                <th style="width:100px">Name</th>
                                                <th style="width:100px">Giá</th>
                                                <th style="width:100px">Nhãn hàng</th>
                                                <th style="width:100px">Số lượng</th>
                                                <th style="width:120px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 0;
                                            @endphp
                                            @forelse ($listProduct as $item)
                                                <tr>
                                                    <td scope="col" class="text-center align-middle ">
                                                        {{ $index++ }}</td>
                                                    <td scope="col" class="text-center align-middle ">
                                                        {{ $item['name'] }}
                                                    </td>
                                                    <td scope="col" class="text-center align-middle ">
                                                        {{ $item['price'] }}
                                                    </td>
                                                    <td scope="col" class="text-center align-middle ">
                                                        {{ $item['brand'] }}
                                                    </td>
                                                    <td scope="col" class="text-center align-middle ">
                                                        <input type="number" class="count-update"
                                                            data-id="{{ $item['id'] }}"
                                                            value="{{ $item['product_room'][0]['quantity'] }}">
                                                    </td>
                                                    </td>
                                                    <td class="text-center">
                                                        <li class="list-inline-item icon-trash">
                                                            <button class="btn btn-danger btn-sm rounded-0"
                                                                type="button" data-toggle="tooltip"
                                                                data-placement="top"
                                                                wire:click="updateCountProduct({{ $item['id'] }},0)"
                                                                title="Xóa"><i class="fa fa-trash"></i></button>
                                                        </li>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
</div>
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#category').select2()
            $('#category').on('change', function(e) {
                var data = $('#category').select2("val");
                @this.set('category', data);
            });
            $(document).on('change', '.count-update', function() {
                let val = $(this).val()
                let id = $(this).attr('data-id')
                window.livewire.emit('updateCount', {
                    0: val,
                    1: id
                });
            })
        });
    </script>
@endsection
