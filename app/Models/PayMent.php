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
        'amount',
        'phone',
        'cmtnd',
        'payment_method',
        'note',
        'satus',
        'discount',
    ];
    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
