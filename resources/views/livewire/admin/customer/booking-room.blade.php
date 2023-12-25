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
            <div class="ibox-title">Thông tin hóa đơn người đặt</div>
        </div>
        <div class="ibox-body">
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
                            width="100%" role="grid" aria-describedby="category-table_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th style="width:100px">#</th>
                                    <th style="width:100px">Tên phòng</th>
                                    <th style="width:100px">Thời gian thuê</th>
                                    <th style="width:100px">Thời gian checkin</th>
                                    <th style="width:120px">Giá phòng</th>
                                    <th style="width:120px">Giá dịch vụ đã sử dụng</th>
                                    <th style="width:120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($listBooking as $item)
                                    <tr>
                                        <td scope="col" class="text-center align-middle ">{{ $index++ }}</td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['room']['name'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['rental_time'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">{{ $item['checkin_date'] }}
                                        </td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['Room']->priceOfRoom($item['type_time']) }}</td>
                                        <td scope="col" class="text-center align-middle ">
                                            {{ $item['total_price_service'] }}</td>
                                        <td class="text-center">
                                            <li class="list-inline-item icon-trash">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-trash"></i></button>
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                {{-- <a href="{{route('admin.bookroom.custom_room_booking',['id'=>$item['room']['id']])}}" class="btn btn-warning btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-eye"></i></a> --}}
                                            </li>
                                            <li class="list-inline-item icon-trash">
                                                <a href="" class="btn btn-success btn-sm rounded-0"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Delete"><i class="fa fa-money"></i></a>
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
                $('#typeTime').on('change', function(e) {
                    // var data = $('#typeTime').val();
                    // console.log(data)
                    // @this.set('typeTime', data);
                    window.livewire.emit('updateInfoPirce');
                });
            })
        </script>
    @endsection
