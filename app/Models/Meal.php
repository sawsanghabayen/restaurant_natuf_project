<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function getActiveStatusAttribute()
    {
        return $this->active ? 'Active' : 'Disabled';
    }
    public function ordermeals()
    {
        return $this->hasMany(OrderMeal::class, 'meal_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderMeal::class,'meal_id','order_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, Favorite::class, 'meal_id', 'user_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'meal_id', 'id');
    }
    public function userscart()
    {
        return $this->belongsToMany(User::class, Cart::class, 'meal_id', 'user_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'meal_id', 'id');
    }

    public function getIsFavoriteAttribute()
    {
        if (auth('user')->check()) {
         
            return $this->favorites()->where('user_id', auth('user')->id())->exists();
        }
        return false;

    }

}
