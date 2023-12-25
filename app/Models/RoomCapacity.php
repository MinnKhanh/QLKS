<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCapacity extends Model
{
    use HasFactory;
    protected $table = 'room_capacity';
    protected $fillable = [
        'name',
        'number_of_bed',
        'max_capacity',
    ];
    public function RoomTypeDetail()
    {
        return $this->hasMany(RoomTypeDetail::class, 'room_capacity_id', 'id');
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
}
