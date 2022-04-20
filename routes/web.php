<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;

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

// Route::get('/', function () {
//     return view('cms/parent');
// });

// Route::get('/index', function () {
//     return view('cms/categories/index');
// });


Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::view('/', 'cms.temp')->name('cms.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('subCategories', SubCategoryController::class);
    Route::resource('meals', MealController::class);
    Route::resource('admins', AdminController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});



Route::prefix('/rest')->group(function () {
    Route::view('/', 'front.index')->name('rest.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.user.logout');


});

Route::prefix('cms/')->middleware('guest:user')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginView'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
   
});

Route::prefix('cms/admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginView'])->name('cms.admin.login');
    Route::post('login', [AuthController::class, 'login']);


 });


