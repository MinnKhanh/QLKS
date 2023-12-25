<?php

namespace App\Http\Livewire\User\Room;

use App\Enums\StatusBookingEnum;
use App\Enums\StatusRoomEnum;
use App\Models\Room;
use App\Models\RoomTypeDetail;
use App\Models\TypeRoom;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListRoom extends Component
{
    public $typeId;
    public $listRoom;
    public $listTypeDetail;
    public $fromDateTime;
    public $toDateTime;
    public $check = 0;
    public $adult;
    public $children;
    public $dates = [];
    public $numberOfRoom = 0;

    protected $listeners = ['setfromDate', 'settoDate'];

    public function mount()
    {

        // $this->listTypeDetail = RoomTypeDetail::where('type_room_id', $this->typeId)->pluck('id')->toArray();
        // dd($this->listTypeDetail);
        // $this->listRoom = Room::with(['Img', 'Type', 'Floor', 'Service', 'Convenient'])->whereIn('type_room', $this->listTypeDetail)->get()->toArray();
        $this->listTypeDetail = RoomTypeDetail::with(['Img', 'Room', 'RoomCapacity', 'Service', 'TypeRoom', 'Price', 'Convenient'])->withCount('Room')
            ->get()->toArray();
        // dd($this->listTypeDetail);
        // $this->listTypeDetail = array_filter($this->listTypeDetail, fn ($n) => $n['room_count'] > 2);
        // dd($this->listTypeDetail);
    }
    public function showAlert()
    {
        $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Vui lòng nhập đầy đủ thông tin đặt phòng bên trên"]);
    }
    public function checkValidate()
    {
        if (!$this->fromDateTime || !$this->toDateTime || !$this->adult || !$this->children) {
            $this->check = 0;
        } else {
            $this->check = 1;
        }
    }
    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
        $this->dispatchBrowserEvent('setDatePicker');
    }
    public function render()
    {
        $this->checkValidate();
        $this->updateUI();
        return view('livewire.user.room.list-room');
    }

    public function setfromDate($time)
    {
        $this->fromDateTime = date('Y-m-d', strtotime($time['fromDateTime']));
    }
    public function settoDate($time)
    {
        $this->toDateTime = date('Y-m-d', strtotime($time['toDateTime']));
    }
    public function search()
    {
        // dd($this->dateIn, $this->dateOut);
        $this->listTypeDetail = RoomTypeDetail::with(['Img', 'Room', 'RoomCapacity', 'TypeRoom', 'Service', 'Price', 'Convenient'])
            ->whereHas('Room', function ($q) {
                $q->whereDoesntHave('Booking', function ($q) {
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
                });
            })->withCount('Room')
            ->get()->toArray();
        $this->listTypeDetail = array_filter($this->listTypeDetail, function ($a) {
            return $a['room_count'] >= $this->numberOfRoom;
        });
        // $list = Room::with('Img')->whereDoesntHave('Booking', function ($q) {
        //     $q->whereDate('checkin_date', '>=', date('Y-m-d', strtotime($this->dateIn)));
        //     $q->whereDate('checkout_date', '<=', date('Y-m-d', strtotime($this->dateOut)));
        //     $q->whereIn('status', [StatusRoomEnum::ACTIVE, StatusBookingEnum::PENDING]);
        // })->whereHas('Capacity', function ($q) {
        //     if ($this->adult)
        //         $q->where('number_of_adults', '>=', $this->adult);
        //     if ($this->children)
        //         $q->where('number_of_children', '>=', $this->children);
        // });
        // $this->listRoom = $list->whereIn('type_room', $this->listTypeDetail)->get();
    }
}
