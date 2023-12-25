<?php

namespace App\Http\Livewire\Admin\Statiscal;

use App\Exports\BookingExpport;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomTypeDetail;
use App\Models\TypeRoom;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    public $typeRoom;
    public $dateIn;
    public $dateOut;
    public $type;
    public $typeTime;
    protected $paginationTheme = 'bootstrap';
    public $customer = 0;
    public $listCustomer;
    public $listRoom;
    public $mounth;

    public function mount()
    {
        $this->listCustomer = Customer::get()->toArray();
        $this->listRoom = RoomTypeDetail::with(['RoomCapacity', 'TypeRoom'])->get()->toArray();
    }
    public function updateUi()
    {
        $this->dispatchBrowserEvent('setSelect2');
    }
    public function updatingTypeRoom()
    {
        $this->resetPage();
    }
    public function updatingDateIn()
    {
        $this->resetPage();
    }
    public function updatingMounth()
    {
        $this->resetPage();
    }
    public function updatingDateOut()
    {
        $this->resetPage();
    }
    public function updatingCustomer()
    {
        $this->resetPage();
    }
    public function updatingTypeTime()
    {
        $this->resetPage();
    }
    public function updatingType()
    {
        $this->resetPage();
    }
    public function render()
    {
        $this->updateUi();
        $list = $this->getListBooking();
        // if ($list->count() > 5) {
        $list =  $list->paginate(5);
        // } else {
        //     $list = $list->get();
        // }
        return view('livewire.admin.statiscal.index', ['listBooking' => $list]);
    }
    public function getListBooking()
    {
        $list = Booking::query()->with(['Customer', 'Room']);
        // if ($this->Typeroom) {
        //     $list->where('room_id', $this->room);
        // }
        if ($this->dateIn) {
            $list->whereDate('checkin_date', '=', $this->dateIn);
        }
        if ($this->dateOut) {
            $list->whereDate('checkout_date', '>=', $this->dateOut);
        }
        if ($this->type) {
            $list->where('type', $this->type);
        }
        if ($this->typeTime) {
            $list->where('type_time', $this->typeTime);
        }
        if ($this->customer) {
            $list->where('customer_id', $this->customer);
            // dd($list->get()->toArray());
        }
        if ($this->typeRoom) {
            $list->whereHas('Room', function ($q) {
                $q->where('type_room', $this->typeRoom);
            });
        }
        return $list;
    }
    public function export()
    {
        $list = $this->getListBooking()->get();
        // dd($list);
        return Excel::download(new BookingExpport($list), 'DonDat' . date('Y-m-d-His') . '.xlsx');
    }
}
