@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('admin.print-payment', ['idPayment' => $id])
@endsection
