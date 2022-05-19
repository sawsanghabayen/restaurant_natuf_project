<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

   
public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
    
    public function getIsFullAttribute()
    {
        if (auth('user')->check()) {
         
            return $this->where('user_id', auth('user')->id())->exists();
        }
        return false;

    }
    
}
