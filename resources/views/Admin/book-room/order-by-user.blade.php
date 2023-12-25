@extends('layouts.master')


@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('admin.book-room.order-by-user', ['idCustomer' => $id])
@endsection
