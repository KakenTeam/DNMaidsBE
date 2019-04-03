<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'group_name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }
}
