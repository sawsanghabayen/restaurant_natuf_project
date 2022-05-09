<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Meal;
use Illuminate\Auth\Access\HandlesAuthorization;

class MealPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        // return $user->hasPermissionTo('Read-Categories')
        //     ? $this->allow()
        //     : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $Meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Meal $Meal)
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
        return $admin->hasPermissionTo('Create-Meal')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $Meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Meal $Meal)
    {
        return $admin->hasPermissionTo('Update-Meal')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $Meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Meal $Meal)
    {
        return $admin->hasPermissionTo('Delete-Meal')
            ? $this->allow()
            : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $Meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Meal $Meal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $Meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Meal $Meal)
    {
        //
    }
}
