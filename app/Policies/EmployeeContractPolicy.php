<?php

namespace App\Policies;

use App\Enum\Permission;
use App\Models\EmployeeContract;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeContractPolicy
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
    public function index(User $user,EmployeeContract $employeeContract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$LIST_EMP_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can view the employee contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\EmployeeContract  $employeeContract
     * @return mixed
     */
    public function view(User $user, EmployeeContract $employeeContract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$VIEW_EMP_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create employee contracts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$CREATE_EMP_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the employee contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\EmployeeContract  $employeeContract
     * @return mixed
     */
    public function update(User $user, EmployeeContract $employeeContract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$UPDATE_EMP_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the employee contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\EmployeeContract  $employeeContract
     * @return mixed
     */
    public function delete(User $user, EmployeeContract $employeeContract)
    {
        $permission = $user->hasPermissions();
        if (in_array(Permission::$DELETE_EMP_CONTRACT, $permission)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the employee contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\EmployeeContract  $employeeContract
     * @return mixed
     */
    public function restore(User $user, EmployeeContract $employeeContract)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the employee contract.
     *
     * @param  \App\Models\User  $user
     * @param  \App\EmployeeContract  $employeeContract
     * @return mixed
     */
    public function forceDelete(User $user, EmployeeContract $employeeContract)
    {
        //
    }
}
