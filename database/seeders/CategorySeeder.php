<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
            Category::create([
                'name'=>'Purgers Category',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
            ]);
            Category::create([
                'name'=>'Pizza Category',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
            ]);
            Category::create([
                'name'=>'Shawermmah Category',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
            ]);
            Category::create([
                'name'=>'Sandwiches Category',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
            ]);
    }
}
