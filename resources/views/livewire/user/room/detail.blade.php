@push('css')
    <style>
        .list-input {
            justify-content: center;
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
    </style>
@endpush
<div>
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">About Us</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">About</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid" src="{{ asset('user/image/about_bg.jpg') }}" alt="img">
                </div>
                <div class="col-md-8 d_flex flex-column align-items-center list-input">
                    {{-- <div class="room-booking"> --}}
                    <h3>Thông tin đặt phòng</h3>
                    <div class="input-book">
                        <div class="check-date row">
                            <label for="date-in">Check In:</label>
                            <input type="date" class="date-input" wire:model="fromDateTime" id="fromDateTime">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date row">
                            <label for="date-out">Check Out:</label>
                            <input type="date" class="date-input" wire:model="toDateTime" id="toDateTime">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="select-option row">
                            <label for="guest">Số người lớn:</label>
                            <input type="number" name="" id="">
                        </div>

                        <div class="select-option row">
                            <label for="guest">Số trẻ em:</label>
                            <input id="guest">
                        </div>
                    </div>
                    <button data-target="#modal-checkout" data-toggle="modal" type="button"
                        class="button_hover theme_btn_two">Đặt phòng</button>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->

    <!--================ Facilities Area  =================-->
    {{-- <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Royal Facilities</h2>
                <p>Who are in extremely love with eco friendly system.</p>
            </div>
            <div class="row mb_30">
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Restaurant</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Sports CLub</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-shirt"></i>Swimming Pool</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-car"></i>Rent a Car</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-construction"></i>Gymnesium</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>Bar</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <section class="facilities_area">
        <h2>Tiện nghi của phòng</h2>
    </section> --}}
    <!--================ Facilities Area  =================-->

    <!--================ Testimonial Area  =================-->
    <section class="testimonial_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Tiện nghi có săn của phòng</h2>
                <p>Đây là nhưng tiện nghi có săn của phòng hiện tại và bạn có thể đặt thêm rất nhiều tiện
                    nghi khác khi đến nhận phòng trong quá trình sử dụng phòng
                </p>
            </div>
            <div class="testimonial_slider row">
                <div class="col-4">
                    <h3 class="text-center">Dịch vụ</h3>
                    @forelse ($room['service'] as $item)
                        <div class="media testimonial_item text-center">
                            <div class="media-body">
                                <p>{{ $item['name'] }}</p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="col-4">
                    <h3 class="text-center">Tiện nghi</h3>
                    @forelse ($room['service'] as $item)
                        <div class="media testimonial_item text-center">
                            <div class="media-body">
                                <p>{{ $item['name'] }}</p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="col-4">
                    <h3 class="text-center">Cớ sở vật chất</h3>
                    @forelse ($room['service'] as $item)
                        <div class="media testimonial_item text-center">
                            <div class="media-body">
                                <p>{{ $item['name'] }}</p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!--================ Testimonial Area  =================-->

    {{-- modal service --}}
    {{-- <div class="form-group row pt-4">
        <div wire:ignore.self class="modal fade modal-info" id="modal-checkout" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Danh sách dịch vụ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <div class="form-group row">
                                <label for="SerialNumber" class="col-1 col-form-label text-right">Tên dịch
                                    vụ</label>
                                <div class="col-3">
                                    <input name="SerialNumber" type="text" class="form-control">
                                </div>
                                <label for="EngineNumber" class="col-1 col-form-label text-right ">Loại dịch
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
                                @forelse ($room['service'] as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['type_service'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td> <a class="btn btn-info btn-xs" wire:click="addService({{ $item['id'] }})"
                                                data-toggle="tooltip" target="_blank" data-original-title="Xem"><i
                                                    class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Trống</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
