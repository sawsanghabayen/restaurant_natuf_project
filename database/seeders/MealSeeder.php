<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 9; $i++) { 
        Meal::create([
            'sub_category_id'=>1,
            'title'=>'Purger',
            'price'=>'15',
            'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            'image'=>'images/meals/1651066074_meal_image.jpg',
            

        ]);}
        for ($i=0; $i < 9; $i++) { 
            Meal::create([
                'sub_category_id'=>2,
                'title'=>'Pizza',
                'price'=>'15',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
                
    
            ]
            
        );}

        for ($i=0; $i < 9; $i++) { 
            Meal::create([
                'sub_category_id'=>3,
                'title'=>'shawermmah',
                'price'=>'20',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
                
    
            ]
            
        );}
        for ($i=0; $i < 9; $i++) { 
            Meal::create([
                'sub_category_id'=>4,
                'title'=>'Sandwich Chicken',
                'price'=>'20',
                'description'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
                'image'=>'images/meals/1651066074_meal_image.jpg',
                
    
            ]
            
        );}
    }
}
