<?php

namespace App\Http\Livewire\Admin\Room;

use App\Enums\TypeImgEnum;
use App\Enums\TypePriceEnum;
use App\Enums\TypeTime;
use App\Enums\TypeTimeEnum;
use App\Models\ConversionTime;
use App\Models\Image;
use App\Models\Price;
use App\Models\RoomCapacity;
use App\Models\RoomTypeDetail;
use App\Models\RoomTypeService;
use App\Models\Service;
use App\Models\TimeLine;
use App\Models\TypeRoom;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use WithFileUploads;
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
    public $typePrice = TypePriceEnum::DAY;
    protected $listeners = ['change' => 'change'];
    public $priceDayNew;
    public $lateChargeDayNew;
    public $earlyChargeDayNew;
    public $priceHourNew;
    public $lateChargeHourNew;
    public $earlyChargeHourNew;
    public $priceNightNew;
    public $lateChargeNightNew;
    public $earlyChargeNightNew;
    public $photos;
    public $idEdit = 0;
    public $photoEdit;
    public $listServices = [];
    public $listServiceCurrent = [];
    public $photoUpdate;
    public $idRoomTypeService = 0;
    public function mount()
    {
        // DB::enableQueryLog();
        $this->getData();
        // dd(DB::getQueryLog());
        // dd($this->listData);
        $timeLineDay = TimeLine::where('type_time', TypeTimeEnum::DAY)->first();
        $timeLineNight = TimeLine::where('type_time', TypeTimeEnum::NIGHT)->first();
        $ConvertedTime = ConversionTime::first();
        // $minutesConvertedToHours = ConversionTime::where('type_time', TypeTimeEnum::HOUR)->first();
        // $numberOfHoursConvertedToOneNight = ConversionTime::where('type_time', TypeTimeEnum::NIGHT)->first();
        if ($timeLineDay) {
            $this->startTimeOfDay = $timeLineDay->start_hour;
            $this->endTimeOfDay = $timeLineDay->end_hour;
        }
        if ($timeLineNight) {
            $this->startTimeOfNigh = $timeLineNight->start_hour;
            $this->endTimeOfNight = $timeLineNight->end_hour;
        }
        if ($ConvertedTime) {
            $this->numberOfHoursConvertedToDays = $ConvertedTime->day;
            $this->minutesConvertedToHours = $ConvertedTime->hour;
            $this->numberOfHoursConvertedToOneNight = $ConvertedTime->night;
        }
        // if ($minutesConvertedToHours)
        //     $this->minutesConvertedToHours = $minutesConvertedToHours->time;
        // if ($numberOfHoursConvertedToOneNight)
        //     $this->numberOfHoursConvertedToOneNight = $numberOfHoursConvertedToOneNight->time;
        // dd($this->numberOfHoursConvertedToDays);
    }
    public function getData()
    {
        $this->listData = RoomTypeDetail::with(['Img', 'RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
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
    public function showService($id)
    {
        $this->idRoomTypeService = $id;

        $serviceIds = RoomTypeService::where('room_type_id', $id)->pluck('service_id');
        $this->listServiceCurrent = Service::with('Type')->whereHas('Type', function ($q) {
            $q->where('type_service', 1);
        })->whereIn('id', $serviceIds)->get()->toArray();
        $this->listServices = Service::with('Type')->whereHas('Type', function ($q) {
            $q->where('type_service', 1);
        })->whereNotIn('id', $serviceIds)->get()->toArray();
    }
    public function addService($id)
    {
        RoomTypeService::create(['room_type_id' => $this->idRoomTypeService, 'service_id' => $id]);
        $this->showService($this->idRoomTypeService);
    }
    public function removeService($id)
    {
        // dd($id, $this->idRoomTypeService);
        RoomTypeService::where('service_id', $id)->where('room_type_id', $this->idRoomTypeService)->delete();
        $this->showService($this->idRoomTypeService);
    }
    public function toggleAdd()
    {
        $this->isAdd = null;
        $this->resetData();
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
            $this->updateTimeLine(TypeTimeEnum::DAY, $this->startTimeOfDay, $this->endTimeOfDay);
            $this->updateTimeLine(TypeTimeEnum::NIGHT, $this->startTimeOfNigh, $this->endTimeOfNight);
            $this->updateConversionTime(TypeTimeEnum::DAY, $this->numberOfHoursConvertedToDays);
            $this->updateConversionTime(TypeTimeEnum::NIGHT, $this->numberOfHoursConvertedToOneNight);
            $this->updateConversionTime(TypeTimeEnum::HOUR, $this->minutesConvertedToHours);
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
        if ($type == TypeTimeEnum::DAY) DB::table('conversion_time')->update(['day' => $time]);
        if ($type == TypeTimeEnum::HOUR) DB::table('conversion_time')->update(['hour' => $time]);
        if ($type == TypeTimeEnum::NIGHT) DB::table('conversion_time')->update(['night' => $time]);
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
        $this->priceDayNew = null;
        $this->lateChargeDayNew = null;
        $this->earlyChargeDayNew = null;
        $this->priceHourNew = null;
        $this->lateChargeHourNew = null;
        $this->earlyChargeHourNew = null;
        $this->priceNightNew = null;
        $this->lateChargeNightNew = null;
        $this->earlyChargeNightNew = null;
        $this->idEdit = 0;
    }
    // public function edit($idEdit)
    // {
    //     // dd($idEdit);
    //     $this->idEdit = $idEdit;
    //     $typeRoomDetail = RoomTypeDetail::with(['Price' => function ($q) {
    //         $q->pluck('price', 'type_price');
    //     }])->where('id', $this->idEdit)->first();
    //     dd($typeRoomDetail);
    //     $this->priceDayNew = null;
    //     $this->lateChargeDayNew = null;
    //     $this->earlyChargeDayNew = null;
    //     $this->priceHourNew = null;
    //     $this->lateChargeHourNew = null;
    //     $this->earlyChargeHourNew = null;
    //     $this->priceNightNew = null;
    //     $this->lateChargeNightNew = null;
    //     $this->earlyChargeNightNew = null;
    //     $this->idEdit = 0;
    // }
    public function create()
    {
        $this->validate([
            'typeRoom' => 'required',
            'capacityRoom' => 'required',
            'priceDayNew' => 'required',
            'lateChargeDayNew' => 'required',
            'earlyChargeDayNew' => 'required',
            'priceHourNew' => 'required',
            'lateChargeHourNew' => 'required',
            'earlyChargeHourNew' => 'required',
            'priceNightNew' => 'required',
            'lateChargeNightNew' => 'required',
            'earlyChargeNightNew' => 'required',
        ]);
        try {
            // dd($this->price, $this->lateSurcharge, $this->earlySurcharge);
            DB::beginTransaction();
            $typeRoomDetail = new RoomTypeDetail();
            if ($this->idEdit) {
                $typeRoomDetail = RoomTypeDetail::where('id', $this->idEdit)->first();
            }
            $typeRoomDetail->type_room_id = $this->typeRoom;
            $typeRoomDetail->room_capacity_id = $this->capacityRoom;
            $typeRoomDetail->save();
            if ($this->idEdit) {
                Price::where('type_room_detail_id', $this->idEdit)->where('type_price', TypePriceEnum::DAY)->update([
                    'price' => $this->priceDayNew,
                    'late_surcharge' => $this->lateChargeDayNew,
                    'early_surcharge' => $this->earlyChargeDayNew
                ]);
                Price::where('type_room_detail_id', $this->idEdit)->where('type_price', TypePriceEnum::HOUR)->update([
                    'price' => $this->priceHourNew,
                    'late_surcharge' => $this->lateChargeHourNew,
                    'early_surcharge' => $this->earlyChargeHourNew
                ]);
                Price::where('type_room_detail_id', $this->idEdit)->where('type_price', TypePriceEnum::NIGHT)->update([
                    'price' => $this->priceNightNew,
                    'late_surcharge' => $this->lateChargeNightNew,
                    'early_surcharge' => $this->earlyChargeNightNew
                ]);
            } else {
                $listPrice = [
                    [
                        'type_room_detail_id' => $typeRoomDetail->id,
                        'type_price' => TypePriceEnum::DAY,
                        'price' => $this->priceDayNew,
                        'late_surcharge' => $this->lateChargeDayNew,
                        'early_surcharge' => $this->earlyChargeDayNew
                    ],
                    [
                        'type_room_detail_id' => $typeRoomDetail->id,
                        'type_price' => TypePriceEnum::HOUR,
                        'price' => $this->priceHourNew,
                        'late_surcharge' => $this->lateChargeHourNew,
                        'early_surcharge' => $this->earlyChargeHourNew
                    ],
                    [
                        'type_room_detail_id' => $typeRoomDetail->id,
                        'type_price' => TypePriceEnum::NIGHT,
                        'price' => $this->priceNightNew,
                        'late_surcharge' => $this->lateChargeNightNew,
                        'early_surcharge' => $this->earlyChargeNightNew
                    ],
                ];
                // dd($listPrice);
                Price::insert($listPrice);
            }
            if ($this->photos) {
                foreach ($this->photos as $photo) {
                    $logo = $photo->store('public/room/');
                    $logo = str_replace("public/room/", "", $logo);
                    Image::create([
                        'path' => $logo,
                        'object_id' => $typeRoomDetail->id,
                        'type' => TypeImgEnum::ROOM_TYPE_IMG,
                    ]);
                }
            }
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
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->dispatchBrowserEvent('show-toast', ['type' => 'error', 'message' => $e->getMessage()]);
            return;
        }
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
            if ($this->idUpdate) {
                if ($this->photoUpdate) {
                    $logo = $this->photoUpdate->store('public/room/');
                    $logo = str_replace("public/room/", "", $logo);
                    $img = Image::where('object_id', $typeRoomDetail->id,)
                        ->where('type', TypeImgEnum::ROOM_TYPE_IMG)->first();
                    if ($img)
                        $img->update([
                            'path' => $logo
                        ]);
                    else Image::create([
                        'path' => $logo,
                        'object_id' => $typeRoomDetail->id,
                        'type' => TypeImgEnum::ROOM_TYPE_IMG,
                    ]);
                }
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
            $this->listData = RoomTypeDetail::with(['Img', 'RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
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
        $dataUpdate = RoomTypeDetail::with(['Img', 'RoomCapacity', 'TypeRoom', 'Price' => function ($q) {
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
        $this->photoEdit = $dataUpdate['img'] ? $dataUpdate['img'][0]['path'] : '';
        $this->getData();
    }
}
