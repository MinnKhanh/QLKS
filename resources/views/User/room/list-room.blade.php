@extends('user.layout.master')
@section('css')
    <link href="{{ asset('assets/css/table-common.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @livewire('user.room.list-room', ['typeId' => $type_id])
@endsection
