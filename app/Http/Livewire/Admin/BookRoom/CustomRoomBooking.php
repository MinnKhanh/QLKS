<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Enums\FeeEnum;
use App\Enums\StatusBookingEnum;
use App\Enums\StatusPayment;
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
    public $bookingOutDate;
    public $listServices;
    public $typeTime;
    public $totalPrice;
    public $totalSurcharge;
    public $totalPriceService;
    public $priceLateChager = 0;
    public $priceEarlyChager = 0;
    public $bookinDate;
    public $deposit = 0;
    public $note = '';
    public $statusRoom;
    public $statusBooking;
    public $hourIn;
    public $hourOut;
    public $isCheckout;
    public $bookingId;
    public $dates = [];
    public $idPayment;
    public $roomIsEmpty;
    protected $listeners = ['setfromDate', 'settoDate', 'updateInfoPirce' => 'updateInfoPirce', 'changeQuantityService'];

    public function mount()
    {
        $this->roomInfo = Room::with('Floor', 'Type')->where('id', $this->idRoom)->first()->toArray();
        $this->statusRoom = $this->roomInfo['status'];
        // dd($this->roomInfo);
        $this->bookingInfo = Booking::where('id', $this->bookingId)
            ->first();
        // if (!$this->bookingInfo && ) {
        //     $this->bookingInfo = Booking::where('room_id', $this->idRoom)->whereIn('status', [4])
        //         ->where('checkin_date', '<=', date('Y-m-d'))
        //         ->where('checkout_date', '>=', date('Y-m-d'))
        //         ->first();
        // }
        if ($this->bookingInfo) {
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
            // $this->totalPriceService=array_sum(array_column($this->services,'service.total_price'));
            $this->totalPriceService = array_sum(array_map(function ($item) {
                return $item['service']['price'] * $item['quantity'];
            }, $this->services));
            $this->deposit = $this->bookingInfo->deposit;
            $this->statusBooking = $this->bookingInfo['status'];
            $this->isCheckout = PaymentBooking::where('booking_id', $this->bookingInfo['id'])->first() ? 1 : 0;
            if ($this->isCheckout) {
                $this->idPayment = PaymentBooking::where('booking_id', $this->bookingInfo['id'])->first()->payment_id;
            }
            $this->checkOutDateTime = $this->bookingInfo->checkout_date;
            $this->hourIn = $this->bookingInfo->hour_in;
            $this->hourOut = $this->bookingInfo->hour_out;
            $bookings = Booking::where('id', '!=', $this->bookingInfo->id)->where('room_id', $this->idRoom)->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])->orderBy('checkin_date', 'ASC')->get()->toArray();
            foreach ($bookings as $item) {
                $this->dates[] = [$item['checkin_date'], $item['checkout_date'] ?? $item['checkin_date']];
            }
            // dd($this->dates);
            $this->checkEmpty();
            // if ($this->statusBooking == StatusBookingEnum::PENDING) {
            //     if ($this->roomInfo['status'] == StatusRoomEnum::EMPTY) {
            //         $this->roomIsEmpty = 1;
            //     } else {
            //         $this->roomIsEmpty = 0;
            //     }
            // }
        }
    }
    public function cancelRoom()
    {
        $price = 0;
        if ($this->typeTime == TypeTimeEnum::NIGHT) {
            $checkInDateTime = Carbon::parse(date('Y-m-d ' . $this->hourIn, strtotime($this->bookingInfo['checkin_date'])));
            $now = Carbon::now();
            $usedTime = $checkInDateTime->diffInHours($now);
            if ($usedTime >= FeeEnum::NIGHT) $price = $this->rentalTime * $this->price;
        }
        if ($this->typeTime == TypeTimeEnum::HOUR) {
            $checkInDateTime = Carbon::parse(date('Y-m-d ' . $this->hourIn, strtotime($this->bookingInfo['checkin_date'])));
            $now = Carbon::now();
            $usedTime = $checkInDateTime->diffInHours($now);
            if ($usedTime >= FeeEnum::HOUR) $price = $this->rentalTime * $this->price;
        } else {
            $checkInDateTime = Carbon::parse(date('Y-m-d ' . $this->hourIn, strtotime($this->bookingInfo['checkin_date'])));
            $now = Carbon::now();
            $usedTime = $checkInDateTime->diffInDays($now);
            if ($usedTime >= FeeEnum::DAY) $price = $this->rentalTime * $this->price;
        }
        $price += $this->totalPriceService;
        try {
            DB::beginTransaction();
            $this->bookingInfo->status = StatusBookingEnum::RESERVE;
            $this->bookingInfo->save();
            $payment = new PayMent();
            $payment->creator_id = 1;
            $payment->customer_id = $this->customerInfo['id'];
            $payment->amount = $price;
            $payment->phone = $this->customerInfo['phone'];
            $payment->cmtnd = $this->customerInfo['cmtnd'];
            $payment->payment_method = 1;
            $payment->note = $this->note;
            $payment->satus = StatusPayment::CANCEL;
            $payment->save();
            PaymentBooking::create([
                'booking_id' => $this->bookingInfo->id,
                'payment_id' => $payment->id
            ]);
            Room::where('id', $this->idRoom)->update([
                'status' => StatusRoomEnum::EMPTY
            ]);
            DB::commit();
            return redirect()->route('admin.bookroom.list_room');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e]);
        }
    }
    public function checkEmpty()
    {
        if ($this->statusBooking == StatusBookingEnum::PENDING) {
            if ($this->roomInfo['status'] == StatusRoomEnum::EMPTY) {
                $this->roomIsEmpty = 1;
            } else {
                $this->roomIsEmpty = 0;
            }
        }
    }
    public function getPaymentInfo()
    {
        $paymentId = PaymentBooking::where('booking_id', $this->bookingInfo['id'])->first()->payment_id;
        $payment = PayMent::where('id', $paymentId)->first()->toArray();
        $this->priceLateChager = $this->bookingInfo['late_checkin_fee'];
        $this->priceEarlyChager = $this->bookingInfo['early_checkIn_fee'];
        $this->totalPrice = $this->bookingInfo['total_price'];
        $this->totalPriceService = $this->bookingInfo['price_service'];
    }

    public function render()
    {
        if (!$this->isCheckout)
            $this->countPrice();
        else {
            $this->getPaymentInfo();
        }
        $this->updateUI();
        return view('livewire.admin.book-room.custom-room-booking');
    }

    public function updateUI()
    {
        $this->dispatchBrowserEvent('setDatePicker');
    }
    public function priceService()
    {
        $this->totalPriceService = array_sum(array_map(function ($item) {
            return $item['service']['price'] * $item['quantity'];
        }, $this->services));
    }
    public function update()
    {
        // dd($this->typeTime);
        try {
            $this->bookingInfo->checkin_date = $this->checkInDateTime;
            $this->bookingInfo->checkout_date = $this->checkOutDateTime;
            $this->bookingInfo->rental_time = $this->rentalTime;
            $this->bookingInfo->type_time = $this->typeTime;
            $this->bookingInfo->deposit = $this->deposit;
            $this->bookingInfo->hour_in = $this->hourIn;
            $this->bookingInfo->hour_out = $this->hourOut;
            $this->bookingInfo->save();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
        } catch (Throwable $e) {
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Cập nhật thất bại']);
        }
    }
    public function updateInfoPirce()
    {
        $this->prices = Price::where('type_room_detail_id', $this->roomInfo['type_room'])
            ->where('type_price', $this->typeTime)->first()->toArray();
        $this->price = $this->prices['price'];
        $this->lateSurcharge = $this->prices['late_surcharge'];
        $this->earlySurcharge = $this->prices['early_surcharge'];
        $this->updatePrice();
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
        $this->priceService();
    }

    public function updatePrice()
    {
        $timeLine = TimeLine::where('type_time', $this->typeTime)->first();
        $additionHour = 0;
        $earLyHour = 0;
        $this->priceEarlyChager = 0;
        $this->priceLateChager = 0;
        $convertionTime = ConversionTime::first();
        $checkInDateTime = Carbon::parse($this->bookingInfo['checkin_date']);
        // $checkOutDateTime =  $this->checkOutDateTime ? Carbon::parse($this->bookingInfo['checkout_date']) : Carbon::now();
        $checkOutDateTime =  Carbon::now();

        if ($this->typeTime == TypeTimeEnum::DAY) {
            $startDatetime = Carbon::parse(date('Y-m-d ' . $timeLine->start_hour, strtotime($this->bookingInfo['checkin_date'])));
            $endDateTime =  Carbon::parse(date('Y-m-d ' . $timeLine->end_hour, strtotime($this->bookingInfo['checkout_date'])));
            // : Carbon::parse(Carbon::parse('2023-03-16 23:20:05')->format('Y-m-d ' . $timeLine->end_hour));
            $usedTime = $startDatetime->diffInDays($endDateTime);
            // if ($checkOutDateTime->lt($endDateTime)) {
            //     $endDateTime = $endDateTime->subDay();
            // }
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

            // dd($checkInDateTime, $checkOutDateTime, $startDatetime, $endDateTime, $usedTime, $additionHour, $earLyHour, $earLyMinute, $this->totalPrice, $this->priceEarlyChager, $this->priceLateChager);
        }
        if ($this->typeTime == TypeTimeEnum::HOUR) {
            $this->totalPrice = $this->price * $this->rentalTime;
            $usedHour = $checkInDateTime->diffInHours($checkOutDateTime);
            $additionHour = $usedHour  - $this->rentalTime;
            $additionMinute = $checkInDateTime->addHour($usedHour)->diffInMinutes($checkOutDateTime);
            if ($additionHour >= 0) {
                $this->priceLateChager = $additionHour * $this->lateSurcharge;
            }
            $this->priceLateChager += ($additionMinute >= $convertionTime->hour ? 1 : 0) * $this->lateSurcharge;
            // dd( $checkInDateTime, $checkOutDateTime, $usedHour, $additionHour,  $this->totalPrice, $this->priceEarlyChager, $this->priceLateChager);
        }
        if ($this->typeTime == TypeTimeEnum::NIGHT) {
            $this->totalPrice = $this->price * $this->rentalTime;
        }
    }

    public function setfromDate($time)
    {
        $fromDate = date('Y-m-d', strtotime($time['checkInDateTime']));
        if ($this->checkOutDateTime) {
            $count = Booking::where('room_id', $this->idRoom)
                // ->where('type', TypeBooking::RESERVE)
                ->where('id', '!=', $this->bookingInfo['id'])
                ->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])
                ->where('checkin_date', '>=', $fromDate)
                ->where('checkout_date', '<=', $this->checkOutDateTime)
                ->count();
            if ($count) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Khoảng thời gian đã chọn có chứ lịch đã được đăng ký trước của phòng"]);
                return;
            }
        }
        $this->checkInDateTime = date('Y-m-d', strtotime($time['checkInDateTime']));
        $this->changeFromAndToDateTime();
    }
    public function settoDate($time)
    {
        $toDate = date('Y-m-d', strtotime($time['checkOutDateTime']));
        if ($this->checkInDateTime) {
            $count = Booking::where('room_id', $this->idRoom)
                ->where('id', '!=', $this->bookingInfo['id'])
                ->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])
                ->where('checkin_date', '>=', $this->checkInDateTime)
                ->where('checkout_date', '<=', $toDate)
                ->count();
            if ($count) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Khoảng thời gian đã chọn có chứ lịch đã được đăng ký trước của phòng"]);
                return;
            }
        }
        $this->checkOutDateTime = date('Y-m-d', strtotime($time['checkOutDateTime']));
        $this->changeFromAndToDateTime();
    }


    public function deleteService($booking_id, $service_id)
    {
        try {
            BookingService::where('booking_id', $booking_id)->where('service_id', $service_id)->delete();
            $this->services = BookingService::with('Service')->where('booking_id', $this->bookingInfo['id'])->get()->toArray();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Xóa thất bại']);
        }
    }

    public function changeQuantityService($data)
    {
        if ($data[0] <= 0) {
            $this->deleteService($data[1], $data[2]);
        } else {
            try {
                BookingService::where('booking_id', $data[1])->where('service_id', $data[2])->update(['note' => $data[0]]);
                $service = BookingService::with('Service')->where('booking_id', $this->bookingInfo['id'])->get()->toArray();
                $this->totalPriceService = array_sum(array_map(function ($item) {
                    return $item['service']['price'] * $item['quantity'];
                }, $service));
                $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
            } catch (Throwable $e) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Cập nhật thất bại']);
            }
        }
    }

    public function changeTypeTime()
    {
        if ($this->typeTime == TypeTimeEnum::NIGHT) {
            $this->rentalTime = 1;
        }
        if ($this->typeTime == TypeTimeEnum::HOUR) {
            $checkOutDateTime = Carbon::parse(date('Y-m-d ' . $this->hourIn, strtotime($this->checkInDateTime)))->addHour($this->rentalTime);
            $this->checkOutDateTime = $checkOutDateTime->format('Y-m-d');
        }
    }

    public function countPrice()
    {
        $timeLine = TimeLine::where('type_time', $this->typeTime)->first();
        $additionHour = 0;
        $earLyHour = 0;
        $this->priceEarlyChager = 0;
        $this->priceLateChager = 0;
        $convertionTime = ConversionTime::first();
        $checkInDateTime = Carbon::parse($this->bookingInfo['checkin_date']);
        $checkOutDateTime =  Carbon::now();

        if ($this->typeTime == TypeTimeEnum::DAY) {
            $this->totalPrice = $this->rentalTime * $this->price;
            $additionHour = 0;
            $additionMinute = 0;

            $dateTimeHourCheckout = Carbon::now();
            $dateTimeLineCheckout = Carbon::parse($timeLine->end_hour);
            if ($this->hourOut) {
                $dateTimeHourCheckout = Carbon::parse($this->hourOut);
                // dd($dateTimeHourCheckout);
            }
            if (Carbon::now() >= Carbon::parse($this->bookingInfo['checkout_date'])) {
                if ($dateTimeHourCheckout > $dateTimeLineCheckout) {
                    $additionHour = $dateTimeHourCheckout->diffInHours($dateTimeLineCheckout);
                    $additionMinute = $dateTimeLineCheckout->addHour($additionHour)->diffInMinutes($dateTimeHourCheckout);
                    if ($additionHour >= $convertionTime->day) {
                        $this->priceLateChager = $this->price;
                    } else {
                        $this->priceLateChager = $additionHour * $this->lateSurcharge + ($additionMinute >= $convertionTime->hour ? 1 : 0) * $this->lateSurcharge;
                    }
                }
            }
            $earLyHour = 0;
            $earLyMinute = 0;
            $dateTimeHourCheckin = Carbon::parse($this->hourIn);
            $dateTimeLineCheckin = Carbon::parse($timeLine->start_hour);
            if ($dateTimeHourCheckin < $dateTimeLineCheckin) {
                $earLyHour = $dateTimeHourCheckin->diffInHours($dateTimeLineCheckin);
                $earLyMinute = $dateTimeHourCheckin->addHour($earLyHour)->diffInMinutes($dateTimeLineCheckin);
                if ($earLyHour >= $convertionTime->day) {
                    $this->priceEarlyChager = $this->price;
                } else {
                    $this->priceEarlyChager = $earLyHour * $this->earlySurcharge + ($earLyMinute >= $convertionTime->hour ? 1 : 0) * $this->earlySurcharge;
                }
            }
            // dd($this->priceEarlyChager, $this->priceLateChager);
        }
        if ($this->typeTime == TypeTimeEnum::HOUR) {
            $this->totalPrice = $this->price * $this->rentalTime;
            $dateTimeHourCheckin = Carbon::parse(date('Y-m-d ' . $this->hourIn, strtotime($this->checkInDateTime)));
            $dateTimeHourCheckout = $this->hourOut ? Carbon::parse($this->hourOut) : Carbon::now(); //Carbon::parse($this->hourOut);
            if ($dateTimeHourCheckin < $dateTimeHourCheckout) {
                $usedHour = $dateTimeHourCheckin->diffInHours($dateTimeHourCheckout);
                $additionHour = $usedHour  - $this->rentalTime;
                $additionMinute = 0;
                if ($additionHour >= 0) {
                    $this->priceLateChager = $additionHour * $this->lateSurcharge;
                    $additionMinute = $dateTimeHourCheckin->addHour($usedHour)->diffInMinutes($dateTimeHourCheckout);
                }
                $this->priceLateChager += ($additionMinute >= $convertionTime->hour  ? 1 : 0) * $this->lateSurcharge;
            }
            // dd($dateTimeHourCheckin, $dateTimeHourCheckout, $additionHour, $additionMinute, $this->totalPrice, $this->priceEarlyChager, $this->priceLateChager);
        }
        if ($this->typeTime == TypeTimeEnum::NIGHT) {
            $this->totalPrice = $this->price * $this->rentalTime;
            $dateTimeHourCheckout = Carbon::now();
            $dateTimeLineCheckout = Carbon::parse($timeLine->end_hour);
            if ($this->hourOut) {
                $dateTimeHourCheckout = Carbon::parse($this->hourOut);
            }
            if ($dateTimeHourCheckout > $dateTimeLineCheckout) {
                $additionHour = $dateTimeHourCheckout->diffInHours($dateTimeLineCheckout);
                $additionMinute = $dateTimeLineCheckout->addHour($additionHour)->diffInMinutes($dateTimeHourCheckout);
                if ($additionHour >= $convertionTime->day) {
                    $this->priceLateChager += $this->price;
                } else {
                    $this->priceLateChager = $additionHour * $this->lateSurcharge + ($additionMinute >= $convertionTime->hour ? 1 : 0) * $this->lateSurcharge;
                }
            }
            // dd($this->priceEarlyChager, $this->priceLateChager);
        }
    }

    public function changeRentalTime()
    {
        if ($this->rentalTime && $this->checkOutDateTime && $this->checkInDateTime) {
            if ($this->typeTime == TypeTimeEnum::DAY) {
                if ($this->checkInDateTime)
                    $this->checkOutDateTime = Carbon::parse($this->checkInDateTime)->addDay($this->rentalTime)->format('Y-m-d');
                if ($this->checkOutDateTime)
                    $this->checkInDateTime = Carbon::parse($this->checkOutDateTime)->subDay($this->rentalTime)->format('Y-m-d');
            }
            if ($this->typeTime == TypeTimeEnum::HOUR) {
                $checkOutDateTime = Carbon::parse(date('Y-m-d ' . $this->hourIn, strtotime($this->checkInDateTime)))->addHour($this->rentalTime);
                $this->checkOutDateTime = $checkOutDateTime->format('Y-m-d');
            }
        }
    }

    public function changeFromAndToDateTime()
    {
        // dd('aa');
        if ($this->checkOutDateTime && $this->checkInDateTime) {
            $this->rentalTime = Carbon::parse($this->checkOutDateTime)->diffInDays(Carbon::parse($this->checkInDateTime));
        }
    }

    public function checkout()
    {
        // $this->validate([
        //     'hourOut' => 'required',
        //     'priceLateChager' => 'required',
        //     'priceEarlyChager' => 'required',
        //     'totalPriceService' => 'required',
        //     'totalPrice' => 'required',
        //     'price' => 'required',
        //     'checkOutDateTime' => 'required',
        // ]);
        try {
            DB::beginTransaction();
            $this->countPrice();
            $this->bookingInfo->hour_out = $this->hourOut;
            $this->bookingInfo->late_checkin_fee = $this->priceLateChager;
            $this->bookingInfo->early_checkIn_fee = $this->priceEarlyChager;
            $this->bookingInfo->price_service = $this->totalPriceService;
            $this->bookingInfo->total_price = $this->totalPrice;
            $this->bookingInfo->price = $this->price;
            $this->bookingInfo->save();
            $payment = new PayMent();
            $payment->creator_id = 1;
            $payment->customer_id = $this->customerInfo['id'];
            $payment->amount = $this->totalPrice + $this->priceLateChager + $this->priceEarlyChager - $this->deposit + $this->totalPriceService;
            $payment->phone = $this->customerInfo['phone'];
            $payment->cmtnd = $this->customerInfo['cmtnd'];
            $payment->payment_method = 1;
            $payment->note = $this->note;
            $payment->satus = 1;
            $payment->save();
            $this->idPayment = $payment->id;
            PaymentBooking::create([
                'booking_id' => $this->bookingInfo->id,
                'payment_id' => $payment->id
            ]);
            $this->bookingInfo->checkout_date = $this->checkOutDateTime ? Carbon::parse($this->bookingInfo['checkout_date']) : Carbon::now();
            $this->bookingInfo->save();
            Room::where('id', $this->idRoom)->update([
                'status' => StatusRoomEnum::PROCESSING
            ]);
            $this->statusRoom = StatusRoomEnum::PROCESSING;
            if (!$this->hourOut) {
                $this->hourOut = Carbon::now()->format('H:i:s');
                $this->bookingInfo->hour_out = $this->hourOut;
                $this->bookingInfo->save();
            }
            DB::commit();
            $this->isCheckout = 1;
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e]);
        }
    }
    public function clear()
    {
        try {
            DB::beginTransaction();
            Room::where('id', $this->idRoom)->update(['status' => StatusRoomEnum::EMPTY]);
            $this->bookingInfo->status = StatusBookingEnum::PAID;
            $this->bookingInfo->save();
            DB::commit();
            return redirect()->route('admin.bookroom.list_room');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function changeStatus()
    {
        try {
            if ($this->bookingInfo->type == TypeBooking::RESERVE && !$this->bookingInfo->checkin_date && $this->statusBooking == StatusBookingEnum::ACTIVE) {
                $this->bookingInfo->checkin_date = Carbon::now();
            }
            $this->bookingInfo->status = $this->statusBooking;
            $this->bookingInfo->save();
            $this->checkInDateTime = $this->bookingInfo->checkin_date;
            Room::where('id', $this->idRoom)->update(['status' => $this->statusRoom]);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Cập nhật thành công']);
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Cập nhật thất bại']);
        }
    }

    public function getCurrentTime()
    {
        $this->hourOut = Carbon::now()->format('H:i:s');
    }

    public function cancel()
    {
        try {
            DB::beginTransaction();
            $this->bookingInfo->status = StatusBookingEnum::RESERVE;
            $this->bookingInfo->save();
            DB::commit();
            return redirect()->route('admin.bookroom.list_room');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Thực hiện thất bại']);
        }
    }

    public function accept()
    {
        $this->checkEmpty();
        if ($this->roomIsEmpty) {
            try {
                DB::beginTransaction();
                $this->statusBooking = StatusBookingEnum::ACTIVE;
                $this->bookingInfo->status = $this->statusBooking;
                $this->bookingInfo->save();
                Room::where('id', $this->idRoom)->update(['status' => StatusRoomEnum::ACTIVE]);
                $this->statusRoom = StatusRoomEnum::ACTIVE;
                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Thực hiện thất bại']);
            }
        } else {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => 'Phòng đang được sử dụng không thể tiếp nhận khách nữa']);
        }
    }

    // public function Export($id)
    // {
    //     $order = Order::where('order.id', $id)->join('vendor', 'vendor.id', 'order.user');
    //     $data = $order->join('orderdetail', 'orderdetail.order_id', 'order.id')
    //         ->join('product', 'product.id', 'orderdetail.product_id')
    //         ->select(
    //             DB::raw(
    //                 'product.product_name as name,
    //             orderdetail.price as price,
    //             orderdetail.quantity as count,
    //             (orderdetail.price*orderdetail.quantity) as totalPrice'
    //             )
    //         )
    //         ->get();
    //     $info = $order->select(
    //         DB::raw('vendor.vendor_name as vendorname,vendor.vendor_address as address,order.totalPrice as price')
    //     )->first()->toArray();
    //     // dd($data, $info);
    //     return Excel::download(new OrderImportExport(
    //         $info['vendorname'],
    //         $info['address'],
    //         $info['price'],
    //         $data
    //     ), 'HoaDon' . date('Y-m-d-His') . '.xlsx');
    // }
}
