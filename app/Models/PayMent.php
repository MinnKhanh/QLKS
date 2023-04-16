<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayMent extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'bill_id',
        'creator_id',
        'customer_id',
        'booking_id',
        'amount',
        'phone',
        'cmtnd',
        'payment_method',
        'note',
        'price',
        'satus',
        'discount',
        'late_checkin_fee',
        'early_checkIn_fee',
    ];
}
