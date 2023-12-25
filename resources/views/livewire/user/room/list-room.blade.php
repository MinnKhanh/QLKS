@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .book_tabel_item .form-group .input-group .form-control {
            background: white;
        }

        .room-item {
            margin-bottom: 20px;
        }

        .list-room {
            justify-content: center
        }

        .room-img {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 300px;
        }

        .room-img .img {
            width: 100%;
            height: 88%;
        }

        .but-detail {
            border: none;
            outline: none;
            color: gray;
            border-radius: 5px;
            width: 100%;
            margin-top: 5px;
            height: 12%;
        }

        .room-img div img {
            height: 100%;
            width: 20rem;
        }

        .room-body {
            padding: 0.5rem 1rem 1rem 2rem;
            overflow: hidden;
            box-sizing: border-box;
            flex: 1;
            border: 2px solid rgba(128, 128, 128, 0.302);
            border-radius: 7px;
            margin-left: 10px;
        }

        .content {
            flex: 1;
            padding-top: 10px;
        }

        .col-4 {
            padding: 0px;
        }

        .label {
            justify-content: start;
            margin-bottom: 10px;
            border-bottom: 2px solid;
            padding-bottom: 10px;
        }

        .room-item {
            width: 100%;
            margin-bottom: 2rem;
        }

        p {
            font-size: 14px;
            font-family: Godwit, MuseoSans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;
            font-weight: 500;
            line-height: 20px;
            margin-left: 10px;
            white-space: pre-wrap;
            word-wrap: break-word;
            margin-bottom: 0px;
        }

        .info-book {
            padding: 10px;
        }

        .book_tabel_item .form-group .input-group .form-control {
            padding: 0px;
        }

        #fromDateTime,
        #toDateTime {
            padding-left: 10px;
        }

        .but-book {
            border: none;
            background-color: rgb(255, 94, 31);
            color: white !important;
            font-family: Godwit, MuseoSans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;
            font-size: 0.875rem;
            font-weight: 700;
            text-align: center;
            border-radius: 5px;
            padding: 10px;
            text-decoration: none;
        }

        .item {
            margin-bottom: 10px;
        }

        .info-detail {
            padding: 0px;
            align-items: center;
            margin-right: 10px;
        }

        .list {
            padding: 0px 1rem 0px 1rem;
        }
    </style>
@endpush
<div>
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Danh sách phòng</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active">Loại Phòng</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Booking Tabel Area =================-->
    <section class="hotel_booking_area mt-5">
        <div class="container">
            <div class="row hotel_booking_table">
                <div class="col-md-3">
                    <h2 class="text-center">Phòng Hiện<br> Có Sẵn</h2>
                </div>
                <div class="col-md-9">
                    <div class="boking_table">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="book_tabel_item">
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <input type='date' id="fromDateTime" wire:model="fromDateTime"
                                                class="form-control" placeholder="Arrival Date" />
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <input class="form-control" class="adult" wire:model="adult"
                                            placeholder="Số người lớn" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="book_tabel_item">
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <input type='date' id="toDateTime" wire:model="toDateTime"
                                                class="form-control" placeholder="Departure Date" />
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <input class="form-control" type="number" class="wide" wire:model="children"
                                            placeholder="Số trẻ em">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group" style="margin-bottom: 10px;">
                                    <input class="form-control" type="number" class="wide" wire:model="numberOfRoom"
                                        placeholder="Số phòng">
                                </div>
                                <div class="book_tabel_item">
                                    <button wire:click="search" class="book_now_btn button_hover">Tìm Kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Booking Tabel Area  =================-->
    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="list">
            <div class="section_title text-center">
                <h2 class="title_color">Danh sách các loại phòng</h2>
                <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast,</p>
            </div>
            <div class="row accomodation_two list-room justify-content-start">
                @forelse ($listTypeDetail as $item)
                    <div class="d-flex room-item col-6">
                        <div class="room-img">
                            <div class="img"><img
                                    src="{{ asset('storage/room/' . ($item['img'] ? $item['img'][0]['path'] : '')) }}"
                                    alt=""></div>
                            <button class="but-detail">Xem chi tiết</button>
                        </div>
                        <div class="d-flex flex-column room-body">
                            <div class="type d-flex flex-column mb-2">
                                {{-- <h4 class="mb-0">{{ $item['type_room']['name'] }}-{{ $item['name'] }} --}}
                                {{-- </h4> --}}
                                {{-- <p class="ml-0">{{ $item['floor']['name'] }}</p> --}}
                            </div>
                            <div class="label d-flex justify-content-between">
                                <div class="col-4 pd-0 d-flex">
                                    <i class="bi bi-hospital"></i>
                                    <p>{{ $item['room_capacity']['number_of_bed'] }} Giường</p>
                                </div>
                                <div class="col-4 pd-0 d-flex">
                                    <i class="bi bi-person"></i>
                                    <p>{{ $item['room_capacity']['max_capacity'] }} khách</p>
                                </div>
                                <div class="col-4 pd-0 d-flex">
                                    <p>(1 phòng trống)</p>
                                </div>
                            </div>
                            <div class="d-flex content">
                                <div class="col-4 pd-0 d-flex flex-column content-item">
                                    @forelse ($item['service'] as $itemService)
                                        <div class="item d-flex align-items-center">
                                            @if ($loop->first)
                                                <i class="bi bi-wrench"></i>
                                            @else
                                                <p>-</p>
                                            @endif

                                            <p>{{ $itemService['name'] }}</p>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="col-4 pd-0 d-flex flex-column content-item">
                                    @forelse ($item['convenient'] as $itemConv)
                                        <div class="item d-flex align-items-center">
                                            @if ($loop->first)
                                                <i class="bi bi-sun"></i>
                                            @else
                                                <p>-</p>
                                            @endif
                                            <p>{{ $itemConv['name'] }}</p>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                {{-- <div class="col-4 pd-0 d-flex flex-column content-item">
                                    <div class="item d-flex align-items-center">
                                        @if ($loop->first)
                                            <i class="bi bi-gift"></i>
                                        @else
                                            <p>-</p>
                                        @endif
                                        <p>{{ $itemConv['name'] }}</p>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="info-book d-flex">
                                <div class="info-detail col-8">
                                    <p class="pd-0">Thanh toán khi nhận phòng Đặt KHÔNG cần thanh toán trước!</p>
                                </div>
                                @if ($check)
                                    <a href="{{ route('booking.check_out', [
                                        'roomType' => $item['id'],
                                        'adult' => $adult,
                                        'children' => $children,
                                        'fromDateTime' => $fromDateTime,
                                        'toDateTime' => $toDateTime,
                                        'numberOfRoom' => $numberOfRoom,
                                    ]) }}"
                                        class="button but-book col-4">Đặt ngay</a>
                                @else
                                    <button wire:click="showAlert" style="background-color: gray"
                                        class="button but-book col-4">Đặt ngay</button>
                                @endif

                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
                {{-- @empty
                @endforelse --}}
            </div>
        </div>
    </section>
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
