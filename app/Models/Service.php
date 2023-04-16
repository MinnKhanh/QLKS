<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'name',
        'type_service',
        'description',
        'price',
    ];
    public function Type()
    {
        return $this->belongsTo(TypeService::class, 'type_service', 'id');
    }
}
