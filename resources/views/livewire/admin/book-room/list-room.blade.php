@php
    use App\Enum\EMotorbike;
    use App\Enums\StatusRoomEnum;
    use App\Enums\StatusBookingEnum;
    use App\Enums\TypeBooking;
    use App\Enums\TypeTimeEnum;
@endphp
@push('css')
    <style>
        .item {
            width: 10%;
            box-sizing: border-box;
            height: 150px;
        }

        .item:hover {
            background-color: rgba(5, 164, 217, 0.998);
        }

        .item-content {
            background-color: rgba(10, 185, 243, 0.714);
            height: 100%;
            width: 100%;
        }

        .name {
            font-size: 2rem;
            font-weight: 700;
        }

        .date {
            font-weight: 700;
            color: #ffffff;
        }

        .hour {
            font-weight: 700;
        }

        .type {
            font-weight: 700;
        }

        a {
            color: black !important;
        }

        .box {
            width: 150px;
            height: 57px;
            background-color: yellow;
        }
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <div class="d-flex mb-5">
                {{-- <div class="col-1"></div> --}}
                <div class="d-flex flex-column align-items-center">
                    <p class="box" style="background-color: #34f91e"></p>
                    <span class="text-center">Đang dọn</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <p class="box" style="background-color: rgba(10, 185, 243, 0.714)"></p>
                    <span class="text-center">Trống/đang Được sử dụng</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <p class="box"></p>
                    <span class="text-center">Đã được đặt trước</span>
                </div>
            </div>
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
                <div class="col-4 row align-items-center">
                    <label for="name" class="col-3 col-form-label pd-0">Tầng</label>
                    <div class="col-9">
                        <select name="name" wire:model='floor' type="text" class="form-control">
                            <option value=>--Chọn--</option>
                            @forelse ($listFloor as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-4 row align-items-center mt-3">
                    <label for="name" class="col-3 col-form-label pd-0">Trạng thái</label>
                    <div class="col-9">
                        <select name="name" wire:model='status' type="text" class="form-control">
                            <option value=>--Tất cả--</option>
                            @forelse (StatusRoomEnum::getValues() as $item)
                                <option value="{{ $item }}">{{ StatusRoomEnum::getName($item) }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-8 row align-items-center mt-3 d-flex">

                </div>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($listRoom as $item)
                    <div class="item pl-1 pr-1 pb-1 pt-1">
                        @if ($item['booking'])
                            @if ($item['booking'][0]['status'] == StatusBookingEnum::ACTIVE && $item['booking'][0]['is_checkout'])
                                <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['id'], 'bookingid' => $item['booking'][0]['id']]) }}"
                                    style='background-color: #34f91e;'
                                    class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                                    <span class="date">{{ $item['booking'][0]['checkin_date'] }}</span>
                                    <p class="name">{{ $item['name'] }}</p>
                                    <div class="hour">{{ $item['booking'][0]['rental_time'] }} -
                                        {{ TypeTimeEnum::getName($item['booking'][0]['type_time']) }}</div>
                                    <p class="type mb-0"> {{ $item['type']['room_capacity']['name'] }} </p>
                                </a>
                            @elseif ($item['booking'][0]['status'] == StatusBookingEnum::ACTIVE)
                                <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['id'], 'bookingid' => $item['booking'][0]['id']]) }}"
                                    class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                                    <span class="date">{{ $item['booking'][0]['checkin_date'] }}</span>
                                    <p class="name">{{ $item['name'] }}</p>
                                    <div class="hour">{{ $item['booking'][0]['rental_time'] }} -
                                        {{ TypeTimeEnum::getName($item['booking'][0]['type_time']) }}</div>
                                    <p class="type mb-0"> {{ $item['type']['room_capacity']['name'] }} </p>
                                </a>
                            @elseif($item['booking'][0]['type'] == TypeBooking::RESERVE && $item['booking'][0]['status'] == StatusBookingEnum::PENDING)
                                <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['id'], 'bookingid' => $item['booking'][0]['id']]) }}"
                                    class="item-content d-flex flex-column justify-content-center align-items-center mb-1"
                                    style="{{ $item['booking'][0]['type'] == TypeBooking::RESERVE ? 'background-color: #f9f91e;' : '' }}">
                                    <span class="date">{{ $item['booking'][0]['checkin_date'] }}</span>
                                    <p class="name">{{ $item['name'] }}</p>
                                    <div class="hour">{{ $item['booking'][0]['rental_time'] }} -
                                        {{ TypeTimeEnum::getName($item['booking'][0]['type_time']) }}</div>
                                    <p class="type mb-0"> {{ $item['type']['room_capacity']['name'] }} </p>
                                    @if ($item['status'] == StatusRoomEnum::PROCESSING)
                                        <span
                                            class="text-bold">{{ StatusRoomEnum::getName(StatusRoomEnum::PROCESSING) }}</span>
                                    @endif
                                </a>
                            @endif
                        @elseif($item['status'] == StatusRoomEnum::PROCESSING)
                        @else
                            <a href="{{ route('admin.bookroom.create_info', ['id' => $item['id']]) }}"
                                class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                                <p class="name">{{ $item['name'] }}</p>
                            </a>
                        @endif
                    </div>
                @endforeach

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
