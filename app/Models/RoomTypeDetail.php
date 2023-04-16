<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeDetail extends Model
{
    use HasFactory;
    protected $table = 'room_type_detail';
    protected $fillable = [
        'type_room_id',
        'room_capacity_id',
    ];
    public function RoomCapacity()
    {
        return $this->belongsTo(RoomCapacity::class, 'room_capacity_id', 'id');
    }
    public function TypeRoom()
    {
        return $this->belongsTo(TypeRoom::class, 'type_room_id', 'id');
    }
    public function Price()
    {
        return $this->hasMany(Price::class, 'type_room_detail_id', 'id');
    }
}
