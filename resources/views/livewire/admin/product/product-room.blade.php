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
            <div class="ibox-title">Thông tin hóa đơn người đặt</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-5 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Tên sản phẩm</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="name" type="text" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Giá</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="price" type="text" class="form-control">
                        @error('customer')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-3 row align-items-center mb-5">
                    <label for="customer_name" class="col-3 col-form-label pd-0">Nhãn hàng</label>
                    <div class="col-9">
                        <input name="customer_name" wire:model="manufac" type="text" class="form-control">
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
                                        <td scope="col" class="text-center align-middle ">{{ $index++ }}</td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['name'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['price'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['brand'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['quantity'] }}
                                        </td>
                                        </td>
                                        <td class="text-center">
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
                            <h5 class="modal-title">Thêm mới thông tin sản phẩm</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row mb-4">
                                        <label for="customer_name" class="col-2 col-form-label ">Tên sản
                                            phẩm</label>
                                        <div class="col-10">
                                            <input name="customer_name" type="text" class="form-control"
                                                wire:model.lazy="nameUpdate">
                                            @error('customerName')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="customer_phone" class="col-2 col-form-label ">Giá sản
                                            phẩm</label>
                                        <div class="col-10">
                                            <input name="customer_phone" type="text" class="form-control"
                                                wire:model.lazy="priceUpdate">
                                            @error('customerPhone')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group row mb-4">
                                        <label for="sell_date" class="col-2 col-form-label ">Số lượng sản
                                            phẩm</label>
                                        <div class="col-10">
                                            <input type="text" id="cccd" class="form-control"
                                                wire:model.lazy="quantityUpdate">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="customer_address" class="col-2 col-form-label ">Nhãn
                                            hàng</label>
                                        <div class="col-10">
                                            <input name="customer_address" type="text" class="form-control"
                                                wire:model.lazy="brandUpdate">
                                        </div>
                                    </div>
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
