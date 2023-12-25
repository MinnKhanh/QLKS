<?php

namespace App\Http\Livewire\Admin\Statiscal;

use App\Exports\PaymentExport;
use App\Http\Livewire\Admin\Customer\BookingRoom;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\PayMent as ModelsPayMent;
use App\Models\PaymentBooking;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Payment extends Component
{
    use WithPagination;
    public $phone;
    public $cmtnd;
    public $type;
    public $typeTime;
    public $listBooking = [];
    protected $paginationTheme = 'bootstrap';
    public $customer = 0;
    public $listCustomer;
    public $dateCreate;
    public $month;

    public function render()
    {
        $this->updateUi();
        $list = $this->getList();
        $list =  $list->paginate(5);
        return view('livewire.admin.statiscal.payment', ['listPayMent' => $list]);
    }
    public function mount()
    {
        $this->listCustomer = Customer::get()->toArray();
    }
    public function updateUi()
    {
        $this->dispatchBrowserEvent('setSelect2');
    }
    public function updatingCmtnd()
    {
        $this->resetPage();
    }
    public function updatingPhone()
    {
        $this->resetPage();
    }
    public function updatingMonth()
    {
        $this->resetPage();
    }
    public function updatingCustomer()
    {
        $this->resetPage();
    }
    public function getList()
    {
        $list = ModelsPayMent::query()->with(['Customer']);
        if ($this->phone) {
            $list->where('phone', 'like', '%' . $this->phone . '%');
        }
        if ($this->cmtnd) {
            $list->where('cmtnd', 'like', '%' . $this->cmtnd . '%');
        }
        if ($this->month) {
            $list->whereMonth('created_at', $this->month);
        }
        if ($this->customer) {
            $list->whereHas('Customer', function ($q) {
                $q->where('id', $this->customer);
            });
            // dd($list->get()->toArray());
        }
        if ($this->dateCreate) {
            $list->whereDate('created_at', $this->dateCreate);
        }
        return $list->orderBy('id', 'desc');
    }
    public function getListBooking($id)
    {
        $idBooking = PaymentBooking::where('payment_id', $id)->pluck('booking_id');
        $this->listBooking = Booking::with(['Room'])->whereIn('id', $idBooking)->get()->toArray();
    }
    public function export()
    {
        $payment = $this->getList()->get();
        return Excel::download(new PaymentExport($payment), 'HOADON' . date('Y-m-d-His') . '.xlsx');
    }
}
