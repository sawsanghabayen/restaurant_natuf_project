<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
        //************************ADMIN PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

       

        // Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Read-Orders', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Order', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Order', 'guard_name' => 'admin']);
        
        // Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);
        
        // Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Show-Category', 'guard_name' => 'admin']);
        
        // Permission::create(['name' => 'Create-SubCategory', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-SubCategories', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-SubCategory', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-SubCategory', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Show-SubCategory', 'guard_name' => 'admin']);
       


        // Permission::create(['name' => 'Read-Contacts', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Contact', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Meal', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Meals', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Meal', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Meal', 'guard_name' => 'admin']);



      

        //************************User PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Orders', 'guard_name' => 'user']);
        Permission::create(['name' => 'Create-Orders', 'guard_name' => 'user']);

        // Permission::create(['name' => 'Read-Categories', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Read-SubCategories', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Read-Meals', 'guard_name' => 'user']);









    }



    
}
