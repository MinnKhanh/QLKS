<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return view('user.room.index');
    }
    public function detail($room)
    {
        return view('user.room.detail', ['room' => $room]);
    }
    public function listRoom($type_id)
    {
        return view('user.room.list-room', ['type_id' => $type_id]);
    }
}
