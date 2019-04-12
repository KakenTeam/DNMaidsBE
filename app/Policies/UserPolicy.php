<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (in_array('Admin', $user->hasPermissions())) {
            return true;
        }
    }

    public function index(User $user)
    {
        $permission = $user->hasPermissions();
        if (in_array("list_user", $permission)) {
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
        if (in_array("view_user", $permission)) {
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
        if (in_array("create_user", $permission)) {
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
        if (in_array("update_user", $permission)) {
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
        if (in_array("delete_user", $permission)) {
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
