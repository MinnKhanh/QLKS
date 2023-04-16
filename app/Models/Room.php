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
    public function Booking()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
}
