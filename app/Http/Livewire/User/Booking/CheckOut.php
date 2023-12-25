<?php

namespace App\Http\Livewire\User\Booking;

use App\Enums\StatusBookingEnum;
use App\Enums\StatusRoomEnum;
use App\Enums\TaxEnum;
use App\Enums\TypeBooking;
use App\Enums\TypePriceEnum;
use App\Enums\TypeTimeEnum;
use App\Jobs\SendCheckOut;
use App\Jobs\SendPayment;
use App\Mail\SendMailCheckOut;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomTypeDetail;
use App\Models\TimeLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class CheckOut extends Component
{
    public $roomType;
    public $roomTypeDetail;
    public $fromDateTime;
    public $toDateTime;
    public $numberOfRoom = 1;
    public $dates = [];
    public $name;
    public $phone;
    public $cmtnd;
    public $email;
    public $rentalTime = 0;
    public $customer;
    public $customerAccount;
    public $adult;
    public $children;
    public $deposit;
    public $note;
    public $countroom;
    protected $listeners = ['setfromDate', 'settoDate'];

    public function mount()
    {
        $this->numberOfRoom = 1;
        if (auth()->check()) {
            $customer = Customer::where('account_id', auth()->user()->id)->first();
            if ($customer) {
                $this->customerAccount = $customer;
                $this->name = $customer->name;
                $this->phone = $customer->phone;
                $this->cmtnd = $customer->cmtnd;
                $this->email = $customer->email;
            }
        }
        $this->roomTypeDetail = RoomTypeDetail::with(['Img', 'Room', 'RoomCapacity', 'Service', 'TypeRoom', 'Price' => function ($q) {
            $q->where('type_price', TypePriceEnum::DAY);
        }, 'Convenient'])->where('id', $this->roomType)->first()->toArray();
        $this->changeFromAndToDateTime();
        // dd($this->roomTypeDetail);
        // $bookings = Booking::where('room_id', $this->idRoom)->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])->orderBy('checkin_date', 'ASC')->get()->toArray();
        // foreach ($bookings as $item) {
        //     $this->dates[] = [$item['checkin_date'], $item['checkout_date']];
        // }
        // $this->room = Room::with(['Img', 'Type', 'Floor', 'Service', 'Convenient'])->where('id', $this->idRoom)->first()->toArray();
        // DB::enableQueryLog();
        $listRoom = Room::where('type_room', $this->roomType)->where('status', StatusRoomEnum::EMPTY)->whereDoesntHave('Booking', function ($q) {
            $q->whereIn('status', [StatusBookingEnum::PENDING]);
            $q->where(function ($query) {
                $query->where(function ($qu) {
                    $qu->whereDate('checkin_date', '>=', date('Y-m-d', strtotime($this->fromDateTime)));
                    $qu->whereDate('checkout_date', '<=', date('Y-m-d', strtotime($this->toDateTime)));
                });
                $query->orWhere(function ($qu) {
                    $qu->whereDate('checkin_date', '<=', date('Y-m-d', strtotime($this->fromDateTime)));
                    $qu->whereDate('checkout_date', '>=', date('Y-m-d', strtotime($this->fromDateTime)));
                });
                $query->orWhere(function ($qu) {
                    $qu->whereDate('checkin_date', '<=', date('Y-m-d', strtotime($this->toDateTime)));
                    $qu->whereDate('checkout_date', '>=', date('Y-m-d', strtotime($this->toDateTime)));
                });
            });
        });
        // dd(DB::getQueryLog());
        // ->whereHas('Capacity', function ($q) {
        //     if ($this->adult)
        //         $q->where('number_of_adults', '>=', $this->adult);
        //     if ($this->children)
        //         $q->where('number_of_children', '>=', $this->children);
        // });
        $this->countroom = $listRoom->count();
        // dd($listRoom->get()->toArray());
    }
    public function changeFromAndToDateTime()
    {
        if ($this->fromDateTime && $this->toDateTime) {
            $this->rentalTime = Carbon::parse($this->fromDateTime)->diffInDays(Carbon::parse($this->toDateTime));
        }
    }
    public function render()
    {
        $this->updateUI();
        return view('livewire.user.booking.check-out');
    }
    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
        $this->dispatchBrowserEvent('setDatePicker');
    }
    public function setfromDate($time)
    {
        $this->fromDateTime = date('Y-m-d', strtotime($time['fromDateTime']));
        $this->changeFromAndToDateTime();
    }
    public function settoDate($time)
    {
        $this->toDateTime = date('Y-m-d', strtotime($time['toDateTime']));
        $this->changeFromAndToDateTime();
    }
    public function checkOut()
    {
        // dd($this->numberOfRoom);
        $this->validate([
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'cmtnd' => 'required',
            'name' => 'required',
            'fromDateTime' => 'required',
            'rentalTime' => 'required',
            'toDateTime' => 'required',
            'toDateTime' => 'required',
            'rentalTime' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $customer = Customer::where('email', $this->email)->where('phone', $this->phone)->where('cmtnd', $this->cmtnd)->first();
            if (auth()->check()) {
                if ($this->email != $this->customerAccount->email || $this->phone != $this->customerAccount->phone || $this->cmtnd != $this->customerAccount->cmtnd) {
                    Customer::where('id', $this->customerAccount->id)->update(['email' => $this->email, 'cmtnd' => $this->cmtnd, 'phone' => $this->phone]);
                    $customer = Customer::where('id', $this->customerAccount->id)->first();
                }
            } else {
                if (!$customer) {
                    $customer = Customer::create([
                        'code' => 'KH' . Customer::count(),
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'cmtnd' => $this->cmtnd,
                        'name' => $this->name,
                    ]);
                } else {
                    $customer->name = $this->name;
                    $customer->save();
                }
            }
            $listRoom = Room::with(['Type', 'Floor', 'Capacity'])->where('type_room', $this->roomType)->whereDoesntHave('Booking', function ($q) {
                $q->whereIn('status', [StatusBookingEnum::PENDING]);
                $q->where(function ($query) {
                    $query->where(function ($qu) {
                        $qu->whereDate('checkin_date', '>=', date('Y-m-d', strtotime($this->fromDateTime)));
                        $qu->whereDate('checkout_date', '<=', date('Y-m-d', strtotime($this->toDateTime)));
                    });
                    $query->orWhere(function ($qu) {
                        $qu->whereDate('checkin_date', '<=', date('Y-m-d', strtotime($this->fromDateTime)));
                        $qu->whereDate('checkout_date', '>=', date('Y-m-d', strtotime($this->fromDateTime)));
                    });
                    $query->orWhere(function ($qu) {
                        $qu->whereDate('checkin_date', '<=', date('Y-m-d', strtotime($this->toDateTime)));
                        $qu->whereDate('checkout_date', '>=', date('Y-m-d', strtotime($this->toDateTime)));
                    });
                });
            })->whereHas('Capacity', function ($q) {
                if ($this->adult)
                    $q->where('number_of_adults', '>=', $this->adult);
                if ($this->children)
                    $q->where('number_of_children', '>=', $this->children);
            })->orderBy('name', 'ASC')->limit($this->numberOfRoom)->get();
            $lisRoomShow = $listRoom;
            $listRoom = $listRoom->toArray();
            $this->deposit = 0.2 * $this->roomTypeDetail['price'][0]['price'] * $this->rentalTime * $this->numberOfRoom * (1 + TaxEnum::TAX / 100);
            $dataInsert = [];
            $ids = [];
            foreach ($listRoom as $item) {
                $book = new Booking();
                $book->customer_id = $customer->id;
                $book->room_id = $item['id'];
                $book->note = $this->note;
                $book->type = TypeBooking::RESERVE;
                $book->status = StatusBookingEnum::PENDING;
                $book->checkin_date = $this->fromDateTime;
                $book->checkout_date = $this->toDateTime;
                $book->rental_time =  $this->rentalTime;
                $timeLine = TimeLine::where('type_time', TypeTimeEnum::DAY)->first()->toArray();
                $book->hour_in = $timeLine['start_hour'];
                $book->type_time = TypeTimeEnum::DAY;
                $book->number_of_adults = $this->adult;
                $book->number_of_children = $this->children;
                $book->deposit = $this->deposit ?? 0;
                $book->save();
                $ids[] = $book->id;
                // $data = [];
                // $data['customer_id'] = $customer->id;
                // $data['room_id'] = $item['id'];
                // $data['note'] = $this->note;
                // $data['type'] = TypeBooking::RESERVE;
                // $data['status'] = StatusBookingEnum::PENDING;
                // $data['checkin_date'] = $this->fromDateTime;
                // $data['checkout_date'] = $this->toDateTime;
                // $data['rental_time'] =  $this->rentalTime;
                // $timeLine = TimeLine::where('type_time', TypeTimeEnum::DAY)->first()->toArray();
                // $data['hour_in'] = $timeLine['start_hour'];
                // $data['type_time'] = TypeTimeEnum::DAY;
                // $data['number_of_adults'] = $this->adult;
                // $data['number_of_children'] = $this->children;
                // $data['deposit'] = $this->deposit ?? 0;
                // $dataInsert[] = $data;
            }
            // Booking::insert($dataInsert);
            DB::commit();
            // dd($lisRoomShow);
            Mail::to($this->email)->send(new SendMailCheckOut($customer, $lisRoomShow));
            return redirect()->route('info_booking', ['idcustomer' => $customer->id, 'idbooking' => $ids]);
            // SendPayment::dispatch($this->email,$customer, $listRoom);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Tạo thất bại"]);
            return;
        }
    }
}
