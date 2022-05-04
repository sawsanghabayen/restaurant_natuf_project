<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 9; $i++) { 
            SubCategory::create([
                'category_id'=>1,
                'title'=>'Purger Sub',
                'image'=>'images/meals/1651066074_meal_image.jpg',

            ]);}
        for ($i=0; $i < 9; $i++) { 
            SubCategory::create([
                'category_id'=>2,
                'title'=>'Pizza Sub',
                'image'=>'images/meals/1651066074_meal_image.jpg',

            ]);}
        for ($i=0; $i < 9; $i++) { 
            SubCategory::create([
                'category_id'=>3,
                'title'=>'Sawrmmah Sub',
                'image'=>'images/meals/1651066074_meal_image.jpg',

            ]);}
        for ($i=0; $i < 9; $i++) { 
            SubCategory::create([
                'category_id'=>4,
                'title'=>'Sandwich Sub',
                'image'=>'images/meals/1651066074_meal_image.jpg',

            ]);}
    }
}
