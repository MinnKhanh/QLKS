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
use App\Models\PayMent;
use App\Models\PaymentBooking;
use App\Models\Price;
use App\Models\Room;
use App\Models\TimeLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class OrderByUser extends Component
{
    public $customerInfo;
    public $idCustomer;
    public $listBooking;
    public $listPrice = [];
    public $listRoom;
    public $hourOut;
    public $isCheckOut = true;
    public $statusBooking = StatusBookingEnum::PENDING;
    public $listRoomBooked;
    public $typeTime = TypeTimeEnum::DAY;
    public $dates = [];
    public $idRoom;
    public $fromDateTime;
    public $toDateTime;
    public $roomActive;
    public $price;
    public $rentalTime;
    public $hourIn;
    public $numberOfAdults;
    public $numberOfChildren;
    public $deposit = 0;
    public $typeBooking = 1;
    public $fixId;
    public $bookingUpdate;

    protected $listeners = ['setfromDate', 'settoDate', 'setfromDateTime' => 'setfromDateTime', 'settoDateTime' => 'settoDateTime', 'updatePrice', 'updateTypeTime'];

    public function mount()
    {
        $this->listRoom = Room::with(['Type', 'Floor', 'Capacity'])
            // ->where('status', StatusRoomEnum::EMPTY)
            ->get()->toArray();
        foreach ($this->listRoom as $item) {
            $bookings = Booking::where('room_id', $item['id'])
                // ->where('type', TypeBooking::RESERVE)
                ->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])
                ->orderBy('checkin_date', 'ASC')->get()->toArray();
            foreach ($bookings as $itemBooking) {
                $this->dates[$item['id']][] = [$itemBooking['checkin_date'], $itemBooking['checkout_date']];
            }
        }
        // dd($this->dates);
        $this->customerInfo = Customer::where('id', $this->idCustomer)->first();
        // DB::enableQueryLog();
        if ($this->statusBooking == StatusBookingEnum::ACTIVE)
            $this->listBooking = Booking::with(['Room'])->whereDoesntHave('PayMentBooking')
                ->where('customer_id', $this->idCustomer)->where('status', $this->statusBooking)->get();
        elseif ($this->statusBooking == StatusBookingEnum::PAID)
            $this->listBooking = Booking::with(['Room'])->where(function ($query) {
                $query->where('status', StatusBookingEnum::PAID)
                    ->orWhere(function ($q) {
                        $q->where('status', StatusBookingEnum::ACTIVE)
                            ->whereHas('PayMentBooking');
                    });
            })->where('customer_id', $this->idCustomer)->get();
        else $this->listBooking = Booking::with(['Room'])->where('customer_id', $this->idCustomer)->where('status', $this->statusBooking)->get();
        // dd(DB::getQu?eryLog());
        // dd($this->listBooking);
        if ($this->statusBooking == StatusBookingEnum::ACTIVE && $this->listBooking)
            $this->priceAll();
    }
    public function edit($id)
    {
        $this->bookingUpdate = Booking::where('id', $id)->first();
        $this->fixId = $id;
    }
    public function update()
    {
    }
    public function close()
    {
        $this->roomActive = null;
    }
    public function changeRentalTime()
    {
        if ($this->typeTime == TypeTimeEnum::DAY && $this->rentalTime) {
            if ($this->fromDateTime)
                $this->toDateTime = Carbon::parse($this->fromDateTime)->addDay($this->rentalTime)->format('Y-m-d');
            if ($this->toDateTime)
                $this->fromDateTime = Carbon::parse($this->toDateTime)->subDay($this->rentalTime)->format('Y-m-d');
        }
        if ($this->typeTime == TypeTimeEnum::HOUR && $this->rentalTime) {
            $fromDateTime = Carbon::parse($this->fromDateTime)->addHour($this->rentalTime)->format('Y-m-d');
            // DB::enableQueryLog();
            $booking = Booking::where('room_id', $this->idRoom)->whereDate('checkin_date', $fromDateTime)->whereIn('status', [StatusBookingEnum::ACTIVE, StatusBookingEnum::PENDING])->first();
            // dd(DB::getQueryLog());
            // dd($booking);
            if ($booking) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Phòng này hôm nay đã có người đặt trước"]);
                $this->rentalTime = 0;
            } else {
                $this->fromDateTime = $fromDateTime;
            }
        }
    }
    public function updatePrice()
    {
        if ($this->typeTime) {
            $prices = Price::where('type_room_detail_id', $this->roomActive['type_room'])->where('type_price', $this->typeTime)->first()->toArray();
            $this->price = $prices['price'];
        }
    }

    public function getCurrentTime()
    {
        $this->hourIn = Carbon::now()->format('H:i:s');
    }
    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
        $this->dispatchBrowserEvent('setDatePicker');
    }
    public function changeFromAndToDateTime()
    {
        if ($this->fromDateTime && $this->toDateTime) {
            $this->rentalTime = Carbon::parse($this->fromDateTime)->diffInDays(Carbon::parse($this->toDateTime));
        }
    }
    public function addRoom($id)
    {
        $this->idRoom = $id;
        $this->roomActive = Room::with('Floor', 'Type')->where('id', $this->idRoom)->first()->toArray();
        // dd($this->dates);
        $this->updatePrice();
    }
    public function updateTypeTime()
    {
        if ($this->typeTime == TypeTimeEnum::NIGHT)
            $this->rentalTime = 1;
        $this->resetTime();
    }
    public function resetTime()
    {
        $this->fromDateTime = null;
        $this->toDateTime = null;
        $this->hourIn = null;
    }

    public function setfromDate($time)
    {
        $fromDate = date('Y-m-d', strtotime($time['fromDateTime']));
        if ($this->toDateTime) {
            $count = Booking::where('room_id', $this->idRoom)
                // ->where('type', TypeBooking::RESERVE)
                ->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])
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
                // ->where('type', TypeBooking::RESERVE)
                ->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])
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

    public function changeStatus()
    {
        // DB::enableQueryLog();
        $this->listPrice = [];
        if ($this->statusBooking == StatusBookingEnum::ACTIVE)
            $this->listBooking = Booking::with(['Room'])->whereDoesntHave('PayMentBooking')
                ->where('customer_id', $this->idCustomer)->where('status', $this->statusBooking)->get();
        elseif ($this->statusBooking == StatusBookingEnum::PAID)
            $this->listBooking = Booking::with(['Room'])->where(function ($query) {
                $query->where('status', StatusBookingEnum::PAID)
                    ->orWhere(function ($q) {
                        $q->where('status', StatusBookingEnum::ACTIVE)
                            ->whereHas('PayMentBooking');
                    });
            })->where('customer_id', $this->idCustomer)->get();
        else $this->listBooking = Booking::with(['Room'])->where('customer_id', $this->idCustomer)->where('status', $this->statusBooking)->get();
        // dd(DB::getQueryLog());
        // dd($this->listBooking);
        if ($this->statusBooking == StatusBookingEnum::ACTIVE && $this->listBooking)
            $this->priceAll();
    }
    public function render()
    {
        $this->updateUI();
        return view('livewire.admin.book-room.order-by-user');
    }
    public function checkOutAll()
    {
        try {
            DB::beginTransaction();
            $totalPrice = 0;
            $payment = new PayMent();
            $payment->creator_id = 1;
            $payment->customer_id = $this->customerInfo['id'];
            $payment->amount = $totalPrice;
            $payment->phone = $this->customerInfo['phone'];
            $payment->cmtnd = $this->customerInfo['cmtnd'];
            $payment->payment_method = 1;
            $payment->note = '';
            $payment->satus = 1;
            $payment->save();
            // $this->listBooking = Booking::with(['Room'])->where('customer_id', $this->idCustomer)->whereDoesntHave('PayMentBooking')
            //     ->where('status', StatusBookingEnum::ACTIVE)->get();
            // dd($this->listBooking);
            foreach ($this->listBooking as $item) {
                Booking::where('id', $item->id)->update([
                    'hour_out' => $this->hourOut,
                    'late_checkin_fee' => $this->listPrice[$item->id]['price_late'],
                    'early_checkIn_fee' => $this->listPrice[$item->id]['price_early'],
                    'price_service' => $this->listPrice[$item->id]['service'],
                    'total_price' => $this->listPrice[$item->id]['total_price'],
                    'price' => $this->listPrice[$item->id]['price']
                ]);
                $totalPrice += $this->listPrice[$item->id]['total_price'] + $this->listPrice[$item->id]['price_late'] + $this->listPrice[$item->id]['price_early'] - $item->deposit + $this->listPrice[$item->id]['service'];
                PaymentBooking::insert([
                    'booking_id' => $item->id,
                    'payment_id' => $payment->id
                ]);
            }
            $payment->amount = $totalPrice;
            $payment->save();
            DB::commit();
            $this->changeStatus();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e]);
        }
    }
    public function priceAll()
    {
        foreach ($this->listBooking as $item) {
            $this->countPrice($item->id);
        }
    }
    public function countPrice($id)
    {
        $bookingInfo = Booking::where('id', $id)->first();
        $rentalTime = $bookingInfo['rental_time'];
        $roomInfo = Room::where('id', $bookingInfo['room_id'])->first()->toArray();
        $prices = Price::where('type_room_detail_id', $roomInfo['type_room'])
            ->where('type_price', $bookingInfo['type_time'])->first()->toArray();
        $price = $prices['price'];
        $timeLine = TimeLine::where('type_time',  $bookingInfo['type_time'])->first();
        $hourIn = $bookingInfo['hour_in'];
        $this->hourOut = $bookingInfo['hour_out'] ?? Carbon::now()->format('H:i:s');
        $additionHour = 0;
        $earLyHour = 0;
        $lateSurcharge = $prices['late_surcharge'];
        $earlySurcharge = $prices['early_surcharge'];
        $priceEarlyChager = 0;
        $priceLateChager = 0;
        $convertionTime = ConversionTime::first();
        $checkInDateTime = Carbon::parse($bookingInfo['checkin_date']);
        $checkOutDateTime =  Carbon::now();
        $totalPrice = 0;

        if ($bookingInfo['type_time'] == TypeTimeEnum::DAY) {
            $totalPrice = $rentalTime * $price;
            $additionHour = 0;
            $additionMinute = 0;

            $dateTimeHourCheckout = Carbon::now();
            $dateTimeLineCheckout = Carbon::parse($timeLine->end_hour);
            if ($this->hourOut) {
                $dateTimeHourCheckout = Carbon::parse($this->hourOut);
                // dd($dateTimeHourCheckout);
            }
            // if (Carbon::now() >= Carbon::parse($bookingInfo['checkout_date'])) {
            if ($dateTimeHourCheckout > $dateTimeLineCheckout) {
                $additionHour = $dateTimeHourCheckout->diffInHours($dateTimeLineCheckout);
                $additionMinute = $dateTimeLineCheckout->addHour($additionHour)->diffInMinutes($dateTimeHourCheckout);
                if ($additionHour >= $convertionTime->day) {
                    $priceLateChager = $price;
                } else {
                    $priceLateChager = $additionHour * $lateSurcharge + ($additionMinute >= $convertionTime->hour ? 1 : 0) * $lateSurcharge;
                }
            }
            // }
            $earLyHour = 0;
            $earLyMinute = 0;
            $dateTimeHourCheckin = Carbon::parse($hourIn);
            $dateTimeLineCheckin = Carbon::parse($timeLine->start_hour);
            if ($dateTimeHourCheckin < $dateTimeLineCheckin) {
                $earLyHour = $dateTimeHourCheckin->diffInHours($dateTimeLineCheckin);
                $earLyMinute = $dateTimeHourCheckin->addHour($earLyHour)->diffInMinutes($dateTimeLineCheckin);
                if ($earLyHour >= $convertionTime->day) {
                    $priceEarlyChager = $price;
                } else {
                    $priceEarlyChager = $earLyHour * $earlySurcharge + ($earLyMinute >= $convertionTime->hour ? 1 : 0) * $earlySurcharge;
                }
            }
            // dd($additionHour, $additionMinute, $earLyHour, $earLyMinute, $totalPrice, $priceEarlyChager, $priceLateChager);
        }
        if ($bookingInfo['type_time'] == TypeTimeEnum::HOUR) {
            $totalPrice = $price * $rentalTime;
            $dateTimeHourCheckin = Carbon::parse(date('Y-m-d ' . $hourIn, strtotime($checkInDateTime)));
            $dateTimeHourCheckout = $this->hourOut ? Carbon::parse($this->hourOut) : Carbon::now(); //Carbon::parse($hourOut);
            if ($dateTimeHourCheckin < $dateTimeHourCheckout) {
                $usedHour = $dateTimeHourCheckin->diffInHours($dateTimeHourCheckout);
                $additionHour = $usedHour  - $rentalTime;
                $additionMinute = 0;
                if ($additionHour >= 0) {
                    $priceLateChager = $additionHour * $lateSurcharge;
                    $additionMinute = $dateTimeHourCheckin->addHour($usedHour)->diffInMinutes($dateTimeHourCheckout);
                }
                $priceLateChager += ($additionMinute >= $convertionTime->hour  ? 1 : 0) * $lateSurcharge;
            }
            // dd($dateTimeHourCheckin, $dateTimeHourCheckout, $additionHour, $additionMinute, $totalPrice, $priceEarlyChager, $priceLateChager);
        }
        if ($bookingInfo['type_time'] == TypeTimeEnum::NIGHT) {
            $totalPrice = $price * $rentalTime;
            $dateTimeHourCheckout = Carbon::now();
            $dateTimeLineCheckout = Carbon::parse($timeLine->end_hour);
            if ($this->hourOut) {
                $dateTimeHourCheckout = Carbon::parse($this->hourOut);
            }
            if ($dateTimeHourCheckout > $dateTimeLineCheckout) {
                $additionHour = $dateTimeHourCheckout->diffInHours($dateTimeLineCheckout);
                $additionMinute = $dateTimeLineCheckout->addHour($additionHour)->diffInMinutes($dateTimeHourCheckout);
                if ($additionHour >= $convertionTime->day) {
                    $priceLateChager += $price;
                } else {
                    $priceLateChager = $additionHour * $lateSurcharge + ($additionMinute >= $convertionTime->hour ? 1 : 0) * $lateSurcharge;
                }
            }
            // dd($priceEarlyChager, $priceLateChager);
        }
        $this->listPrice[$id]['price_late'] = $priceLateChager;
        $this->listPrice[$id]['price_early'] = $priceEarlyChager;
        $this->listPrice[$id]['total_price'] = $totalPrice;
        $this->listPrice[$id]['service'] = $bookingInfo['total_price_service'];
        $this->listPrice[$id]['price'] = $price;
        $this->listPrice[$id]['hour_out'] = $price;
    }
    public function create()
    {
        // $this->validate([
        //     'typeTime' => 'required',
        //     'lateSurcharge' => 'required',
        //     'earlySurcharge' => 'required',
        //     'numberOfAdults' => 'required',
        //     'numberOfChildren' => 'required',
        //     'fromDateTime' => 'required',
        //     'toDateTime' => $this->typeTime == TypeTimeEnum::DAY ? 'required' : '',
        //     'customer_phone' => 'required',
        //     'customer_name' => 'required',
        //     'customer_code' => 'required',
        //     'customer_cmtnd' => 'required',
        //     'rentalTime' => 'required',
        // ]);
        try {
            DB::beginTransaction();
            $isExists = Booking::where('customer_id', $this->customerInfo['id'])->where('room_id', $this->idRoom)->where('checkin_date', '>=', $this->fromDateTime)
                ->where('checkout_date', '<=', $this->toDateTime)->where('status', 1)->first();
            if (!$isExists) {
                $booking = new Booking();
                $booking->customer_id = $this->customerInfo['id'];
                $booking->room_id = $this->idRoom;
                $booking->note = '';
                $booking->checkin_date = $this->fromDateTime;
                if ($this->typeBooking == TypeBooking::RESERVE) {
                    $booking->type = TypeBooking::RESERVE;
                    $booking->status = StatusBookingEnum::PENDING;
                } else {
                    $booking->type = TypeBooking::BOOKATHOTEL;
                    $booking->status = StatusBookingEnum::ACTIVE;
                    Room::where('id', $this->idRoom)->update(['status' => StatusRoomEnum::ACTIVE]);
                }
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
            $this->listRoom = Room::with(['Type', 'Floor', 'Capacity'])->where('status', StatusRoomEnum::EMPTY)->get()->toArray();
            $this->changeStatus();
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Tạo thành công"]);
            $this->roomActive = null;
            return;
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Tạo thất bại"]);
            return;
        }
    }
}
