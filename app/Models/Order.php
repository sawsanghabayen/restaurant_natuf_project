<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

public function ordermeals()
{
    return $this->hasMany(OrderMeal::class, 'order_id', 'id');
}
public function meals()
{
    return $this->belongsToMany(Meal::class, OrderMeal::class, 'order_id','meal_id');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
}