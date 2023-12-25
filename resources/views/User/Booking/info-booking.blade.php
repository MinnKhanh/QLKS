@extends('user.layout.master')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('user.booking.info-booking', ['idCustomer' => $idCustomer, 'idBooking' => $idBooking])
@endsection
