<?php

namespace Database\Seeders;

use App\Models\Resturant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResturantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resturant::create([
            'rest_name'=>'Sawsan Resturant',
            'description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. ',
            'mobile'=>'0597085978',
            'telephone'=>'2470333',
            'email'=>'saw@gmail.com',
            'image'=>'cms/dist/img/resturant',
            'address'=>'Gaza_Mashroo3BeitLahia',
      

        ]
            
        );
    }
}
