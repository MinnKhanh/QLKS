<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = [
        'name',
        'address',
        'district',
        'city',
        'cmtnd',
        'phone',
        'email',
        'gender',
        'country',
        'birth_day',
    ];
}
