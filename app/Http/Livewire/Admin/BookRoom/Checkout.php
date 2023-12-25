<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Enums\TypeTimeEnum;
use App\Models\ConversionTime;
use App\Models\TimeLine;
use Carbon\Carbon;
use Livewire\Component;

class Checkout extends Component
{
    public $idRoom;
    public $totalPrice;
    public $priceLateChager;
    public $priceEarlyChager;
    public $rentalTime;
    public $checkInDateTime;
    public $checkOutDateTime;

    public function mount(){
        // $this->roomInfo = Room::with('Floor', 'Type')->where('id', $this->idRoom)->first()->toArray();
        // // dd($this->roomInfo);
        // $this->bookingInfo = Booking::where('room_id', $this->idRoom)->where('status', 1)->first();
        // $this->customerInfo = Customer::where('id', $this->bookingInfo['customer_id'])->first();
        // $this->services = BookingService::with('Service')->where('booking_id', $this->bookingInfo['id'])->get()->toArray();
        // $this->prices = Price::where('type_room_detail_id', $this->roomInfo['type_room'])
        //     ->where('type_price', $this->bookingInfo['type_time'])->first()->toArray();
        // $this->price = $this->prices['price'];
        // $this->lateSurcharge = $this->prices['late_surcharge'];
        // $this->earlySurcharge = $this->prices['early_surcharge'];
        // $this->rentalTime = $this->bookingInfo['rental_time'];
        // $this->checkInDateTime = $this->bookingInfo['checkin_date'];
        // $this->listServices = Service::with('Type')->get()->toArray();
        // $this->typeTime =  $this->bookingInfo['type_time'];
        // // $this->totalPriceService=array_sum(array_column($this->services,'service.total_price'));
        // $this->totalPriceService=array_sum(array_map(function($item){
        //     return $item['service']['price']*$item['quantity'];
        // },$this->services));
    }
    public function render()
    {
        return view('livewire.admin.book-room.checkout');
    }

    public function updatePrice()
    {
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
                $this->priceLateChager = $additionHour * $this->lateSurcharge;
            }
            $this->priceLateChager +=($additionMinute >= $convertionTime->hour ? 1 : 0) * $this->lateSurcharge;
            if ($this->bookingInfo['booking_date']) {
                $checkInDateTime = Carbon::parse($this->bookingInfo['checkin_date']);
                $earLyHour = Carbon::parse($this->bookingInfo['booking_date'])->diffInHours($checkInDateTime);
                $earLyMinute = Carbon::parse($this->bookingInfo['booking_date'])->addHour($earLyHour)->diffInMinutes($checkInDateTime);
                if ($earLyHour > 0) {
                    $this->priceEarlyChager = $earLyHour * $this->earlySurcharge;
                }
                $this->priceEarlyChager +=($earLyMinute >= $convertionTime->hour ? 1 : 0) * $this->earlySurcharge;
            }
            // dd( $checkInDateTime, $checkOutDateTime, $usedHour, $additionHour,  $this->totalPrice, $this->priceEarlyChager, $this->priceLateChager);
        }
        if ($this->typeTime == TypeTimeEnum::NIGHT) {
            $this->totalPrice = $this->price * $this->rentalTime;
        }
    }
}
