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
        'type',
        'note',
        'checkin_date',
        'checkout_date',
        'hour_in',
        'hour_out',
        'rental_time',
        'status',
        'number_of_adults',
        'number_of_children',
        'type_time',
        'price_service',
        'deposit',
        'request_special'
    ];
    protected $appends = ['total_price_service', 'is_checkout'];
    public function getIsCheckoutAttribute()
    {
        return PaymentBooking::where('booking_id', $this->id)->count() ? 1 : 0;
    }
    public function getTotalPriceServiceAttribute()
    {
        $totalPrice = array_sum(array_column(BookingService::where('booking_id', $this->id)->get()->toArray(), 'total_price'));
        return $totalPrice;
    }
    public function BookingService()
    {
        return $this->hasMany(BookingService::class, 'booking_id', 'id')->with('Service');
    }
    public function Room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    public function PayMentBooking()
    {
        return $this->hasOne(PayMentBooking::class, 'booking_id', 'id');
    }
    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
