<?php

namespace App\Http\Livewire\Admin\Room;

use App\Enums\TypeImgEnum;
use App\Models\Image;
use App\Models\TypeRoom as ModelsTypeRoom;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;
use Livewire\WithFileUploads;

class TypeRoom extends Component
{
    use WithFileUploads;
    public $listTypeRoom;
    public $name;
    public $photo;
    public $idUpdata;
    public $typeRoom;

    public function render()
    {
        $this->listTypeRoom = ModelsTypeRoom::with('Img')->get()->toArray();
        return view('livewire.admin.room.type-room');
    }
    public function resetData(){
        $this->name=null;
        $this->idUpdata=null;
        $this->photo=null;
        $this->typeRoom=null;
    }
    public function update($id){
        $this->typeRoom=ModelsTypeRoom::with('Img')->where('id',$id)->first();
        $this->name=$this->typeRoom->name;
        // dd($this->typeRoom);
    }
    public function create(){
        $this->validate([
            'name' => 'required'
        ]);
        try{
            DB::beginTransaction();
            $roomtyp=new ModelsTypeRoom();
            if($this->typeRoom){
                $roomtyp= ModelsTypeRoom::where('id',$this->typeRoom->id)->first();
            }
            $roomtyp->name=$this->name;
            $roomtyp->save();
            if($this->photo){
                    $logo = $this->photo->store('public/room/');
                    $logo = str_replace("public/room/", "", $logo);
                    Image::create([
                        'path' => $logo,
                        'object_id' => $roomtyp->id,
                        'type' => TypeImgEnum::TYPE_ROOM_IMG,
                    ]);
            }
            DB::commit();
            $this->resetData();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
        }catch(Throwable $e){
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e]);
        }
    }
    public function delete($id){
        ModelsTypeRoom::where('id',$id)->delete();
        $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa thành công']);
    }
}
