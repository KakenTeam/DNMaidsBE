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
        'role',
    ];

    public function getFillable()
    {
        return $this->fillable;
    }

    public function hasPermissions()
    {
        $per = [];
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

    public function empContract()
    {
        return $this->hasOne(EmployeeContract::class, 'emp_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }

    public function customersContracts()
    {
        return $this->hasMany(Contract::class, 'customer_id', 'id');
    }

    public function helpersContracts()
    {
        return $this->hasMany(Contract::class, 'helper_id', 'id');
    }

    public function editorContracts()
    {
        return $this->hasMany(Contract::class, 'last_editor_id', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id', 'id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'helper_skill', 'helper_id', 'skill_id');
    }
}
