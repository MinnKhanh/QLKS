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
            max-width: 60% !important;
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
                <div class="ibox-title">Thông tin sức chứa</div>
            </div>
            <div class="ibox-body">
                <div>
                </div>
                <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <div id="category-table_filter" class="dataTables_filter">
                                <button data-target="#modal-add" data-toggle="modal" data-toggle="tooltip"
                                    class="btn btn-primary" wire:click="resetData"><i class="fa fa-plus"></i>
                                    Thêm mới</button>
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
                                            colspan="1" style="width: 10%;" wire:click="sorting('name')">Tên</th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                            colspan="1" style="width: 10%;" wire:click="sorting('name')">Sức chứa tối
                                            đa</th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                            colspan="1" style="width: 10%;" wire:click="sorting('name')">Số người lớn
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                            colspan="1" style="width: 10%;" wire:click="sorting('name')">Số trẻ em
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="category-table" rowspan="1"
                                            colspan="1" style="width: 10%;" wire:click="sorting('name')">Số giường
                                        </th>
                                        <th tabindex="0" aria-controls="category-table" rowspan="1" colspan="1"
                                            style="width: 7%;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @forelse ($listCapacity as $item)
                                        <tr data-parent="" data-index="1" role="row" class="odd">
                                            <td>{{ $index++ }}</td>
                                            <td> {{ $item['name'] }}</td>
                                            <td> {{ $item['max_capacity'] }}</td>
                                            <td> {{ $item['number_of_adults'] }}</td>
                                            <td> {{ $item['number_of_children'] }}</td>
                                            <td> {{ $item['number_of_bed'] }}</td>
                                            <td class="text-center">
                                                <button data-target="#modal-add" data-toggle="modal"
                                                    data-toggle="tooltip" wire:click="update({{ $item['id'] }})"
                                                    class="btn btn-primary btn-xs m-r-5"><i
                                                        class="fa fa-pencil font-14"></i></button>
                                                <button class="btn btn-danger btn-xs m-r-5"><i
                                                        class="fa fa-trash font-14"
                                                        wire:click="delete({{ $item['id'] }})"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
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
                                    <h5 class="modal-title">Thêm Loại sức chứa</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 row align-items-center">
                                            <label for="searchStatus"
                                                class="col-5 col-form-label text-right">Tên</label>
                                            <div class="col-7">
                                                <input id="name" class="form-control" wire:model.defer="name">
                                                @error('name')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 row align-items-center">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Sức chứa
                                                tối đa</label>
                                            <div class="col-7">
                                                <input id="name" class="form-control"
                                                    wire:model.defer="maxCapacity">
                                                @error('maxCapacity')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-4 row align-items-center">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Số người
                                                lớn</label>
                                            <div class="col-7">
                                                <input id="name" class="form-control" type="number"
                                                    wire:model.defer="numberOfadult">
                                                @error('numberOfadult')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Số trẻ
                                                em</label>
                                            <div class="col-7">
                                                <input id="name" class="form-control" type="number"
                                                    wire:model.defer="numberOfchildren">
                                                @error('numberOfchildren')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 row align-items-center">
                                            <label for="searchStatus" class="col-5 col-form-label text-right">Số
                                                giường</label>
                                            <div class="col-7">
                                                <input id="name" class="form-control" type="number"
                                                    wire:model.defer="numberOfBed">
                                                @error('numberOfBed')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="create">Lưu</button>
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
            document.addEventListener('DOMContentLoaded', function() {})
        </script>
    </div>

    <!-- Livewire Component wire-end:EmrXG1mODRYvjcyJApE5 -->
</div>
@push('modal')
@endpush
