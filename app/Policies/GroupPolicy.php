<?php

namespace App\Policies;

use App\Enum\Permission;
use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Admin can access all function
     *
     */

    public function before(User $user, $ability)
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
        if (in_array(Permission::$LIST_GROUP, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the group.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function view(User $user, Group $group)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$VIEW_GROUP, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create groups.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$CREATE_GROUP, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the group.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$UPDATE_GROUP, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function delete(User $user, Group $group)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$DELETE_GROUP, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the group.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function restore(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the group.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function forceDelete(User $user, Group $group)
    {
        //
    }
}
