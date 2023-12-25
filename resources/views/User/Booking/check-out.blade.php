@extends('user.layout.master')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('user.booking.check-out', ['roomType' => $roomType, 'adult' => $adult, 'children' => $children, 'fromDateTime' => $fromDateTime, 'toDateTime' => $toDateTime, 'numberOfRoom' => $numberOfRoom])
@endsection
