<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Resturant;
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
        return $user->hasPermissionTo('Read-Meals')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Meal $meal)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Resturant $resturant)
    {
        return $resturant->hasPermissionTo('Create-Meal')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Resturant $resturant , Meal $meal)
    {
        return auth('resturant')->check()  && $resturant->hasPermissionTo('Update-Meal') && $resturant->id == $meal->resturant_id
         ? $this->allow()
         : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user , Meal $meal)
    {
        return  ($user->hasPermissionTo('Delete-Meal')) && (auth('admin')->check() || $user->id == $meal->resturant_id ) 
        
      
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Meal $meal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Meal $meal)
    {
        //
    }
}
