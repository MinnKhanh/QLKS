<?php

namespace App\Http\Livewire\Admin\Room;

use App\Enums\StatusRoomEnum;
use App\Enums\TypeImgEnum;
use App\Models\Floor;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductRoom;
use App\Models\Room;
use App\Models\RoomTypeDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class CreateRoom extends Component
{
    use WithFileUploads;
    public $listRoom;
    public $name;
    public $type;
    public $capacity;
    public $photos;
    public $description;
    public $listType;
    public $floor;
    public $listFloor;
    public $code;
    public $itemEdit;
    public $listImg;
    public $isEdit = 0;
    public $listProduct = [];
    public $idRoomProduct;
    public $listAddProduct = [];
    public $productCount;
    public $productAdd;
    public $listTypeRoom;
    protected $listeners = ['updateCount'];

    public function mount()
    {
        $this->listType = RoomTypeDetail::with(['RoomCapacity', 'TypeRoom'])->get()->toArray();
        $this->listFloor = Floor::get()->toArray();
        // dd($this->listType);
        $this->listRoom = Room::with(['Type', 'Floor', 'Capacity'])->get()->toArray();
    }
    public function getRoom()
    {
        $list = Room::with(['Type', 'Floor', 'Capacity']);
        if ($this->name) $list->where('name', 'like', '%' . $this->name . '%');
        if ($this->type) $list->where('type_room', $this->type);
        $this->listRoom = $list->get()->toArray();
    }
    public function render()
    {
        $this->getRoom();
        // dd($this->photos);
        return view('livewire.admin.room.create-room');
    }
    public function updateCount($data)
    {
        $this->updateCountProduct($data[1], $data[0]);
    }
    public function getProduct($id)
    {
        $this->idRoomProduct = $id;
        $idroom = ProductRoom::where('room_id', $id)->pluck('product_id');
        $this->listProduct = Product::with(['ProductRoom' => function ($q) {
            $q->where('room_id', $this->idRoomProduct);
        }])->whereIn('id', $idroom)->get()->toArray();
        $this->listAddProduct = Product::whereNotIn('id', $idroom)->get()->toArray();
    }
    public function addProduct()
    {

        $count = Product::where('id', $this->productAdd)->first()->quantity;
        if ($count < $this->productCount) $this->dispatchBrowserEvent('show-toast', ['type' => 'erroe', 'message' => "Quá số lượng trong kho"]);
        else {
            try {
                DB::beginTransaction();
                ProductRoom::create([
                    'room_id' => $this->idRoomProduct,
                    'product_id' => $this->productAdd,
                    'quantity' => $this->productCount
                ]);
                Product::where('id', $this->productAdd)->update(['quantity' => $count - $this->productCount]);
                DB::commit();
                $this->getProduct($this->idRoomProduct);
            } catch (Throwable $e) {
                DB::rollBack();
                $this->dispatchBrowserEvent('show-toast', ['type' => 'erroe', 'message' => "Cập nhật thất bại"]);
            }
        }
    }
    public function updateCountProduct($id, $quantity)
    {
        $count = Product::where('id', $id)->first()->quantity;
        if ($count < $quantity) $this->dispatchBrowserEvent('show-toast', ['type' => 'erroe', 'message' => "Quá số lượng trong kho"]);
        else {
            try {
                DB::beginTransaction();
                $productroom = ProductRoom::where('room_id', $this->idRoomProduct)->where('product_id', $id)->first();
                Product::where('id', $this->productAdd)->update(['quantity' => $count + $productroom->quantity - $quantity]);
                if ($quantity <= 0) $productroom->delete();
                else {
                    $productroom->quantity = $quantity;
                    $productroom->save();
                }
                $this->getProduct($this->idRoomProduct);
                DB::commit();
                $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Cập nhật thành công"]);
            } catch (Throwable $e) {
                DB::rollBack();
                $this->dispatchBrowserEvent('show-toast', ['type' => 'erroe', 'message' => "Cập nhật thất bại"]);
            }
        }
    }
    public function create()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'code' => 'required',
            'description' => 'required',
            'floor' => 'required',
        ]);
        try {
            DB::beginTransaction();
            if ($this->isEdit) {
                $room = Room::where('id', $this->itemEdit['id'])->first();
            } else {
                $room = new Room();
            }
            $room->name = $this->name;
            $room->type_room = $this->type;
            $room->code = $this->code;
            $room->description = $this->description;
            $room->status = StatusRoomEnum::EMPTY;
            $room->floor_id = $this->floor;
            $room->save();
            if ($this->photos) {
                foreach ($this->photos as $photo) {
                    $logo = $photo->store('public/room/');
                    $logo = str_replace("public/room/", "", $logo);
                    Image::create([
                        'path' => $logo,
                        'object_id' => $room->id,
                        'type' => TypeImgEnum::ROOM_IMG,
                    ]);
                }
            }
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Tạo thành công']);
            $this->resetData();
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e]);
        }
    }
    public function resetData()
    {
        $this->name = null;
        $this->type = null;
        $this->code = null;
        $this->description = null;
        $this->floor = null;
        $this->photos = null;
        $this->itemEdit = null;
        $this->isEdit = 0;
    }
    public function edit($id)
    {
        $this->isEdit = 1;
        $this->itemEdit = Room::with(['Img'])->where('id', $id)->first()->toArray();
        $this->name = $this->itemEdit['name'];
        $this->type = $this->itemEdit['type_room'];
        $this->code = $this->itemEdit['code'];
        $this->description = $this->itemEdit['description'];
        $this->floor = $this->itemEdit['floor_id'];
        // dd($this->itemEdit);
        $this->listImg = $this->itemEdit['img'];
    }
    public function removeImg($id, $index)
    {
        try {
            DB::beginTransaction();
            Image::where('id', $id)->delete();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => 'Xóa ảnh thành công']);
            unset($this->listImg[$index]);
            DB::commit();
            return;
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => 'Không thể xóa']);
            DB::rollBack();
            return;
        }
    }
}
