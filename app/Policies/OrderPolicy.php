<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;
    
    public function viewAny($user)
    {
        // return $user->hasPermissionTo('Read-Orders')
        // ? $this->allow()
        // : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Order $order)
    {
      
    }
    

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // return $user->hasPermissionTo('Create-Order')
        // ? $this->allow()
        // : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Order $order)
    {
        return $admin->hasPermissionTo('Update-Order')
        ? $this->allow()
        : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Order $order)
    {
        return $admin->hasPermissionTo('Delete-Order')
        ? $this->allow()
        : $this->deny('YOU HAVE NO PERMISSION FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Order $order)
    {
        //
    }
}
