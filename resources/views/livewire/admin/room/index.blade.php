  @push('css')
      <style>
          .item {
              height: 50px;
              background-color: red;
              box-sizing: border-box;
          }

          .row {
              margin: 0px;
          }
      </style>
  @endpush
  <div class="page-content fade-in-up">
      <div class="page-content fade-in-up">
          <div class="ibox">
              <div class="ibox-head">
                  <div class="ibox-title">Quản lý danh sách khách hàng</div>
              </div>
              <div class="ibox-body">
                  {{-- <div>
                      <div class="form-group row">
                          <label for="CustomerName" class="col-1 col-form-label">Họ và tên</label>
                          <div class="col-3">
                              <input id="CustomerName" name="CustomerName" type="text" class="form-control"
                                  value="" wire:model.debounce.1000ms="searchName">
                          </div>
                          <label for="CustomerAdress" class="col-1 col-form-label">Địa chỉ</label>
                          <div class="col-3">
                              <input id="CustomerAdress" name="CustomerAdress" type="text" class="form-control"
                                  value="" wire:model.debounce.1000ms="searchAddress">
                          </div>
                          <label for="CustomerPhone" class="col-1 col-form-label">Số điện thoại</label>
                          <div class="col-3">
                              <input id="CustomerPhone" name="CustomerPhone" type="number" class="form-control"
                                  value="" wire:model.debounce.1000ms="searchPhone">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Birthday" class="col-1 col-form-label">Ngày sinh</label>
                          <div class="col-3">
                              <span class="k-widget k-datepicker k-header form-control input-date-kendo"
                                  style=""><span class="k-picker-wrap k-state-default"><input type="text"
                                          id="transactionDate" class="form-control input-date-kendo k-input"
                                          max="2023-03-19" wire:model.debounce.1000ms="searchBirthday"
                                          data-role="datepicker" role="combobox" aria-expanded="false"
                                          aria-owns="transactionDate_dateview" aria-disabled="false"
                                          style="width: 100%;"><span unselectable="on" class="k-select"
                                          aria-label="select" role="button"
                                          aria-controls="transactionDate_dateview"><span
                                              class="k-icon k-i-calendar"></span></span></span></span>
                          </div>
                          <label for="Sex" class="col-1 col-form-label">Giới tính</label>
                          <div class="col-3">
                              <select id="Sex" name="Sex" type="text" class="form-control" value=""
                                  wire:model.debounce.1000ms="searchSex">
                                  <option value="" selected="">Tất cả</option>
                                  <option value="1">Nam</option>
                                  <option value="2">Nữ</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group row justify-content-center">
                          <div class="col-1">
                          </div>
                      </div>
                  </div> --}}
                  <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer d-flex">
                      {{-- <div class="row">
                          <div class="col-sm-12">
                              <div id="category-table_filter" class="dataTables_filter">
                                  <a href="http://localhost/headvn/public/khachhang/themmoi" class="btn btn-primary"><i
                                          class="fa fa-plus"></i>
                                      Thêm mới</a>
                                  <button data-target="#ModalExport" data-toggle="modal" type="button"
                                      class="btn btn-warning add-new"><i class="fa fa-file-excel-o"></i> Export
                                      file</button>
                                  <button type="button" class="btn btn-info add-new" data-toggle="modal"
                                      data-target="#modal-form-import-cnbh"><i class="fa fa-upload"
                                          aria-hidden="true"></i>
                                      IMPORT CNBH
                                  </button>
                              </div>
                          </div>
                      </div> --}}
                      <div class="col-1 row flex-column">
                          <div class="col-0-5 mb-1 ml-1 item border-box">Tầng 1</div>
                          <div class="col-0-5 mb-1 ml-1 item border-box">Tầng 1</div>
                          <div class="col-0-5 mb-1 ml-1 item border-box">Tầng 1</div>
                      </div>
                      <div class="col-11 row">
                          {{-- <div class="col-sm-12 table-responsive">
                              <table class="table table-striped table-sm table-bordered dataTable no-footer"
                                  id="category-table" cellspacing="0" width="100%" role="grid"
                                  aria-describedby="category-table_info" style="width: 100%;">
                                  <thead>
                                      <tr role="row">
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" wire:click="sorting('code')"
                                              style="width: 7%;">ID
                                          </th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 10%;"
                                              wire:click="sorting('name')">Họ tên</th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 10%;"
                                              wire:click="sorting('address')">Địa chỉ</th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 10%;"
                                              wire:click="sorting('phone')">SĐT</th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 7%;"
                                              wire:click="sorting('birthday')">Ngày sinh</th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 5%;"
                                              wire:click="sorting('sex')">Giới tính</th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 7%;"
                                              wire:click="sorting('job')">Nghề nghiệp</th>
                                          <th class="sorting" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 7%;"
                                              wire:click="sorting('point')">Tích điểm</th>
                                          <th class="sorting_desc" tabindex="0" aria-controls="category-table"
                                              rowspan="1" colspan="1" style="width: 8%;"
                                              wire:click="sorting('created_at')">Ngày tạo</th>
                                          <th tabindex="0" aria-controls="category-table" rowspan="1"
                                              colspan="1" style="width: 7%;">Thao tác</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>JWL5R</td>
                                          <td>Prof. Blaise Keebler Sr.</td>
                                          <td>767 Joy Groves
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/1"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/1"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/1"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(1)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>PTIQ6</td>
                                          <td>Nathanial Mraz IV</td>
                                          <td>823 Justyn View
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/2"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/2"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/2"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(2)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>CGDGT</td>
                                          <td>Eliezer Boyle</td>
                                          <td>4765 Athena Mountain
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/3"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/3"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/3"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(3)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>2XIDQ</td>
                                          <td>Annetta Conn</td>
                                          <td>565 Goodwin Extensions Apt. 536
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/4"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/4"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/4"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(4)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>2AQSW</td>
                                          <td>Alfred Wintheiser</td>
                                          <td>1326 Hessel Highway Suite 496
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/5"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/5"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/5"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(5)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>INB9A</td>
                                          <td>Ms. Katrine Kunde Jr.</td>
                                          <td>1636 Feest Tunnel
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/6"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/6"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/6"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(6)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>WN8PF</td>
                                          <td>Triston Schmitt</td>
                                          <td>50400 Duncan River
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/7"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/7"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/7"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(7)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>VW5D0</td>
                                          <td>Palma Huels</td>
                                          <td>542 Collins Mission
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/8"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/8"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/8"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(8)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>KDRLF</td>
                                          <td>Mr. Consuelo Klocko</td>
                                          <td>436 Cordia Square Apt. 199
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/9"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/9"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/9"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(9)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>LREJ2</td>
                                          <td>Dr. Kylie Leuschke</td>
                                          <td>755 Griffin Stravenue Apt. 038
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/10"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/10"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/10"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(10)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>LUMNK</td>
                                          <td>Miss Tess Durgan DDS</td>
                                          <td>9000 Hailee Ports Apt. 564
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/11"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/11"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/11"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(11)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>Q2HMS</td>
                                          <td>Martin Doyle PhD</td>
                                          <td>404 Wiza Gardens
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/12"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/12"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/12"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(12)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>BZOOF</td>
                                          <td>Ms. Reina Kozey</td>
                                          <td>785 Ora Way Suite 730
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/13"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/13"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/13"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(13)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>VVRVX</td>
                                          <td>Kris Swaniawski</td>
                                          <td>1903 Grant Port
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/14"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/14"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/14"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(14)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                      <tr data-parent="" data-index="1" role="row" class="odd">
                                          <td>V3AY2</td>
                                          <td>Abigayle Fritsch</td>
                                          <td>510 Gutkowski Knoll Suite 214
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>0</td>
                                          <td>2023-03-18 23:41:55</td>
                                          <td class="text-center">
                                              <a href="http://localhost/headvn/public/khachhang/xemchitiet/15"
                                                  class="btn btn-warning btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Xem"><i class="fa fa-eye font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/suathongtin/15"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Sửa"><i class="fa fa-pencil font-14"></i></a>
                                              <a href="http://localhost/headvn/public/khachhang/doiquatang/15"
                                                  class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip"
                                                  data-original-title="Quà tặng"><i
                                                      class="fa fa-gift font-14"></i></a>
                                              <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                  class="btn btn-danger delete-category btn-xs m-r-5"
                                                  data-original-title="Xóa" wire:click="deleteId(15)"><i
                                                      class="fa fa-trash font-14"></i></a>

                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div> --}}
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>
                          <div class="col-1 mb-1 ml-1 item border-box">Phong 1</div>

                      </div>
                      {{-- <nav class="row mt-3">
                          <div class="col-md-6 d-flex align-items-center">
                              <span>1 - 15 / 15 item</span>
                          </div>
                          <div class="col-md-6 text-right">
                              <ul class="pagination m-0 justify-content-end">

                                  <li class="page-item disabled" aria-disabled="true" aria-label="« Trang sau">
                                      <span class="page-link" aria-hidden="true">&lt;</span>
                                  </li>





                                  <li class="page-item active" wire:key="paginator-page-1" aria-current="page"><span
                                          class="page-link">1</span></li>


                                  <li class="page-item disabled" aria-disabled="true" aria-label="Trang trước »">
                                      <span class="page-link" aria-hidden="true">&gt;</span>
                                  </li>
                              </ul>

                          </div>
                      </nav> --}}


                  </div>
              </div>
          </div>
          <div wire:ignore.self="" class="modal fade" id="ModalExport" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                      </div>
                      <div class="modal-body">
                          <p>Bạn có muốn xuất file không?</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary close-btn"
                              data-dismiss="modal">Đóng</button>
                          <button type="button" wire:click.prevent="export()" class="btn btn-primary close-modal"
                              data-dismiss="modal">Đồng ý</button>
                      </div>
                  </div>
              </div>
          </div>
          <div wire:ignore.self="" class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-backdrop fade in" style="height: 100%;"></div>
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h2>
                      </div>
                      <div class="modal-body">
                          <p>Bạn có chắc chắn muốn xóa</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary close-btn"
                              data-dismiss="modal">Đóng</button>
                          <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                              data-dismiss="modal">Xóa</button>
                      </div>
                  </div>
              </div>
          </div>
          <div wire:ignore.self="" class="modal fade" id="modal-form-import-cnbh" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Import chứng nhận bảo hành</h5>
                      </div>
                      <div class="modal-body">
                          <h5>Chọn file để import</h5>
                          <div class="mt-3">
                              <input type="file" class="form-control" wire:model.defer="fileCNBH">
                          </div>
                          <div class="mt-5">
                              <a class="text-primary" wire:click="downloadExampleCNBH_Xe()"><u>Tải file mẫu tại đây
                                      !</u></a>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" id="close-modal-import"
                              data-dismiss="modal">Thoát</button>
                          <button type="button" class="btn btn-primary" wire:click.prevent="importCNBH()">Đồng
                              ý</button>
                      </div>
                  </div>
              </div>
          </div>

          <script>
              window.livewire.on('close-modal-import-cnbh', () => {
                  document.getElementById('modal-form-import-cnbh').click();
              });
          </script>
      </div>

      <!-- Livewire Component wire-end:EmrXG1mODRYvjcyJApE5 -->
  </div>
  @push('modal')
  @endpush
