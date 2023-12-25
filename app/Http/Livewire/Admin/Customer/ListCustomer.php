<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class ListCustomer extends Component
{
    public $listCustomer;
    public $name;
    public $phone;
    public $cmtnd;
    public $customerCmtnd = null;
    public $customerName = null;
    public $customerPhone = null;
    public $customerCode = null;
    public $customerSex = null;
    public $customerCity = null;
    public $customerAddress = null;
    public $idEdit;

    public function mount()
    {
        $this->listCustomer = Customer::get()->toArray();
    }
    public function render()
    {
        $this->loadList();
        return view('livewire.admin.customer.list-customer');
    }
    public function loadList()
    {
        $list = Customer::query();
        if ($this->name) $list->where('name', 'like', '%' . $this->name . '%');
        if ($this->phone) $list->where('phone', 'like', '%' . $this->phone . '%');
        if ($this->cmtnd) $list->where('cmtnd', 'like', '%' . $this->cmtnd . '%');
        $this->listCustomer = $list->get()->toArray();
    }
    public function edit($id)
    {
        $this->idEdit = $id;
        $custoemr = Customer::where('id', $id)->first();
        $this->customerCmtnd = $custoemr['cmtnd'];
        $this->customerCode = $custoemr['code'];
        $this->customerName = $custoemr['name'];
        $this->customerPhone = $custoemr['phone'];
        $this->customerSex = $custoemr['gender'];
        $this->customerAddress = $custoemr['address'];
    }
    public function create()
    {
        $this->validate([
            'customerName' => 'required',
            'customerCode' => 'required',
            'customerAddress' => 'required',
            'customerPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'customerCmtnd' => 'required',
            'customerSex' => 'required|numeric'
        ]);
        try {
            DB::beginTransaction();
            $customer = new Customer();
            if ($this->idEdit) {
                $customer = Customer::where('id', $this->idEdit)->first();
            }
            $customer->name = $this->customerName;
            $customer->phone = $this->customerPhone;
            $customer->cmtnd = $this->customerCmtnd;
            $customer->address = $this->customerAddress;
            $customer->gender = $this->customerSex;
            $customer->code = $this->customerCode;
            $customer->save();
            DB::commit();
            $this->loadList();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thêm mới thành công"]);
            $this->resetData();
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Thêm mới thất bại"]);
        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Customer::where('id', $id)->delete();
            DB::commit();
            $this->loadList();
            $this->resetData();
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }
    public function resetData()
    {
        $this->customerCmtnd = null;
        $this->customerName = null;
        $this->customerPhone = null;
        $this->customerCode = null;
        $this->customerSex = null;
        $this->customerCity = null;
        $this->customerAddress = null;
    }
}
