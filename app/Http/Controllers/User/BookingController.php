<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function checkOut(Request $request, $id)
    {
        // dd(['roomType' => $id, 'adult' => $request->adult, 'children' => $request->children]);
        return view('user.booking.check-out', [
            'roomType' => $id, 'adult' => $request->adult,
            'children' => $request->children,
            'fromDateTime' => $request->fromDateTime,
            'toDateTime' => $request->toDateTime,
            'numberOfRoom' => $request->numberOfRoom
        ]);
    }
    public function print(Request $request){
        return view('user.print_payment',['idCustomer'=>$request->idcustomer,'idBooking'=>$request->idbooking]);
    }
    public function infoBooking(Request $request){
        return view('user.booking.info-booking',['idCustomer'=>$request->idcustomer,'idBooking'=>$request->idbooking]);
    }
}
