<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Enums\TypeTimeEnum;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\ConversionTime;
use App\Models\Customer;
use App\Models\Price;
use App\Models\Room;
use App\Models\Service;
use App\Models\TimeLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class CustomRoomBooking extends Component
{
    public $idRoom;
    public $bookingInfo;
    public $roomInfo;
    public $customerInfo;
    public $services;
    public $prices;
    public $price;
    public $lateSurcharge;
    public $earlySurcharge;
    public $rentalTime;
    public $checkInDateTime;
    public $checkOutDateTime;
    public $listServices;
    public $typeTime;
    public $totalPrice;
    public $totalSurcharge;
    public $totalPriceService;
    public $priceLateChager = 0;
    public $priceEarlyChager = 0;
    public $bookinDate;

    public function mount()
    {
        $this->roomInfo = Room::with('Floor', 'Type')->where('id', $this->idRoom)->first()->toArray();
        // dd($this->roomInfo);
        $this->bookingInfo = Booking::where('room_id', $this->idRoom)->where('status', 1)->first();
        $this->customerInfo = Customer::where('id', $this->bookingInfo['customer_id'])->first();
        $this->services = BookingService::with('Service')->where('booking_id', $this->bookingInfo['id'])->get()->toArray();
        $this->prices = Price::where('type_room_detail_id', $this->roomInfo['type_room'])
            ->where('type_price', $this->bookingInfo['type_time'])->first()->toArray();
        $this->price = $this->prices['price'];
        $this->lateSurcharge = $this->prices['late_surcharge'];
        $this->earlySurcharge = $this->prices['early_surcharge'];
        $this->rentalTime = $this->bookingInfo['rental_time'];
        $this->checkInDateTime = $this->bookingInfo['checkin_date'];
        $this->listServices = Service::with('Type')->get()->toArray();
        $this->typeTime =  $this->bookingInfo['type_time'];
        $this->totalPriceService=array_sum(array_column($this->services,'service.price'));
        $this->totalPriceService=array_sum(array_map(function($item){
            return $item['service']['price'];
        },$this->services));
    }


    public function render()
    {
        $this->updatePrice();
        return view('livewire.admin.book-room.custom-room-booking');
    }
    public function update()
    {
        try{
        $this->bookingInfo->rental_time = $this->rentalTime;
        $this->bookingInfo->checkin_date = Carbon::parse($this->checkInDateTime)->toDateTimeString();
        $this->bookingInfo->save();
        $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
        }catch(Throwable $e){
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xóa thất bại']);
        }

    }
    public function addService($id)
    {
        $service = Service::where('id', $id)->first()->toArray();
        $serviceInRoom = BookingService::where('booking_id', $this->bookingInfo['id'])->where('service_id', $service['id'])->first();

        if ($serviceInRoom) {
            DB::table('booking_service')->where('service_id', $service['id'])->update(['quantity' => $serviceInRoom->quantity + 1]);
        } else {
            $serviceInRoom = new BookingService();
            $serviceInRoom->booking_id = $this->bookingInfo['id'];
            $serviceInRoom->service_id = $service['id'];
            $serviceInRoom->quantity = 1;
        }
        $serviceInRoom->save();
        $this->services = BookingService::with('Service')->where('booking_id', $this->bookingInfo['id'])->get()->toArray();
    }
    public function checkOut()
    {
        $this->validate([
            'lateSurcharge' => 'required',
            'fromDateTime' => 'required',
            'rentalTime' => 'required',
            'price' => 'required',
            'earlySurcharge' => 'required',
        ]);
    }
    public function updatePrice()
    {

        $this->priceDay();
    }
    public function priceDay()
    {
        $this->typeTime =  1;
        $timeLine = TimeLine::where('type_time', $this->typeTime)->first();
        $additionHour = 0;
        $earLyHour = 0;
        $convertionTime = ConversionTime::first();
        $checkInDateTime = Carbon::parse($this->bookingInfo['checkin_date']);
        $checkOutDateTime =  $this->checkOutDateTime ? Carbon::parse($this->bookingInfo['checkout_date']) : Carbon::now();

        if ($this->typeTime == TypeTimeEnum::DAY) {
            $startDatetime = Carbon::parse(date('Y-m-d ' . $timeLine->start_hour, strtotime($this->bookingInfo['checkin_date'])));
            $endDateTime =  Carbon::parse(date('Y-m-d ' . $timeLine->end_hour, strtotime($checkOutDateTime)));
            // : Carbon::parse(Carbon::parse('2023-03-16 23:20:05')->format('Y-m-d ' . $timeLine->end_hour));
            $usedTime = $startDatetime->diffInDays($endDateTime);
            if ($checkOutDateTime->lt($endDateTime)) {
                $endDateTime = $endDateTime->subDay();
            }
            $additionHour = $checkOutDateTime->diffInHours($endDateTime);
            $additionMinute = $endDateTime->addHour($additionHour)->diffInMinutes($checkOutDateTime);
            $earLyHour = Carbon::parse($checkInDateTime)->diffInHours($startDatetime);
            $earLyMinute = Carbon::parse($checkInDateTime)->addHour($earLyHour)->diffInMinutes($startDatetime);
            // $earLyHour = $startDatetime->hour - $checkInDateTime->hour;
            // $earLyMinute = $checkInDateTime->minute;
            if ($usedTime < $this->rentalTime) {
                $additionHour = 0;
                $additionMinute = 0;
                $this->totalPrice = $this->price * $this->rentalTime;
            } else {
                if ($additionHour >= 0) {
                    if ($additionHour >= $convertionTime->day) {
                        $this->priceLateChager = $this->price;
                    } else {
                        $this->priceLateChager = $additionHour * $this->lateSurcharge + ($additionMinute >= $convertionTime->hour ? 1 : 0) * $this->lateSurcharge;
                    }
                }
                $this->totalPrice = $this->price * $usedTime;
            }
            if ($earLyHour > 0) {
                if ($earLyHour >= $convertionTime->day) {
                    $this->priceEarlyChager = $this->price;
                } else {
                    $this->priceEarlyChager = $earLyHour * $this->earlySurcharge + ($earLyMinute >= $convertionTime->hour ? 1 : 0) * $this->earlySurcharge;
                }
            }

            // dd($this->earlySurcharge, $checkInDateTime, $checkOutDateTime, $startDatetime, $endDateTime, $usedTime, $additionHour, $earLyHour, $earLyMinute, $this->totalPrice, $this->priceEarlyChager, $this->priceLateChager);
        }
        if ($this->typeTime == TypeTimeEnum::HOUR) {
            $this->totalPrice = $this->price * $this->rentalTime;
            $usedHour = $checkInDateTime->diffInHours($checkOutDateTime);
            $additionHour = $usedHour  - $this->rentalTime;
            $additionMinute = $checkInDateTime->addHour($usedHour)->diffInMinutes($checkOutDateTime);
            if ($additionHour >= 0) {
                $this->priceLateChager = $additionHour * $this->lateSurcharge + ($additionMinute >= $convertionTime->hour ? 1 : 0) * $this->lateSurcharge;
            }
            if ($this->bookingInfo['booking_date']) {
                $checkInDateTime = Carbon::parse($this->bookingInfo['checkin_date']);
                $earLyHour = Carbon::parse($this->bookingInfo['booking_date'])->diffInHours($checkInDateTime);
                $earLyMinute = Carbon::parse($this->bookingInfo['booking_date'])->addHour($earLyHour)->diffInMinutes($checkInDateTime);
                if ($earLyHour > 0) {
                    $this->priceEarlyChager = $earLyHour * $this->earlySurcharge + ($earLyMinute >= $convertionTime->hour ? 1 : 0) * $this->earlySurcharge;
                }
            }
        }
        if ($this->typeTime == TypeTimeEnum::NIGHT) {
            $this->totalPrice = $this->price * $this->rentalTime;
        }
    }
}
