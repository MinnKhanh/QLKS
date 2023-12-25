@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .list-input {
            justify-content: center;
        }

        .error {
            color: red;
        }

        .input-book {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
            justify-content: center;
            width: 100%;
        }

        .input-book .check-date,
        .input-book .select-option {
            margin-bottom: 20px;
        }

        .check-date label,
        .select-option label {
            margin-right: 10px;
        }

        .section_gap {
            padding: 120px 250px;
            background-color: rgba(242, 243, 243, 1.00);
            box-shadow: 1px 2px 5px gray;
        }

        label,
        h5 {
            font-size: 14px;
            font-family: Godwit, MuseoSans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;
            font-weight: 700;
            line-height: 20px;
            word-wrap: break-word;
            margin-bottom: 0px;
            color: black;
        }

        .input-info {
            background: white;
            border-radius: 5px;
            padding: 2rem .5rem 2rem .5rem;
            box-shadow: 0ch;
        }

        .input-info input {
            border: 1px solid #8080804a;
            border-radius: 5px;
        }

        .info-room {
            background: white;
            border-radius: 5px;
            padding: 2rem .5rem 2rem .5rem;
            box-shadow: 0ch;
        }

        .info-customer {
            margin-top: 36px;
        }

        li {
            list-style: none;
        }

        p {
            margin-bottom: 0px;
        }

        .content-detail {
            border-top: 1px solid rgba(95, 95, 95, 0.52);
            padding-top: 20px
        }

        .total-price {
            border-bottom: 1px solid #80808029;
            padding-bottom: 20px;
        }

        .date-input {
            width: 100%;
        }
    </style>
@endpush
<div>
    @php
        use App\Enums\TaxEnum;
    @endphp
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Booking</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active">Booking</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap row">
        <div class="col-7 mb-5">
            <div class="info-customer col-12 mr-2">
                <h4>Thông tin người đặt</h3>
                    <div class="row input-info">
                        <div class="col-4 d-flex flex-column mb-4">
                            <label for="" class="mb-1">Ngày checkIn</label>
                            <input disabled type="date" class="date-input" wire:model="fromDateTime"
                                id="fromDateTime">
                        </div>
                        <div class="col-4 d-flex flex-column mb-4">
                            <label for="" class="mb-1">Ngày checkOut</label>
                            <input disabled type="date" class="date-input" wire:model="toDateTime" id="toDateTime">
                        </div>
                        <div class="col-4 d-flex flex-column mb-4">
                            <label for="" class="mb-1">Số phòng</label>
                            <select type="date" class="date-input" wire:model="numberOfRoom"
                                style="height: 100%;border: 1px solid #80808069;">
                                @for ($i = 1; $i <= $countroom; $i++)
                                    <option value={{ $i }}>{{ $i }} phòng</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12 d-flex flex-column mb-4">
                            <label for="">Họ và tên</label>
                            <input type="text" wire:model="name">
                            <span class="error">
                                @error('name')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </span>
                        </div>
                        <div class="col-6 d-flex flex-column">
                            <label for="">Số điện thoại</label>
                            <input type="text" wire:model="phone">
                            <span class="error">
                                @error('phone')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </span>
                        </div>
                        <div class="col-6 d-flex flex-column">
                            <label for="">Email</label>
                            <input type="text" wire:model="email">
                            <span class="error">
                                @error('email')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </span>
                        </div>
                        <div class="col-12 d-flex flex-column mb-4">
                            <label for="">Số CMTND</label>
                            <input type="text" wire:model="cmtnd">
                            <span class="error">
                                @error('cmtnd')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </span>
                        </div>
                    </div>
            </div>
            <div class="info-customer col-12">
                <h4>Chi tiết giá</h3>
                    <div class="row input-info" style="padding-bottom: 0px;">
                        <div class="col-12 d-flex justify-content-between mb-4 total-price">
                            <h5>Thành Tiền</h5>
                            <h5>{{ number_format($roomTypeDetail['price'][0]['price'] * $rentalTime * $numberOfRoom * (1 + TaxEnum::TAX / 100), 0, ',', ',') }}
                                VND</h5>
                        </div>
                        <div class="col-12 d-flex justify-content-between mb-4">
                            <p for="">({{ $numberOfRoom }}x) {{ $roomTypeDetail['type_room']['name'] }}
                                ({{ $rentalTime }} đêm)
                            </p>
                            <p for="">
                                {{ number_format($roomTypeDetail['price'][0]['price'] * $rentalTime * $numberOfRoom, 0, ',', ',') }}
                                VND</p>
                        </div>
                        <div class="col-12 d-flex justify-content-between mb-4">
                            <p for="">Thuế và phí</p>
                            <p for="">
                                {{ number_format($roomTypeDetail['price'][0]['price'] * $rentalTime * $numberOfRoom * (TaxEnum::TAX / 100), 0, ',', ',') }}
                                VND</p>
                        </div>
                        <div class="col-12 d-flex justify-content-between mb-4">
                            <p for="">Tiền cọc 20%</p>
                            <p for="">
                                {{ number_format(0.2 * $roomTypeDetail['price'][0]['price'] * $rentalTime * $numberOfRoom * (1 + TaxEnum::TAX / 100), 0, ',', ',') }}
                                VND</p>
                        </div>
                    </div>
            </div>
        </div>
        <div class="d-flex flex-column col-4" style="padding-top: 70px;">
            <div class="info-room d-flex flex-column">
                <h6 style="color:black" class="mb-4">{{ $roomTypeDetail['type_room']['name'] }}</h6>
                <div class="room-detail d-flex flex-column">
                    <div class="detail-item d-flex w-100 justify-content-start">
                        <p class="col-7" for="">khách/phòng</p>
                        <p class="col-5">{{ $roomTypeDetail['room_capacity']['max_capacity'] }} khách</p>
                    </div>
                    <div class="detail-item d-flex w-100 justify-content-start mb-5">
                        <p class="col-7" for="">Số giường</p>
                        <p class="col-5">{{ $roomTypeDetail['room_capacity']['number_of_bed'] }} giường</p>
                    </div>
                    <div class="detail-item d-flex w-100 justify-content-start content-detail">
                        <div class="col-7"><img style="width: 120px;height: 100px;"
                                src="{{ asset('storage/room/' . ($roomTypeDetail['img'] ? $roomTypeDetail['img'][0]['path'] : '')) }}"
                                alt="">
                        </div>
                        <ul class="col-5">
                            <h6>Dịch vụ: </h6>
                            @forelse ($roomTypeDetail['service'] as $itemService)
                                <div class="item d-flex align-items-center">
                                    <li>- {{ $itemService['name'] }}</li>
                                </div>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <div class="detail-item mt-5 ml-2">
                        <p for=""><i class="bi bi-stickies-fill"></i> &nbsp;Không hoàn tiền</p>
                        <p><i class="bi bi-card-text"></i>&nbsp;Không áp dụng đổi lịch</p>
                    </div>
                </div>
            </div>
            <div class="info-room d-flex flex-column">
                <button wire:click="checkOut" class="book_now_btn button_hover">Đặt</button>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->



</div>
@section('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            let dates = {{ Js::from($dates) }}
            dates = dates.map(element => {
                return [new Date(element[0]), new Date(element[1])]
            });
            console.log(dates)
            $('#typeTime').on('change', function(e) {
                var data = $('#typeTime').select2("val");
                @this.set('typeTime', data);
                window.livewire.emit('updatePrice');
                window.livewire.emit('updateTypeTime');
            });

            function startChange() {
                window.livewire.emit('setfromDate', {
                    ['fromDateTime']: start.value()
                });
                if ($("#toDateTime").length) {
                    var startDate = start.value(),
                        endDate = end.value();
                    if (startDate) {
                        startDate = new Date(startDate);
                        startDate.setDate(startDate.getDate());
                        end.min(startDate);
                    } else if (endDate) {
                        start.max(new Date(endDate));
                    } else {
                        endDate = new Date();
                        start.max(endDate);
                        end.min(endDate);
                    }
                }
            }

            function endChange() {
                var endDate = end.value(),
                    startDate = start.value();
                window.livewire.emit('settoDate', {
                    ['toDateTime']: endDate
                });
                if (endDate) {
                    endDate = new Date(endDate);
                    endDate.setDate(endDate.getDate());
                    start.max(endDate);
                } else if (startDate) {
                    end.min(new Date(startDate));
                } else {
                    endDate = new Date();
                    start.max(endDate);
                    end.min(endDate);
                }
            }

            function compareDates(date, dates) {
                console.log(date)
                for (var i = 0; i < dates.length; i++) {
                    if (date >= dates[i][0] && date <= dates[i][1]) {
                        return true
                    }
                }
            }
            var start = $("#fromDateTime").kendoDatePicker({
                change: startChange,
                dates: dates,
                disableDates: function(date) {
                    var dates = $("#fromDateTime").data("kendoDatePicker").options.dates;
                    if (date && compareDates(date, dates)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }).data("kendoDatePicker");

            var end = $("#toDateTime").kendoDatePicker({
                change: endChange,
                dates: dates,
                disableDates: function(date) {
                    var dates = $("#fromDateTime").data("kendoDatePicker").options.dates;
                    if (date && compareDates(date, dates)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }).data("kendoDatePicker");

            start.max(end.value());
            end.min(start.value());
            window.addEventListener('setDatePicker', event => {
                console.log($("#toDateTime").length);

                function startChange() {
                    window.livewire.emit('setfromDate', {
                        ['fromDateTime']: start.value()
                    });
                    if ($("#toDateTime").length) {
                        var startDate = start.value(),
                            endDate = end.value();
                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate());
                            end.min(startDate);
                        } else if (endDate) {
                            start.max(new Date(endDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }
                }

                function endChange() {
                    var endDate = end.value(),
                        startDate = start.value();
                    window.livewire.emit('settoDate', {
                        ['toDateTime']: endDate
                    });
                    if (endDate) {
                        endDate = new Date(endDate);
                        endDate.setDate(endDate.getDate());
                        start.max(endDate);
                    } else if (startDate) {
                        end.min(new Date(startDate));
                    } else {
                        endDate = new Date();
                        start.max(endDate);
                        end.min(endDate);
                    }
                }

                var start = $("#fromDateTime").kendoDatePicker({
                    change: startChange,
                    dates: dates,
                    disableDates: function(date) {
                        var dates = $("#fromDateTime").data("kendoDatePicker").options.dates;
                        if (date && compareDates(date, dates)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }).data("kendoDatePicker");
                if ($("#toDateTime").length) {
                    var end = $("#toDateTime").kendoDatePicker({
                        change: endChange,
                        dates: dates,
                        disableDates: function(date) {
                            var dates = $("#fromDateTime").data("kendoDatePicker").options
                                .dates;
                            if (date && compareDates(date, dates)) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }).data("kendoDatePicker");
                    start.max(end.value());
                    end.min(start.value());
                }
            });

        })
    </script>
@endsection
