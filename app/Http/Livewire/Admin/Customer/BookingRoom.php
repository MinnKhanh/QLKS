<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Booking;
use App\Models\Customer;
use Livewire\Component;

class BookingRoom extends Component
{
    public $customerInfo;
    public $idCustomer;
    public $listBooking;

    public function mount(){
        $this->customerInfo = Customer::where('id', $this->idCustomer)->first();
        $this->listBooking=Booking::where('customer_id', $this->idCustomer)
        ->where('status', 1)->with(['BookingService','Room'])
        ->get();
        // dd($this->listBooking);
    }

    public function render()
    {
        return view('livewire.admin.customer.booking-room');
    }
}
