<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductRoom;
use App\Models\Room;
use Livewire\Component;
use Throwable;

class Index extends Component
{
    public $listProduct;
    public $name;
    public $price;
    public $manufac;
    public $quantity;
    public $nameUpdate;
    public $priceUpdate;
    public $brandUpdate;
    public $quantityUpdate;
    public $idEdit;

    public function mount()
    {
        $this->listProduct = Product::get()->toArray();
    }
    public function render()
    {
        $this->getList();
        return view('livewire.admin.product.index');
    }
    public function resetData()
    {
        $this->nameUpdate = null;
        $this->priceUpdate = null;
        $this->brandUpdate = null;
        $this->quantityUpdate = null;
    }
    public function updateList()
    {
        $this->listProduct = Product::get()->toArray();
    }
    public function edit($id)
    {
        $this->idEdit = $id;
        $product = Product::where('id', $id)->first();
        $this->nameUpdate = $product['name'];
        $this->priceUpdate = $product['price'];
        $this->brandUpdate = $product['brand'];
        $this->quantityUpdate = $product['quantity'];
    }
    public function getList()
    {
        $list = Product::query();
        if ($this->name) $list->where('name', 'like', '%' . $this->name . '%');
        if ($this->price) $list->where('price', $this->price);
        if ($this->manufac) $list->where('brand', 'like', '%' . $this->manufac . '%');
        $this->listProduct = $list->get()->toArray();
    }
    public function create()
    {
        $this->validate([
            'nameUpdate' => 'required',
            'priceUpdate' => 'required',
            'brandUpdate' => 'required',
            'quantityUpdate' => 'required'
        ]);
        try {
            $product = new Product();
            if ($this->idEdit) {
                $product = Product::where('id', $this->idEdit)->first();
            }
            $product->name = $this->nameUpdate;
            $product->price = $this->priceUpdate;
            $product->brand = $this->brandUpdate;
            $product->quantity = $this->quantityUpdate;
            $product->save();
            $this->updateList();
            $this->resetData();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thực hiện thành công"]);
        } catch (Throwable $e) {
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Thực hiện thất bại"]);
        }
    }
    public function delete($id)
    {
        $room = ProductRoom::where('product_id', $id)->count();
        if ($room > 0) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'warning', 'message' => "Sản phẩm hiên vẫn có trong các phòng không thể xóa"]);
        } else {
            Product::where('id', $id)->delete();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Xóa thành công"]);
        }
    }
}
