<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomService extends Model
{
    use HasFactory;
    protected $table = 'room_services';
    protected $fillable = [
        'room_id',
        'service_id',
    ];
}
