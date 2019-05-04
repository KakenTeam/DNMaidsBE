<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelperSkill extends Model
{
    protected $table = 'helper_skill';

    protected $fillable = [
        'helper_id',
        'skill_id',
        'status',
    ];
}
