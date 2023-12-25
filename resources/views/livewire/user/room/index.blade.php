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

    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Danh sách loại phòng có trong khách sạn</h2>
                <p>Các phòng có nội thất nổi bật tiện nghi phục vụ và thỏa mãn nhu cầu của bạn tốt nhất tạo ra nhưng
                    trải nghiệm tuyệt vời</p>
            </div>
            <div class="row mb_30">
                @forelse ($listRoomType as $item)
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img style="height: 246px;width: 260px;"
                                    src="{{ asset('storage/room/' . ($item['img'] ? $item['img'][0]['path'] : '')) }}"
                                    alt="">
                                <a href="{{ route('room.list_room', ['type_id' => $item['id']]) }}"
                                    class="btn theme_btn button_hover">Đặt ngay</a>
                            </div>
                            <a href="#">
                                <h4 class="sec_h4">{{ $item['name'] }}</h4>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!--================ Accomodation Area  =================-->
    <!--================Booking Tabel Area =================-->
    {{-- <section class="hotel_booking_area mt-5">
        <div class="container">
            <div class="row hotel_booking_table">
                <div class="col-md-3">
                    <h2>Book<br> Your Room</h2>
                </div>
                <div class="col-md-9">
                    <div class="boking_table">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="book_tabel_item">
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker11'>
                                            <input type='text' class="form-control" placeholder="Arrival Date"/>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" placeholder="Departure Date"/>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="book_tabel_item">
                                    <div class="input-group">
                                        <select class="wide">
                                            <option data-display="Adult">Adult</option>
                                            <option value="1">Old</option>
                                            <option value="2">Younger</option>
                                            <option value="3">Potato</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <select class="wide">
                                            <option data-display="Child">Child</option>
                                            <option value="1">Child</option>
                                            <option value="2">Baby</option>
                                            <option value="3">Child</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="book_tabel_item">
                                    <div class="input-group">
                                        <select class="wide">
                                            <option data-display="Child">Number of Rooms</option>
                                            <option value="1">Room 01</option>
                                            <option value="2">Room 02</option>
                                            <option value="3">Room 03</option>
                                        </select>
                                    </div>
                                    <a class="book_now_btn button_hover" href="#">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--================Booking Tabel Area  =================-->
    <!--================ Accomodation Area  =================-->
    {{-- <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Danh sách các loại phòng</h2>
                <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast,</p>
            </div>
            <div class="row accomodation_two">
                @forelse ($listRoomType as $item)
                <div class="col-lg-3 col-sm-6">
                    <div class="accomodation_item text-center">
                        <div class="hotel_img">
                            <img src="{{asset('user/image/room1.jpg')}}" alt="">
                            <a href="#" class="btn theme_btn button_hover">Đặt ngay</a>
                        </div>
                        <a href="#"><h4 class="sec_h4">{{$item['name']}}</h4></a>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </section> --}}
</div>
