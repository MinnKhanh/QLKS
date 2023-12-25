@extends('layouts.master')

@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('admin.customer.booking-room', ['idCustomer' => $id])
@endsection
