<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-Users')
            ? $this->allow()
            : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        // return $admin->hasPermissionTo('Create-User')
        // ? $this->allow()
        // : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }
    

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, User $model)
    {
        // return $admin->hasPermissionTo('Update-User')
        // ? $this->allow()
        // : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, User $model)
    {
        
        return $admin->hasPermissionTo('Delete-User')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, User $model)
    {
        //
    }
}
