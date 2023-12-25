<?php

namespace App\Http\Livewire\Admin;

use App\Models\Booking;
use App\Models\PayMent;
use App\Models\PaymentBooking;
use Livewire\Component;

class PrintPayment extends Component
{
    public $idPayment;
    public $payment;
    public $listBooking;

    public function mount(){
        $this->payment = PayMent::with(['Customer'])->where('id',$this->idPayment)->first()->toArray();
        $ids=PaymentBooking::where('payment_id',$this->idPayment)->pluck('booking_id');
        $this->listBooking=Booking::with(['Room'])->whereIn('id',$ids)->get()->toArray();
        // dd($this->listBooking);

    }
    public function render()
    {
        return view('livewire.admin.print-payment');
    }
}
