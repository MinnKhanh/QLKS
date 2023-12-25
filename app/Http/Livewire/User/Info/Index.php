<?php

namespace App\Http\Livewire\User\Info;

use App\Models\Customer;
use Livewire\Component;

class Index extends Component
{
    public $customer;
    public $code;
    public $name;
    public $address;
    public $email;
    public $district;
    public $city;
    public $cmtnd;
    public $phone;
    public $gender;
    public $birthDay;

    public function mount()
    {
        $this->customer = Customer::where('account_id', auth()->user()->id)->first();
        if ($this->customer) {
            $this->code = $this->customer->code;
            $this->name = $this->customer->name;
            $this->address = $this->customer->address;
            $this->email = $this->customer->email;
            $this->district = $this->customer->district;
            $this->city = $this->customer->city;
            $this->cmtnd = $this->customer->cmtnd;
            $this->phone = $this->customer->phone;
            $this->gender = $this->customer->gender;
            $this->birthDay = $this->customer->birth_day;
        }
    }
    public function render()
    {
        return view('livewire.user.info.index');
    }
    public function save()
    {
        $customer = Customer::where('account_id', auth()->user()->id)->first();
        if (!$this->customer) {
            $customer = new Customer();
        }
        $customer->code = $this->code;
        $customer->name = $this->name;
        $customer->address = $this->address;
        $customer->email = $this->email;
        $customer->district = $this->district;
        $customer->city = $this->city;
        $customer->cmtnd = $this->cmtnd;
        $customer->phone = $this->phone;
        $customer->gender = $this->gender;
        $customer->birth_day = $this->birthDay;
        $customer->save();
        $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Cập nhật thành công"]);
    }
}
