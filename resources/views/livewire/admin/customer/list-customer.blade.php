@php
    use App\Enum\EMotorbike;
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
            max-width: 98% !important;
        }
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Thông tin người dùng</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-5 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Họ tên khách hàng</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="name" type="text" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số điện thoại</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="phone" type="text" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Số CMTND</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="cmtnd" type="text" class="form-control">
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
                            <button data-target="#modal-create" data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-plus"></i> Thêm mới</button>
                        </div>
                        <div id="category-table_filter" class="dataTables_filter">
                            <button data-target="#modal-checkout" data-toggle="modal" type="button"
                                class="btn btn-outline-primary"><i class="fa fa-print"></i> In danh sách</button>
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
                                    <th style="width:100px">Code</th>
                                    <th style="width:100px">Tên khách</th>
                                    <th style="width:100px">Số điện thoại</th>
                                    <th style="width:100px">Số CCCD</th>
                                    <th style="width:120px">Email</th>
                                    <th style="width:120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($listCustomer as $item)
                                    <tr>
                                        <td scope="col" class="text-center align-middle ">{{ $index++ }}</td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['code'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['name'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['phone'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['cmtnd'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['email'] }}
                                        </td>
                                        <td class="text-center">
                                            <li class="list-inline-item icon-trash">
                                                <a href="{{ route('admin.bookroom.user_order', ['id' => $item['id']]) }}"
                                                    class="btn btn-success btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Chi tiết"><i
                                                        class="bi bi-search"></i></a>
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-danger btn-sm rounded-0"
                                                    data-target="#modal-create" data-toggle="modal" type="button"
                                                    data-toggle="tooltip" data-placement="top"
                                                    wire:click="edit({{ $item['id'] }})" title="Sửa"><i
                                                        class="bi bi-gear-fill"></i></button>
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top"
                                                    wire:click="delete({{ $item['id'] }})" title="Xóa"><i
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
                    $('#typeTime').on('change', function(e) {
                        // var data = $('#typeTime').val();
                        // console.log(data)
                        // @this.set('typeTime', data);
                        window.livewire.emit('updateInfoPirce');
                    });
                })
            </script>
        @endsection
