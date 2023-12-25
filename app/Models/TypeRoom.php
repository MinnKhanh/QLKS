<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    use HasFactory;
    protected $table = 'type_room';
    protected $fillable = [
        'name',
    ];
    public function RoomCapacity()
    {
        return $this->hasManyThrough(RoomCapacity::class, RoomTypeDetail::class, 'type_room_id', 'id', 'id', 'room_capacity_id');
    }
    public function RoomTypeDetail()
    {
        return $this->hasMany(RoomTypeDetail::class, 'type_room_id', 'id');
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
}
