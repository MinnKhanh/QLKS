@extends('user.layout.master')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('user.room.detail', ['idRoom' => $room])
@endsection
