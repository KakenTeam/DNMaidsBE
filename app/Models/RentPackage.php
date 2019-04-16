<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentPackage extends Model
{

    protected $fillable = [
        'name',
        'price',
        'value',
    ];

}
