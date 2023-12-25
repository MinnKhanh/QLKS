<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeService extends Model
{
    use HasFactory;
    protected $table = 'room_type_services';
    public  $timestamps = false;
    protected $fillable = [
        'room_type_id',
        'service_id',
    ];
}
