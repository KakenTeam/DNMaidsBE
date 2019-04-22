<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeIndex extends Model
{
    protected $table = 'fee_index';
    protected $fillable =
        [
            'name',
            'code',
            'value',
        ];
}
