<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
        $bookingInfo = Booking::where('id', $request->bookingid)
            ->first();
        // if (!$bookingInfo) {
        //     $bookingInfo = Booking::where('room_id', $request->bookingid)
        //         ->first();
        // }
        if ($bookingInfo)
            return view('admin.book-room.custom-room-booking', ['id' => $request->id, 'bookingId' => $request->bookingid ?? 0]);
        else return redirect()->route('admin.bookroom.create_info', ['id' => $request->id]);
    }
    public function checkout(Request $request)
    {
        return view('admin.book-room.checkout', ['id' => $request->id]);
    }

    public function orderByUser(Request $request)
    {
        return view('admin.book-room.order-by-user', ['id' => $request->id]);
    }
    public function print(Request $request){
        return view('admin.print-payment',['id'=>$request->id]);
    }
}
