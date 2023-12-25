<?php

namespace App\Http\Livewire\Admin\Room;

use App\Models\RoomCapacity as ModelsRoomCapacity;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;
use Livewire\WithFileUploads;

class RoomCapacity extends Component
{
    use WithFileUploads;
    public $listCapacity;
    public $name;
    public $idUpdata;
    public $roomCapacity;
    public $numberOfBed;
    public $maxCapacity;
    public $numberOfadult;
    public $numberOfchildren;

    public function render()
    {
        $this->listCapacity = ModelsRoomCapacity::with('Img')->get()->toArray();
        return view('livewire.admin.room.room-capacity');
    }
    public function resetData()
    {
        $this->name = null;
        $this->idUpdata = null;
        $this->roomCapacity = null;
        $this->numberOfadult = null;
        $this->maxCapacity = null;
        $this->numberOfchildren = null;
        $this->numberOfBed = null;
    }
    public function update($id)
    {
        $this->roomCapacity = ModelsRoomCapacity::with('Img')->where('id', $id)->first();
        $this->name = $this->roomCapacity->name;
        $this->numberOfadult = $this->roomCapacity->number_of_adults;
        $this->maxCapacity = $this->roomCapacity->max_capacity;
        $this->numberOfchildren = $this->roomCapacity->number_of_children;
        $this->numberOfBed = $this->roomCapacity->number_of_bed;
        // dd($this->typeRoom);
    }
    public function create()
    {
        $this->validate([
            'name' => 'required',
            'numberOfadult' => 'required',
            'numberOfchildren' => 'required',
            'maxCapacity' => 'required',
            'numberOfBed' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $roomCa = new ModelsRoomCapacity();
            if ($this->roomCapacity) {
                $roomCa = ModelsRoomCapacity::where('id', $this->roomCapacity->id)->first();
            }
            $roomCa->name = $this->name;
            $roomCa->number_of_bed = $this->numberOfBed;
            $roomCa->max_capacity = $this->maxCapacity;
            $roomCa->number_of_adults = $this->numberOfadult;
            $roomCa->number_of_children = $this->numberOfchildren;
            $roomCa->save();
            DB::commit();
            $this->resetData();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e]);
        }
    }
    public function delete($id)
    {
        ModelsRoomCapacity::where('id', $id)->delete();
        $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
    }
}
