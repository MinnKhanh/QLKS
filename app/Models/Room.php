<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'floor_id',
        'type_room',
        'description',
        'status'
    ];
    public function Floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id', 'id');
    }
    public function Type()
    {
        return $this->belongsTo(RoomTypeDetail::class, 'type_room', 'id')->with('TypeRoom', 'RoomCapacity', 'Price');
    }
    public function Capacity()
    {
        return $this->hasOneThrough(RoomCapacity::class, RoomTypeDetail::class, 'id', 'id', 'type_room', 'room_capacity_id');
    }
    public function Booking()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
    public function priceOfRoom($type)
    {
        return Price::where('type_room_detail_id', $this->type_room)->where('type_price', $type)->first()->price;
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
    public function Service()
    {
        return $this->belongsToMany(Service::class, RoomService::class, 'room_id', 'service_id');
    }
    public function Convenient()
    {
        return $this->belongsToMany(Convenient::class, ConvenientRoom::class, 'room_id', 'conventient_id');
    }
}
