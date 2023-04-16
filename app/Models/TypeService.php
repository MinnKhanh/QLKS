<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    use HasFactory;
    protected $table = 'type_service';
    protected $fillable = [
        'name',
    ];
}
