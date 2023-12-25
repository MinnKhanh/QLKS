<?php

namespace App\Http\Livewire\User;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\PayMent;
use App\Models\PaymentBooking;
use Livewire\Component;

class PrintPayment extends Component
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
        return view('livewire.user.print-payment');
    }
}
