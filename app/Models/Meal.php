<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meal extends Model
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


}
