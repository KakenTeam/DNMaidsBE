<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'permission',
    ];

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_permission', 'user_id', 'group_id');
    }
}
