<?php

namespace App\Http\Livewire\Admin\BookRoom;

use Livewire\WithPagination;
use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    use WithPagination;
    public $listRoom = [];
    public $typeTime = 1;
    public $perPage;
    public function mount()
    {
        $this->perPage = 4;

        // dd($this->listRoom);
    }
    public function render()
    {
        $this->getData();
        $this->updateUI();
        return view('livewire.admin.book-room.create', ['listRooms' => $this->paginate($this->listRoom)]);
    }
    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
    }
    public function getData()
    {


        $this->listRoom = array_values(array_filter(Room::with(['Floor', 'Type' => function ($q) {
            $q->with(['RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
                $q->where('prices.type_price', $this->typeTime);
            }])->whereHas('Price', function ($q) {
                return $q->where('prices.type_price', $this->typeTime);
            });
        }])->get()->toArray(), function ($ele) {
            return $ele['type'];
        }));
    }
    public function paginate($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
