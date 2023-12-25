<?php

namespace App\Http\Livewire\User\Room;

use App\Models\TypeRoom;
use Livewire\Component;

class Index extends Component
{
    public $listRoomType;

    public function mount(){
        $this->listRoomType=TypeRoom::with('Img')->get()->toArray();
    }
    public function render()
    {
        return view('livewire.user.room.index');
    }
}
