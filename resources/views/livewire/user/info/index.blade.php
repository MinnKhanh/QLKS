@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush
<div>
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Thông tin cá nhân</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active">Thông tin cá nhân</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->


    <!--================Booking Tabel Area  =================-->
    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="list">
            <div class="section_title text-center">
                <h2 class="title_color">Thông tin người dùng</h2>
            </div>
            <div class="row accomodation_two list-room justify-content-start" style="padding:2rem;">
                <div class="col-6">
                    <div class="form-group row mb-4">
                        <label for="sell_date" class="col-2 col-form-label ">Code</label>
                        <div class="col-10">
                            <input type="text" id="cccd" class="form-control" wire:model.lazy="code">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="customer_name" class="col-2 col-form-label ">Họ tên
                            KH</label>
                        <div class="col-10">
                            <input name="customer_name" type="text" class="form-control" wire:model.lazy="name">
                            @error('customerName')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="customer_phone" class="col-2 col-form-label ">Điện
                            thoại</label>
                        <div class="col-10">
                            <input name="customer_phone" type="text" class="form-control" wire:model.lazy="phone">
                            @error('customerPhone')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="customer_address" class="col-2 col-form-label ">Ngày sinh</label>
                        <div class="col-10">
                            <input name="customer_address" type="date" class="form-control"
                                wire:model.lazy="birthDay">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row mb-4">
                        <label for="customer_sex" class="col-2 col-form-label ">Giới
                            tính</label>
                        <div class="col-10">
                            <select name="customer_sex" type="text"class="form-control" wire:model.lazy="gender">
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
                                wire:model.lazy="address">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="customer_address" class="col-2 col-form-label ">Email</label>
                        <div class="col-10">
                            <input name="customer_address" type="text" class="form-control"
                                wire:model.lazy="email">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="sell_date" class="col-3 col-form-label ">Số
                            CMTND/CCCD</label>
                        <div class="col-9">
                            <input type="text" id="cccd" class="form-control" wire:model.lazy="cmtnd">
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3 row justify-content-center">
                    <button wire:click="save" class="book_now_btn button_hover col-1">Lưu</button>
                </div>
            </div>
        </div>
    </section>
</div>
