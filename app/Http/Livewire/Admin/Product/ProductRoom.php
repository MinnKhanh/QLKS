<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Room;
use Livewire\Component;

class ProductRoom extends Component
{
    public $listRoom;
    public $listProduct;
    public function mount()
    {
        $this->listRoom = Room::get()->toArray();
        $this->listProduct = Product::get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.product.product-room');
    }

    public function addProduct($idRoom, $idProduct, $count)
    {
        $productRoom = ProductRoom::where('room_id', $idRoom)->where('product_id', $idProduct)->first();
        if ($productRoom && $count) {
        }
        if (!$productRoom) {
            $productRoom = new Product();
            $productRoom->room_id = $idRoom;
            $productRoom->product_id = $idProduct;
        }
        $productRoom->quantity = $count;
    }
    public function updateProductRoom($idRoom, $idProduct, $count)
    {
    }
}
