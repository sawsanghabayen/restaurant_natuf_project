<?php
use App\Http\Controllers\CategoryController  ;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\FrontCategoryController ;
use App\Http\Controllers\Front\FrontSubCategoryController;
use App\Http\Controllers\Front\ResturantHomeController as FrontResturantHomeController ;
use App\Http\Controllers\Front\FrontMealController  ;
use App\Http\Controllers\ResturantController ;
use App\Http\Controllers\FavoriteController ;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderMealController;
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
        
Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {

    Route::get('admins/{admin}/permissions/edit', [AdminController::class, 'editAdminPermissions'])->name('admin.edit-permissions');
    Route::put('admins/{admin}/permissions/edit', [AdminController::class, 'updateAdminPermissions']);
});

        
Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('dashboards',  DashboardController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subCategories', SubCategoryController::class);
    Route::resource('meals', MealController::class);
    Route::resource('admins', AdminController::class);
    // Route::resource('contacts', ContactController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('ordermeals', [OrderMealController::class,'index'])->name('admin.ordermeals');
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy']);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});    

Route::prefix('rest')->middleware(['auth:user', 'verified'])->group(function () {
    Route::resource('favorites', FavoriteController::class);
    Route::resource('users', UserController::class)->except([ 'index' ,'destroy' ]);
    Route::resource('carts', CartController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('user.orders');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('ordermeals', [OrderMealController::class,'index'])->name('user.ordermeals');
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logoutuser'); 

});   

Route::prefix('rest')->group(function () {
    
    // Route::view('/', 'front.personal-info');
    Route::get('index', [ResturantController::class ,'index'])->name('resturants.index');
    Route::get('meals',[ MealController::class,'index'])->name('restmeals.index');
    Route::get('subcategories', [SubCategoryController::class,'index'])->name('restsubcategories.index');
    Route::get('categories',[ CategoryController::class ,'index'])->name('restcategories.index');
    Route::resource('comments', CommentController::class);
    Route::resource('contacts', ContactController::class)->except([ 'index' ,'destroy','show' ]);
    // Route::post('/email',[ ContactController::class ,'sendEmail'])->name('send.email');
});    
    
Route::prefix('cms/admin')->middleware(['auth:admin,user', 'verified'])->group(function () {
    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('password.edit');
    Route::put('update-password', [AuthController::class, 'updatePassword']);
    
});   

Route::prefix('cms/admin')->middleware('auth:admin,user')->group(function () {

    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('send-verification', [EmailVerificationController::class, 'send'])->middleware('throttle:1,1')->name('verification.send');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
});
        


 

