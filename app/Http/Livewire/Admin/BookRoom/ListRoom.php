<?php

namespace App\Http\Livewire\Admin\BookRoom;

use App\Models\Room;
use Livewire\Component;

class ListRoom extends Component
{
    public $listRoom;

    public function mount()
    {
        $this->listRoom = Room::with(['Type', 'Booking' => function ($q) {
            $q->where('status', 1);
        }])->get()->toArray();
        // dd($this->listRoom);
    }
    public function render()
    {
        return view('livewire.admin.book-room.list-room');
    }
}
