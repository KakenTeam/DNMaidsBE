<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    protected $table = 'group_permission';

    protected $fillable = [
        'permission_id',
        'group_id',
        'is_allowed',
    ];
}
