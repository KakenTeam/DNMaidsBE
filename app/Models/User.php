<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'birthday',
        'gender',
        'address',
        'phone',
    ];

    public function hasPermissions() {
        $per= [];
        foreach ($this->groups as $group) {
            foreach ($group->permissions as $permission) {
                $per[] = $permission->permission;
            }
        }
        return $per;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }
}
