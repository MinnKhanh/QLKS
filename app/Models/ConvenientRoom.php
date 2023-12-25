<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvenientRoom extends Model
{
    use HasFactory;
    protected $table = 'convenient_room';
    protected $fillable = [
        'room_id',
        'conventient_id',
        'quantity',
    ];
}
