<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionTime extends Model
{
    use HasFactory;
    protected $table = 'conversion_time';
    public $incrementing = false;
    protected $fillable = [
        'type_time',
        'time',
    ];
}
