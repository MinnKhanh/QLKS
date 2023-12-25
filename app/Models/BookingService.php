<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;
    protected $table = 'booking_service';
    public $incrementing = false;
    protected $fillable = [
        'booking_id',
        'service_id',
        'quantity',
    ];
    public function Service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id')->with('Type');
    }
    protected $appends = ['total_price'];
    public function getTotalPriceAttribute()
    {
        $totalPrice = Service::where('id',$this->service_id)->first()->price*$this->quantity;
        return $totalPrice;
    }

}
