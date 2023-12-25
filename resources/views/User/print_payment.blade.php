@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('user.print-payment',['idCustomer' => $idCustomer, 'idBooking' => $idBooking])
@endsection
