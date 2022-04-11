<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MealController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('cms/parent');
});

// Route::get('/index', function () {
//     return view('cms/categories/index');
// });

Route::prefix('cms/admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('meals', MealController::class);
    Route::get('{category}/subcategories', [CategoryController::class, 'showSubCategories'])->name('category.showsubcategories');


});

// route::prefix('cms/admin')->group(function () {
//     route::view('/' , 'front.parent');
//     route::view('/index' , 'front.index');
//     route::view('/about' , 'front.about');
//     route::view('/products' , 'front.products');

//     route::view('/contact' , 'front.contact');




    
// });