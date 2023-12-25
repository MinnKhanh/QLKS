<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Enums\StatusBookingEnum;
use App\Enums\StatusRoomEnum;
use App\Enums\TypeBooking;
use App\Enums\TypeTimeEnum;
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
    public $typeTime = TypeTimeEnum::DAY;
    public $room;
    public $price;
    public $lateSurcharge;
    public $earlySurcharge;
    public $booking_id;
    public $listService;
    public $idBooking;
    public $startTime;
    public $endTime;
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
    public $numberOfAdults;
    public $numberOfChildren;
    public $hourIn;
    public $note;
    public $rentalTime = 1;
    public $isBooking = 0;
    public $deposit = 0;
    public $dates = [];
    public $typeBooking;

    protected $listeners = ['setfromDate', 'settoDate', 'setfromDateTime' => 'setfromDateTime', 'settoDateTime' => 'settoDateTime', 'updatePrice', 'updateTypeTime'];
    public function mount()
    {
        $this->room = Room::with(['Floor','Type'])->where('id', $this->idRoom)->first()->toArray();
        // dd($this->room['type']);
        $bookings = Booking::where('room_id', $this->idRoom)->where('type', TypeBooking::RESERVE)->where('status', StatusBookingEnum::PENDING)->orderBy('checkin_date', 'ASC')->get()->toArray();
        foreach ($bookings as $item) {
            $this->dates[] = [$item['checkin_date'], $item['checkout_date']];
        }
        $this->listService = Service::get()->toArray();
        $this->listCustomer = Customer::get();
        $this->status = $this->room['status'];
        $this->updatePrice();
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

    public function setfromDate($time)
    {
        $fromDate = date('Y-m-d', strtotime($time['fromDateTime']));
        if ($this->toDateTime) {
            $count = Booking::where('room_id', $this->idRoom)
                ->where('type', TypeBooking::RESERVE)
                ->where('status', StatusBookingEnum::PENDING)
                ->where('checkin_date', '>=', $fromDate)
                ->where('checkout_date', '<=', $this->toDateTime)
                ->count();
            if ($count) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Khoảng thời gian đã chọn có chứ lịch đã được đăng ký trước của phòng"]);
                return;
            }
        }
        $this->fromDateTime = date('Y-m-d', strtotime($time['fromDateTime']));
        $this->changeFromAndToDateTime();
    }
    public function settoDate($time)
    {
        $toDate = date('Y-m-d', strtotime($time['toDateTime']));
        if ($this->fromDateTime) {
            $count = Booking::where('room_id', $this->idRoom)
                ->where('type', TypeBooking::RESERVE)
                ->where('status', StatusBookingEnum::PENDING)
                ->where('checkin_date', '>=', $this->fromDateTime)
                ->where('checkout_date', '<=', $toDate)
                ->count();
            if ($count) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Khoảng thời gian đã chọn có chứ lịch đã được đăng ký trước của phòng"]);
                return;
            }
        }
        $this->toDateTime = date('Y-m-d', strtotime($time['toDateTime']));
        $this->changeFromAndToDateTime();
    }

    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
        $this->dispatchBrowserEvent('setDatePicker');
    }
    public function resetDataCustomer(){
         $this->customerName= null;
         $this->customerAddress= null;
         $this->customerDistrict= null;
         $this->customerCity= null;
         $this->customerCmtnd= null;
         $this->customerPhone= null;
         $this->customerSex= null;
         $this->customerCountry= null;
         $this->customerBirthDay= null;
    }
    public function addCustomer($id)
    {
        $this->customer = Customer::where('id', $id)->first();
        $this->customer_name = $this->customer['name'];
        $this->customer_code = $this->customer['code'];
        $this->customer_cmtnd = $this->customer['cmtnd'];
        $this->customer_phone = $this->customer['phone'];
    }
    public function changeNumberPeople(){
        if($this->numberOfAdults && $this->numberOfAdults > $this->room['type']['room_capacity']['number_of_adults']){
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Bạn đã nhập quá số người lớn phòng có thể chứa là: ". $this->room['type']['room_capacity']['number_of_adults']]);
            $this->numberOfAdults=$this->room['type']['room_capacity']['number_of_adults'];
            return;
        }
        if($this->numberOfChildren && $this->numberOfChildren > $this->room['type']['room_capacity']['number_of_children']){
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Bạn đã nhập quá số trẻ em phòng có thể chứa là: ". $this->room['type']['room_capacity']['number_of_children']]);
            $this->numberOfChildren=$this->room['type']['room_capacity']['number_of_children'];
            return;
        }
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
            'customerPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'customerCmtnd' => 'required',
            'customerSex' => 'required|numeric',
            'customerBirthDay' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $customer = new Customer();
            $customer->code = 'KH00'.Customer::get()->count();
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
            $this->resetDataCustomer();
            return;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Tạo thất bại"]);
            return;
        }
    }
    public function create()
    {
        if(!$this->customer){
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Vui lòng chọn khách hàng trước phi nhập phòng"]);
        }
        else{
        $this->validate([
            'typeTime' => 'required',
            'lateSurcharge' => 'required|numeric',
            'earlySurcharge' => 'required|numeric',
            'numberOfAdults' => 'required|numeric',
            'numberOfChildren' => 'required|numeric',
            'fromDateTime' => 'required',
            'toDateTime' => $this->typeTime == TypeTimeEnum::DAY ? 'required' : '',
            'customer_phone' => 'required',
            'customer_name' => 'required',
            'customer_code' => 'required',
            'customer_cmtnd' => 'required',
            'rentalTime' => 'required',
            'hourIn' => 'required',
        ]);
        try {
            DB::beginTransaction();
            // if ($this->isBooking) {
            //     Booking::where('room_id', $this->idRoom)->where('status', StatusBookingEnum::PENDING)
            //         ->where('type', TypeBooking::RESERVE)->whereDate('booking_date', '<=', date('Y-m-d'))->update(['status' => StatusBookingEnum::ACTIVE]);
            //     Room::where('id', $this->idRoom)->update(['status' => StatusRoomEnum::ACTIVE]);
            // } else {
            $isExists = Booking::where('customer_id', $this->customer['id'])->where('room_id', $this->idRoom)->where('status', 1)->first();
            if (!$isExists) {
                $booking = new Booking();
                $booking->customer_id = $this->customer['id'];
                $booking->room_id = $this->idRoom;
                $booking->note = $this->note;
                if ($this->typeBooking == TypeBooking::RESERVE) {
                    $booking->type = TypeBooking::RESERVE;
                    $booking->status = StatusBookingEnum::PENDING;
                } else {
                    $booking->type = TypeBooking::BOOKATHOTEL;
                    $booking->status = StatusBookingEnum::ACTIVE;
                    Room::where('id', $this->idRoom)->update(['status' => StatusRoomEnum::ACTIVE]);
                }
                $booking->checkin_date = $this->fromDateTime;
                $booking->checkout_date = $this->toDateTime;
                $booking->rental_time =  $this->rentalTime;
                $booking->hour_in = $this->hourIn;
                $booking->type_time = $this->typeTime;
                $booking->number_of_adults = $this->numberOfAdults;
                $booking->number_of_children = $this->numberOfChildren;
                $booking->deposit = $this->deposit ?? 0;
                $booking->save();
            } else {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Đã tồn tại"]);
                return;
            }
            // }
            DB::commit();
            return redirect()->route('admin.bookroom.custom_room_booking', ['id' => $this->idRoom, 'bookingid' => $booking->id]);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Tạo thất bại"]);
            return;
        }
    }
    }
    public function updateTypeTime()
    {
        if ($this->typeTime == TypeTimeEnum::NIGHT)
            $this->rentalTime = 1;
        $this->resetTime();
    }
    public function getCurrentTime()
    {
        $this->hourIn = Carbon::now()->format('H:i:s');
    }

    public function resetTime()
    {
        $this->fromDateTime = null;
        $this->toDateTime = null;
        $this->hourIn = null;
    }

    public function changeRentalTime()
    {
        if ($this->typeTime == TypeTimeEnum::DAY && $this->rentalTime && $this->fromDateTime) {
            $this->toDateTime = Carbon::parse($this->fromDateTime)->addDay($this->rentalTime)->format('Y-m-d');
        }
    }

    public function changeFromAndToDateTime()
    {
        if ($this->fromDateTime && $this->toDateTime) {
            $this->rentalTime = Carbon::parse($this->fromDateTime)->diffInDays(Carbon::parse($this->toDateTime));
        }
    }

    public function changeStatusRoom()
    {
        try {
            Room::where('id', $this->idRoom)->update(['status' => $this->status]);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Cập nhật thành công"]);
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Cập nhật thất bại"]);
        }
    }
}
