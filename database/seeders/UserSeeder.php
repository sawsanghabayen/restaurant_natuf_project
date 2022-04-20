<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'=>'sawsan',
            'last_name'=>'ghabayen',
            'mobile'=>'0597085978',
            'email'=>'sawsan@gmail.com',
            'password'=>Hash::make(1234),
        ]
            
        );
    }
}
