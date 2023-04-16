<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Enums\StatusBookingEnum;
use App\Enums\StatusRoomEnum;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\ConversionTime;
use App\Models\Customer;
use App\Models\Price;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class CreateInfo extends Component
{
    public $fromDateTime;
    public $toDateTime;
    public $status;
    public $listCustomer;
    public $customer;
    public $idRoom;
    public $typeTime;
    public $room;
    public $price;
    public $lateSurcharge;
    public $earlySurcharge;
    public $booking_id;
    public $listService;
    public $idBooking;
    public $startTime;
    public $endTime;
    public $statusRoom;
    public $customerCmtnd = null;
    public $customerName = null;
    public $customerPhone = null;
    public $customerCountry = null;
    public $customerSex = null;
    public $customerCity = null;
    public $customerDistrict = null;
    public $customerBirthDay = null;
    public $customerAddress = null;
    public $customer_phone;
    public $customer_name;
    public $customer_code;
    public $customer_cmtnd;
    public $numberOfPeople;
    public $note;
    public $rentalTime;

    protected $listeners = ['setfromDateTime' => 'setfromDateTime', 'settoDateTime' => 'settoDateTime', 'updatePrice'];
    public function mount()
    {
        $this->listService = Service::get()->toArray();
        $this->listCustomer = Customer::get();
        $this->room = Room::with('Floor')->where('id', $this->idRoom)->first()->toArray();
        $this->status = $this->room['status'];
    }
    public function updatePrice()
    {
        if ($this->typeTime) {
            $prices = Price::where('type_room_detail_id', $this->room['type_room'])->where('type_price', $this->typeTime)->first()->toArray();
            $this->price = $prices['price'];
            $this->lateSurcharge = $prices['late_surcharge'];
            $this->earlySurcharge = $prices['early_surcharge'];
        }
    }
    public function render()
    {
        $this->updateUI();
        // $this->customer = Customer::where('id', 1)->first()->toArray();
        // $this->status = 1;
        return view('livewire.admin.book-room.create-info');
    }
    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
    }
    public function setfromDateTime($time)
    {

        // $this->fromDateTime = date('Y-m-d H:i:s', strtotime($time['fromDateTime']));
    }
    public function settoDateTime($time)
    {
        // $this->toDateTime = date('Y-m-d H:i:s', strtotime($time['toDateTime']));
    }
    public function addCustomer($id)
    {
        $this->customer = Customer::where('id', $id)->first();
        $this->customer_name = $this->customer['name'];
        $this->customer_code = $this->customer['code'];
        $this->customer_cmtnd = $this->customer['cmtnd'];
        $this->customer_phone = $this->customer['phone'];
    }
    public function addService($id)
    {
        $service = Service::where('id', $id)->first()->toArray();
        $serviceInRoom = BookingService::where('booking_id', $this->idBooking)->where('service_id', $service->id)->first();
        if ($serviceInRoom) {
            $serviceInRoom->quantityb = $serviceInRoom->quantity + 1;
        } else {
            $serviceInRoom = new BookingService();
            $serviceInRoom->booking_id = $this->idBooking;
            $serviceInRoom->service_id = $service->id;
            $serviceInRoom->quantity = 1;
        }
        $serviceInRoom->save();
    }
    public function createCustomer()
    {
        $this->validate([
            'customerName' => 'required',
            'customerCountry' => 'required',
            'customerAddress' => 'required',
            'customerCity' => 'required',
            'customerDistrict' => 'required',
            'customerPhone' => 'required',
            'customerCmtnd' => 'required',
            'customerSex' => 'required',
            'customerBirthDay' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $customer = new Customer();
            $customer->code = '111';
            $customer->name = $this->customerName;
            $customer->address = $this->customerAddress;
            $customer->district = $this->customerDistrict;
            $customer->city = $this->customerCity;
            $customer->cmtnd = $this->customerCmtnd;
            $customer->phone = $this->customerPhone;
            $customer->gender = $this->customerSex;
            $customer->country = $this->customerCountry;
            $customer->birth_day = $this->customerBirthDay;
            $customer->save();
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Tạo thành công"]);
            $this->listCustomer = Customer::get();
            return;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Tạo thất bại"]);
            return;
        }
    }
    public function create()
    {
        $this->validate([
            'typeTime' => 'required',
            'lateSurcharge' => 'required',
            'earlySurcharge' => 'required',
            'numberOfPeople' => 'required',
            'fromDateTime' => 'required',
            'customer_phone' => 'required',
            'customer_name' => 'required',
            'customer_code' => 'required',
            'customer_cmtnd' => 'required',
            'rentalTime' => 'required',
        ]);
        try {
            DB::beginTransaction();

            $isExists = Booking::where('customer_id', $this->customer['id'])->where('room_id', $this->idRoom)->where('status', 1)->first();
            if (!$isExists) {
                $booking = new Booking();
                $booking->customer_id = $this->customer['id'];
                $booking->room_id = $this->idRoom;
                $booking->note = $this->note;
                $booking->checkin_date = Carbon::parse($this->fromDateTime)->toDateTimeString();
                $booking->rental_time = $this->rentalTime;
                $booking->type_time = $this->typeTime;
                $booking->status = StatusBookingEnum::ACTIVE;
                $booking->number_of_guests = $this->numberOfPeople;
                $booking->save();
                Room::where('id', $this->idRoom)->update(['status' => StatusRoomEnum::ACTIVE]);
                DB::commit();
            } else {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Đã tồn tại"]);
                return;
            }
            return redirect()->route('admin.bookroom.custom_room_booking', ['id' => $this->idRoom]);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Tạo thất bại"]);
            return;
        }
    }
}
