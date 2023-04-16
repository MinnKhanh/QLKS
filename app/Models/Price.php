<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table = 'prices';
    protected $fillable = [
        'type_room_detail_id',
        'type_price',
        'price',
        'late_surcharge',
        'early_surcharge'
    ];
}
