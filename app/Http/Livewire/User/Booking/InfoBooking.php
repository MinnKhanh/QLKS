<?php

namespace App\Http\Livewire\User\Booking;

use App\Models\Booking;
use App\Models\Customer;
use Livewire\Component;

class InfoBooking extends Component
{
    public $idCustomer;
    public $idBooking;
    public $customer;
    public $listBooking;

    public function mount(){
        // dd($this->listBooking);
        $this->customer = Customer::where('id',$this->idCustomer)->first()->toArray();
        $this->listBooking=Booking::with(['Room'])->whereIn('id',$this->idBooking)->get()->toArray();
    }
    public function render()
    {
        return view('livewire.user.booking.info-booking');
    }
}
