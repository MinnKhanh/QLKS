<?php

namespace App\Http\Livewire\User\Room;

use App\Enums\StatusBookingEnum;
use App\Enums\StatusRoomEnum;
use App\Enums\TypeBooking;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class Detail extends Component
{
    public $idRoom;
    public $room;
    public $dates;
    public $fromDateTime;
    public $toDateTime;
    public $listServices;
    protected $listeners = ['setfromDate', 'settoDate'];

    public function mount()
    {
        $bookings = Booking::where('room_id', $this->idRoom)->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])->orderBy('checkin_date', 'ASC')->get()->toArray();
        foreach ($bookings as $item) {
            $this->dates[] = [$item['checkin_date'], $item['checkout_date']];
        }
        // dd($this->dates, $bookings);
        $this->room = Room::with('Service')->where('id', $this->idRoom)->first();
    }
    public function render()
    {
        $this->updateUI();
        return view('livewire.user.room.detail');
    }

    public function setfromDate($time)
    {
        $fromDate = date('Y-m-d', strtotime($time['fromDateTime']));
        if ($this->toDateTime) {

            // DB::enableQueryLog();
            $count = Booking::where('room_id', $this->idRoom)
                ->whereIn('status', [StatusBookingEnum::PENDING, StatusBookingEnum::ACTIVE])
                ->where('checkin_date', '>=', $fromDate)
                ->where('checkout_date', '<=', $this->toDateTime)
                ->count();
            // dd(DB::getQueryLog());
            // dd($count);
            if ($count) {
                $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Khoảng thời gian đã chọn có chứ lịch đã được đăng ký trước của phòng"]);
                return;
            }
        }
        $this->fromDateTime = date('Y-m-d', strtotime($time['fromDateTime']));
    }

    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
        $this->dispatchBrowserEvent('setDatePicker');
    }
    public function settoDate($time)
    {
        $toDate = date('Y-m-d', strtotime($time['toDateTime']));
        if ($this->fromDateTime) {
            $count = Booking::where('room_id', $this->idRoom)
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
    }
    public function Booking()
    {
        try {
            DB::beginTransaction();
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
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }
}
