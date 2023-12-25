<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRoom extends Model
{
    use HasFactory;
    protected $table = 'product_room';
    protected $fillable = [
        'room_id',
        'product_id',
        'quantity'
    ];
}
