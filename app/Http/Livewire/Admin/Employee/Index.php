<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Throwable;

class Index extends Component
{
    public $listEmployee;
    public $idUpdate;
    public $nameSearch = '';
    public $phoneSearch = '';
    public $cmtndSearch = '';
    public $name;
    public $position;
    public $cmtnd;
    public $phone;
    public $email;
    public $gender;
    public $birthDay;
    public $bankNumber;
    public $bankName;
    public $address;
    public $description;
    public $emailAccount;
    public $passwordAccount;
    public $passwordAccountConfirm;
    public $nameAccount;
    public $idAccountUpdate;
    public $listPosition;
    public $role;

    public function mount()
    {
        $this->listEmployee = Employee::withCount('Account')->get()->toArray();
        $this->listPosition = Position::get()->toArray();
    }
    public function render()
    {
        $this->getList();
        return view('livewire.admin.employee.index');
    }
    public function create()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'cmtnd' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required',
            'gender' => 'required|numeric',
            'birthDay' => 'required',
            'bankNumber' => 'required',
            'bankName' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);
        try {
            $employee = new Employee();
            if ($this->idUpdate) {
                $employee = Employee::where('id', $this->idUpdate)->first();
            }
            $employee->name = $this->name;
            $employee->position_id = $this->position;
            $employee->cmtnd = $this->cmtnd;
            $employee->phone = $this->phone;
            $employee->email = $this->email;
            $employee->gender = $this->gender;
            $employee->birth_day = $this->birthDay;
            $employee->bank_number = $this->bankNumber;
            $employee->bank_name = $this->bankName;
            $employee->home_town = $this->address;
            $employee->description = $this->description;
            $employee->save();
            $this->idUpdate = null;
            $this->resetData();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thực hiện thành công"]);
        } catch (Throwable $e) {
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Thực hiện thất bại"]);
        }
    }
    public function getList()
    {
        $list = Employee::query();
        if ($this->nameSearch) $list->where('name', 'like', '%' . $this->nameSearch . '%');
        if ($this->phoneSearch) $list->where('phone', 'like', '%' . $this->phoneSearch . '%');
        if ($this->cmtndSearch) $list->where('cmtnd', 'like', '%' . $this->cmtndSearch . '%');
        $this->listEmployee = $list->withCount('Account')->get()->toArray();
    }
    public function createAccount()
    {
        try {
            DB::beginTransaction();
            $account = Admin::create(['email' => $this->emailAccount, 'password' => Hash::make($this->passwordAccount), 'name' => $this->nameAccount]);
            // dd($account);
            Employee::where('id', $this->idUpdate)->update(['account_id' => $account->id]);
            DB::table('model_has_roles')->insert(['role_id' => $this->role, 'model_type' => Admin::class, 'model_id' => $account->id]);
            DB::commit();
            $this->resetData();
            $this->idUpdate = null;
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Thêm mới thành công"]);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Thêm mới thất bại"]);
        }
    }
    public function updateAccount()
    {
        if ($this->passwordAccount && $this->nameAccount) {
            $employee = Admin::where('id', $this->idAccountUpdate)->first();
            $employee->email = $this->emailAccount;
            $employee->name = $this->nameAccount;
            $employee->save();
            if ($this->role) {
                DB::table('model_has_roles')->where('model_id', $employee->id)->delete();
                DB::table('model_has_roles')->insert(['role_id' => $this->role, 'model_type' => Admin::class, 'model_id' => $this->idAccountUpdate]);
            }
            $this->idAccountUpdate = null;
            $this->resetData();
        } else $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Vui lòng nhập đầy đủ thông tin"]);
    }
    public function editPassword($id)
    {
        $this->idAccountUpdate = Employee::where('id', $id)->first()->account_id;
    }
    public function updatePassword()
    {
        try {
            if ($this->idAccountUpdate)
                Admin::where('id', $this->idAccountUpdate)->update(['password' => Hash::make($this->passwordAccount)]);
            $this->idAccountUpdate = null;
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Cập nhật thành công"]);
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'error' => "Cập nhật thất bại"]);
        }
    }
    public function resetData()
    {
        $this->name = null;
        $this->position = null;
        $this->cmtnd = null;
        $this->phone = null;
        $this->email = null;
        $this->gender = null;
        $this->birthDay = null;
        $this->bankNumber = null;
        $this->bankName = null;
        $this->address = null;
        $this->description = null;
        $this->emailAccount = null;
        $this->passwordAccount = null;
        $this->passwordAccountConfirm = null;
        $this->role = null;
        $this->nameAccount = null;
    }
    public function edit($id)
    {
        $this->idUpdate = $id;
        $employee = Employee::where('id', $id)->first();
        $this->name = $employee->name;
        $this->position = $employee->position_id;
        $this->cmtnd = $employee->cmtnd;
        $this->phone = $employee->phone;
        $this->email = $employee->email;
        $this->gender = $employee->gender;
        $this->birthDay = $employee->birth_day;
        $this->bankNumber = $employee->bank_number;
        $this->bankName = $employee->bank_name;
        $this->address = $employee->home_town;
        $this->description = $employee->description;
    }
    public function editAccount($id)
    {
        $idAccount = Employee::where('id', $id)->first()->account_id;
        $account = Admin::where('id', $idAccount)->first();
        $this->nameAccount = $account->name;
        $this->emailAccount = $account->email;
        $this->passwordAccount = $account->password;
        $role = DB::table('model_has_roles')->where('model_id', $account->id)->first();
        $this->idAccountUpdate = $account->id;
        $this->role = $role ? $role->role_id : null;
    }
    public function addAccount($id)
    {
        $this->resetData();
        $this->idUpdate = $id;
    }
    public function delete($id)
    {
        try {
            Employee::where('id', $id)->delete();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' => "Xóa thành công"]);
        } catch (Throwable $e) {
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => "Xóa thất bại"]);
        }
    }
}
