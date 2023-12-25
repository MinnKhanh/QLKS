@extends('layouts.master')


@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="p-3">
                <div class="card p-2">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="border-bottom-1 mb-4 font-weight-bold">Thông tin khách
                                hàng</h5>
                            <p class="fw-bold">Tên khách hàng: {{ $customerInfo['name'] }}</p>
                            <p>Điện thoại: {{ $customerInfo['phone'] }}</p>
                            <p>CCCD: {{ $customerInfo['cmtnd'] }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="border-bottom-1 mb-4 font-weight-bold">Thống kê chi phí
                            </h5>
                            <p>Tổng tiền phòng: {{ $totalPrice }}</p>
                            <p>Phí dịch vụ: {{ $totalPriceService }}</p>
                            <p>Phụ phí phát sinh: {{ $priceEarlyChager + $priceLateChager }}</p>
                            <p>Tiền đã trả: {{ $deposit }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="note" class="col-4 col-form-label pd-0">Ghi chú</label>
                <div class="col-12">
                    <textarea name="note" wire:model="note" type="text" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-striped table-sm table-bordered dataTable no-footer" cellspacing="0"
                    width="100%" role="grid" aria-describedby="category-table_info" style="width: 100%;">
                    <thead>
                        <tr role="row">
                            <th style="width:100px">#</th>
                            <th style="width:100px">Tên dịch vụ</th>
                            <th style="width:100px">Loại dịch vụ</th>
                            <th style="width:100px">Mô tả</th>
                            <th style="width:120px">Giá</th>
                            <th style="width:120px">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 0;
                        @endphp
                        @forelse ($services as $item)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $item['service']['name'] }}</td>
                                <td>{{ $item['service']['type']['name'] }}</td>
                                <td>{{ $item['service']['description'] }}</td>
                                <td>{{ $item['service']['price'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-6">
                    <p>Tổng tiền phải trả:
                        {{ $totalPrice + $priceEarlyChager + $priceLateChager + $totalPriceService - $deposit }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
