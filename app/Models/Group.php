<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{

    protected $fillable = [
        'group_name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'group_permission', 'group_id', 'permission_id');
    }
}
