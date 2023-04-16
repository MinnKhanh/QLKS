<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookRoomController extends Controller
{
    public function createInfo(Request $request)
    {
        return view('admin.book-room.create-info', ['id' => $request->id]);
    }
    public function create()
    {
        return view('admin.book-room.create');
    }
    public function listRoom()
    {
        return view('admin.book-room.list-room');
    }
    public function customRoomBooking(Request $request)
    {
        return view('admin.book-room.custom-room-booking', ['id' => $request->id]);
    }
}
