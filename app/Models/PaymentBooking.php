<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBooking extends Model
{
    use HasFactory;
    protected $table = 'payment_booking';
    protected $fillable = [
        'booking_id',
        'payment_id'
    ];
}
