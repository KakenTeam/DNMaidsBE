<?php

namespace App\Policies;

use App\Enum\Permission;
use App\Models\User;
use App\Models\Contract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
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
    public function index(User $user, Contract $contract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$LIST_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }


    /**
     * Determine whether the user can view the contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Contract  $contract
     * @return mixed
     */
    public function view(User $user, Contract $contract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$VIEW_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create contracts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Contract  $contract
     * @return mixed
     */
    public function update(User $user, Contract $contract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$UPDATE_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Contract  $contract
     * @return mixed
     */
    public function delete(User $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can restore the contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Contract  $contract
     * @return mixed
     */
    public function restore(User $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Contract  $contract
     * @return mixed
     */
    public function forceDelete(User $user, Contract $contract)
    {
        //
    }
}
