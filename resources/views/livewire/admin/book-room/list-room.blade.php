@php
    use App\Enum\EMotorbike;
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
    </style>
@endpush
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <div class="d-flex flex-wrap">
                @foreach ($listRoom as $item)
                    <div class="item pl-1 pr-1 pb-1 pt-1">
                        @if ($item['status'] == 2)
                            <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => $item['id']]) }}"
                                class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                                <span class="date">{{ $item['booking'][0]['checkin_date'] }}</span>
                                <p class="name">{{ $item['name'] }}</p>
                                <div class="hour">{{ $item['booking'][0]['rental_time'] }} - Giờ</div>
                                <p class="type"> {{ $item['type']['room_capacity']['name'] }} </p>
                            </a>
                        @else
                            <a href="{{ route('admin.bookroom.create_info', ['id' => $item['id']]) }}"
                                class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                                <p class="name">{{ $item['name'] }}</p>
                            </a>
                        @endif
                    </div>
                @endforeach
                {{-- <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.custom_room_booking', ['id' => 1]) }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div>
                <div class="item pl-1 pr-1 pb-1 pt-1">
                    <a href="{{ route('admin.bookroom.create_info') }}"
                        class="item-content d-flex flex-column justify-content-center align-items-center mb-1">
                        <span class="date">29/07
                            20:37</span>
                        <p class="name">101</p>
                        <div class="hour">1 - Giờ</div>
                        <p class="type">Đơn</p>
                    </a>
                </div> --}}

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
