<?php
use App\Http\Controllers\CategoryController  ;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\FrontCategoryController ;
use App\Http\Controllers\Front\FrontSubCategoryController;
use App\Http\Controllers\Front\ResturantHomeController as FrontResturantHomeController ;
use App\Http\Controllers\Front\FrontMealController  ;
use App\Http\Controllers\ResturantController ;
use App\Http\Controllers\FavoriteController ;

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
        
        Route::prefix('cms/')->middleware('guest:admin,user')->group(function () {
            Route::get('{guard}/login', [AuthController::class, 'showLoginView'])->name('cms.login');
            Route::post('login', [AuthController::class, 'login']);
            Route::view('user/register',  'cms.auth.register')->name('cms.register');
            Route::post('user/register',  [UserController::class, 'store']);
            Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
            Route::post('forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
            Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordView'])->name('password.reset');
            Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
        });
        
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {

    Route::get('admins/{admin}/permissions/edit', [AdminController::class, 'editAdminPermissions'])->name('admin.edit-permissions');
    Route::put('admins/{admin}/permissions/edit', [AdminController::class, 'updateAdminPermissions']);
});
        
        
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('dashboards',  DashboardController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subCategories', SubCategoryController::class);
    Route::resource('meals', MealController::class);
    Route::resource('admins', AdminController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
    // Route::get('/showSubCategories/{category}', [CategoryController::class,'showSubCategories'])->name('subCategories.showSubCategories');

});    

Route::prefix('rest')->middleware('auth:user')->group(function () {
    Route::resource('users', UserController::class)->except([ 'index' ,'destroy' ]);
    Route::get('/favorites', [FavoriteController::class,'store'])->name('favorites.store');
    Route::get('/favorite/index', [FavoriteController::class,'index'])->name('favorites.index');
   Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout'); 

});   
Route::prefix('cms/admin')->middleware('auth:user,admin')->group(function () {
    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('password.edit');
    Route::put('update-password', [AuthController::class, 'updatePassword']);

});   

Route::prefix('rest')->group(function () {

    Route::view('/', 'front.personal-info');
    // Route::resource('uesrs', UserController::class);
    Route::resource('resturants', ResturantController::class);
    // Route::get('home',[ ResturantController::class ,'index'])->name('rest.home');
    Route::get('meals',[ MealController::class,'index'])->name('restmeals.index');
    Route::get('subcategories', [SubCategoryController::class,'index'])->name('restsubcategories.index');
    // Route::get('subcategories/{subcategory}', [FrontSubCategoryController::class,'show'])->name('subcategories.show');
    Route::get('categories',[ CategoryController::class ,'index'])->name('restcategories.index');
    // Route::get('categories/{category}',[ FrontCategoryController::class ,'show'])->name('categories.show');
    Route::resource('comments', CommentController::class);
    Route::resource('emails', ContactController::class);
    // Route::post('/email',[ ContactController::class ,'sendEmail'])->name('send.email');


    // Route::view('/index', 'front.index');
    // Route::view('/register', 'cms.auth.register')->name('rest.register');
    // Route::get('subcategories', [FrontCategoryController::class, 'show'])->name('rest.subcategories');
    // Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');


});    

