@extends('layouts.master')

@section('title', 'Báo cáo sửa chữa thông thường')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('admin.room.index')
@endsection
