<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $fillable = [
        'user_id    ',
        'group_id',
    ];

    protected function user(){
        $this->belongsTo(User::class,'user_id');
    }

}
