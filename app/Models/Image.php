<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'object_id',
        'path',
        'type',
    ];
    public function ImgProduct()
    {
        return $this->morphTo();
    }
}
