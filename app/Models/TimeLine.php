<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLine extends Model
{
    use HasFactory;
    protected $table = 'time_line';
    protected $fillable = [
        'type_time',
        'start_hour',
        'end_hour',
    ];
}
