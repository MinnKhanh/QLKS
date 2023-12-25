<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenient extends Model
{
    use HasFactory;
    protected $table = 'convenients';
    protected $fillable = [
        'name',
        'description',
    ];
}
