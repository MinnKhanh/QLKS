<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'position_id',
        'account_id',
        'cmtnd',
        'phone',
        'email',
        'gender',
        'birth_day',
        'bank_number',
        'bank_name',
        'home_town',
        'description'
    ];
    public function Account()
    {
        return $this->belongsTo(Admin::class, 'account_id', 'id');
    }
}
