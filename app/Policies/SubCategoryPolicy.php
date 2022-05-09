<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\SubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
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
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, SubCategory $SubCategory)
    {
        return $admin->hasPermissionTo('Show-SubCategory')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('Create-SubCategory')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, SubCategory $SubCategory)
    {
        return $admin->hasPermissionTo('Update-SubCategory')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, SubCategory $SubCategory)
    {
        return $admin->hasPermissionTo('Delete-SubCategory')
            ? $this->allow()
            : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, SubCategory $SubCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, SubCategory $SubCategory)
    {
        //
    }
}
