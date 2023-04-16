<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'customer_id',
        'room_id',
        'note',
        'checkin_date',
        'checkout_date',
        'rental_time',
        'status',
        'number_of_guests',
        'type_time',
        'booking_date'
    ];
}
