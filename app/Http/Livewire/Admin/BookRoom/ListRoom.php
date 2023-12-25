<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Enums\StatusBookingEnum;
use App\Enums\TypeBooking;
use App\Models\Floor;
use App\Models\Room;
use App\Models\RoomTypeDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListRoom extends Component
{
    public $listRoom;
    public $listType;
    public $listFloor;
    public $type;
    public $name;
    public $status;
    public $floor;

    public function mount()
    {

        $this->listType = RoomTypeDetail::with(['RoomCapacity', 'TypeRoom'])->get()->toArray();
        $this->listFloor = Floor::get()->toArray();
        // DB::enableQueryLog();
        // dd(DB::getQueryLog());
        // dd($this->listRoom);
    }
    public function render()
    {

        $this->listRoom =$this->getListRoom();
        return view('livewire.admin.book-room.list-room');
    }
    public function getListRoom(){
        $list=Room::with(['Type', 'Booking' => function ($q) {
            $q->where(function ($qu) {
                $qu->where('status', StatusBookingEnum::ACTIVE)
                    ->orWhere(function ($query) {
                        $query->where('type', TypeBooking::RESERVE)->where('status', StatusBookingEnum::PENDING)
                            ->whereDate('checkin_date', '<=', date('Y-m-d'))
                            ->whereDate('checkout_date', '>=', date('Y-m-d'));
                    });
            });
        }]);
        if($this->floor){
            $list->where('floor_id', $this->floor);
        }
        if($this->type){
            $list->where('type_room', $this->type);
        }
        if($this->status){
            $list->where('status', $this->status);
        }if($this->name){
            $list->where('name', 'like', '%'.$this->name .'%');
        }
        return $list->get()->toArray();
    }
}
