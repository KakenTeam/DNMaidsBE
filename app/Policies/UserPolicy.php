<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enum\Permission;

class UserPolicy
{
    use HandlesAuthorization;
    /**
     * Admin can access all function
     * */
    public function before($user, $ability)
    {
        if (in_array(Permission::$ADMIN, $user->hasPermissions())) {
            return true;
        }
    }


    /**
     * Determine whether the user can view the model list.
     * */
    public function index(User $user)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$LIST_USER, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function view(User $user)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$VIEW_USER, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$CREATE_USER, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$UPDATE_USER, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$DELETE_USER, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
