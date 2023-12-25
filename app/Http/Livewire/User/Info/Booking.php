<?php

namespace App\Http\Livewire\User\Info;

use App\Models\Booking as ModelsBooking;
use App\Models\Customer;
use Livewire\Component;

class Booking extends Component
{
    public $listBooking;

    public function mount(){
        $customer=Customer::where('account_id', auth()->user()->id)->first();
        $this->listBooking= ModelsBooking::with(['Customer', 'Room'])->where('customer_id', $customer->id)->get()->toArray();
    }
    public function render()
    {
        return view('livewire.user.info.booking');
    }
}
