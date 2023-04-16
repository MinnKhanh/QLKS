<?php

namespace App\Http\Livewire\Admin\Room;

use App\Enums\TypePriceEnum;
use App\Enums\TypeTime;
use App\Enums\TypeTimeEnum;
use App\Models\ConversionTime;
use App\Models\Price;
use App\Models\RoomCapacity;
use App\Models\RoomTypeDetail;
use App\Models\TimeLine;
use App\Models\TypeRoom;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Throwable;

class Create extends Component
{
    public $startTimeOfDay;
    public $endTimeOfDay;
    public $startTimeOfNigh;
    public $endTimeOfNight;
    public $numberOfHoursConvertedToDays;
    public $minutesConvertedToHours;
    public $numberOfHoursConvertedToOneNight;
    public $isAdd;
    public $list;
    public $typeRoom;
    public $capacityRoom;
    public $listCapacity = [];
    public $price;
    public $lateSurcharge;
    public $earlySurcharge;
    public $check = 1;
    public $listData = [];
    public $idUpdate = 0;
    public $typePrice = TypePriceEnum::Day;
    protected $listeners = ['change' => 'change'];
    public function mount()
    {
        // DB::enableQueryLog();
        $this->getData();
        // dd(DB::getQueryLog());
        // dd($this->listData);
        $timeLineDay = TimeLine::where('type_time', TypeTimeEnum::Day)->first();
        $timeLineNight = TimeLine::where('type_time', TypeTimeEnum::Night)->first();
        $numberOfHoursConvertedToDays = ConversionTime::where('type_time', TypeTimeEnum::Day)->first();
        $minutesConvertedToHours = ConversionTime::where('type_time', TypeTimeEnum::Hour)->first();
        $numberOfHoursConvertedToOneNight = ConversionTime::where('type_time', TypeTimeEnum::Night)->first();
        if ($timeLineDay) {
            $this->startTimeOfDay = $timeLineDay->start_hour;
            $this->endTimeOfDay = $timeLineDay->end_hour;
        }
        if ($timeLineNight) {
            $this->startTimeOfNigh = $timeLineNight->start_hour;
            $this->endTimeOfNight = $timeLineNight->end_hour;
        }
        if ($numberOfHoursConvertedToDays)
            $this->numberOfHoursConvertedToDays = $numberOfHoursConvertedToDays->time;
        if ($minutesConvertedToHours)
            $this->minutesConvertedToHours = $minutesConvertedToHours->time;
        if ($numberOfHoursConvertedToOneNight)
            $this->numberOfHoursConvertedToOneNight = $numberOfHoursConvertedToOneNight->time;
        // dd($this->listData);
    }
    public function getData()
    {
        $this->listData = RoomTypeDetail::with(['RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
            $q->where('prices.type_price', $this->typePrice);
        }])->whereHas('Price', function ($q) {
            return $q->where('prices.type_price', $this->typePrice);
        })->get()->toArray();
    }
    public function render()
    {
        // DB::enableQueryLog();
        // RoomCapacity::with('RoomTypeDetail')->whereHas('RoomTypeDetail', function (EloquentBuilder $query) {
        //     $query->where('type_room_id', '!=', 1);
        // })->get()->toArray();
        // dd(DB::getQueryLog());
        // if (!$this->check) {
        //     dd($this->price, $this->lateSurcharge, $this->earlySurcharge, $this->typeRoom, $this->capacityRoom);
        // }
        // $this->check = 0;


        $this->updateUI();

        return view('livewire.admin.room.create', ['listTypeRoom' => TypeRoom::get()->toArray()]);
    }
    public function changeTypeTimePrice($type)
    {
        $this->typePrice = $type;
        $this->getData();
        $this->change();
    }
    public function change()
    {
        $this->capacityRoom = null;
        $listTypedetailExists = RoomTypeDetail::where('type_room_id', $this->typeRoom)->whereHas('Price', function ($q) {
            $q->where('prices.type_price', $this->typePrice);
        })->where('id', '!=', $this->idUpdate)
            ->pluck('room_capacity_id')->toArray();
        $this->listCapacity = RoomCapacity::whereNotIn('id', $listTypedetailExists)->select(DB::raw('room_capacity.*'))->get()->toArray();
        // dd('dddd', $this->listCapacity);
    }

    public function updateUI()
    {
        $this->dispatchBrowserEvent('setSelect2');
    }
    public function updateDataTime()
    {
        $this->validate([
            'startTimeOfDay' => 'required',
            'endTimeOfDay' => 'required',
            'startTimeOfNigh' => 'required',
            'endTimeOfNight' => 'required',
            'numberOfHoursConvertedToDays' => 'required',
            'minutesConvertedToHours' => 'required',
            'numberOfHoursConvertedToOneNight' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $this->updateTimeLine(TypeTimeEnum::Day, $this->startTimeOfDay, $this->endTimeOfDay);
            $this->updateTimeLine(TypeTimeEnum::Night, $this->startTimeOfNigh, $this->endTimeOfNight);
            $this->updateConversionTime(TypeTimeEnum::Day, $this->numberOfHoursConvertedToDays);
            $this->updateConversionTime(TypeTimeEnum::Night, $this->numberOfHoursConvertedToOneNight);
            $this->updateConversionTime(TypeTimeEnum::Hour, $this->minutesConvertedToHours);
            DB::commit();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' =>  'Cập nhật thành công']);
            return;
            // return redirect()->route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
    public function updateTimeLine($type, $start, $end)
    {
        $timeLine = TimeLine::where('type_time', $type)->first();
        if (!$timeLine) {
            $timeLine = new TimeLine();
            $timeLine->type_time = $type;
        }
        $timeLine->start_hour = $start;
        $timeLine->end_hour = $end;
        $timeLine->save();
    }
    public function updateConversionTime($type, $time)
    {
        // $timeConversionLine = ConversionTime::where('type_time', $type)->first();
        // dd($type, $time);
        DB::table('conversion_time')->updateOrInsert(
            ['type_time' => $type],
            ['time' => intval($time)]
        );
    }
    public function addRoomType()
    {
        $this->isAdd = !$this->isAdd;
    }
    public function resetData()
    {
        $this->isAdd = 0;
        $this->typeRoom = null;
        $this->listCapacity = [];
        $this->capacityRoom = null;
        $this->price = null;
        $this->lateSurcharge = null;
        $this->earlySurcharge = null;
    }
    public function createRoomtype()
    {
        // dd($this->price, $this->lateSurcharge, $this->earlySurcharge, $this->typeRoom, $this->capacityRoom);
        $this->validate([
            'typeRoom' => 'required',
            'capacityRoom' => 'required',
            'lateSurcharge' => 'required',
            'earlySurcharge' => 'required',
            'price' => 'required',
        ]);
        try {
            // dd($this->price, $this->lateSurcharge, $this->earlySurcharge);
            DB::beginTransaction();
            $typeRoomDetail = null;
            $priceRoomType = null;
            if ($this->idUpdate) {
                $typeRoomDetail = RoomTypeDetail::where('id', $this->idUpdate)->first();
                $priceRoomType = Price::where('type_room_detail_id', $this->idUpdate)->where('type_price', $this->typePrice)->first();
            } else {
                $typeRoomDetail = new RoomTypeDetail();
                $priceRoomType = new Price();
                $priceRoomType->type_price = $this->typePrice;
            }
            $typeRoomDetail->type_room_id = $this->typeRoom;
            $typeRoomDetail->room_capacity_id = $this->capacityRoom;
            $typeRoomDetail->save();
            $priceRoomType->type_room_detail_id = $typeRoomDetail->id;
            $priceRoomType->price = floatval($this->price);
            $priceRoomType->late_surcharge = floatval($this->lateSurcharge);
            $priceRoomType->early_surcharge = floatval($this->earlySurcharge);
            $priceRoomType->save();
            // dd($typeRoomDetail);
            DB::commit();
            $this->idUpdate = 0;
            $this->listData = RoomTypeDetail::with(['RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
                $q->where('prices.type_price', $this->typePrice);
            }])->whereHas('Price', function ($q) {
                return $q->where('prices.type_price', $this->typePrice);
            })->get()->toArray();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'success', 'message' =>  'Cập nhật thành công']);
            $this->resetData();
            return;
            // return redirect()->route('shop.index');
        } catch (Throwable $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
    }
    public function update($id)
    {
        $this->idUpdate = $id;
        $dataUpdate = RoomTypeDetail::with(['RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
            $q->where('prices.type_price', $this->typePrice);
        }])->where('id', $id)->first()->toArray();
        // dd($dataUpdate['price'][0]);
        $this->typeRoom = $dataUpdate['type_room_id'];
        $this->change();
        $this->capacityRoom = $dataUpdate['room_capacity_id'];
        $this->price = $dataUpdate['price'][0]['price'];
        $this->lateSurcharge = $dataUpdate['price'][0]['late_surcharge'];
        $this->earlySurcharge = $dataUpdate['price'][0]['early_surcharge'];
        $this->isAdd = 1;
        $this->getData();
    }
}
