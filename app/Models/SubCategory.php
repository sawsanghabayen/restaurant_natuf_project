<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['*'];
    // protected $appends = ['category_name'];

    public function getCategoryNameAttribute()
    {
        return $this->category()->first()->name;
    }

    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function meals()
{
    return $this->hasMany(Meal::class, 'sub_category_id', 'id');
}
// protected $with = ['category'];




}
