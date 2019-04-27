<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeContract extends Model
{
    protected $fillable = [
        'emp_id',
        'duration',
        'valid_date',
        'expired_date',
        'salary',
        'image',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'emp_id', 'id');
    }

}
