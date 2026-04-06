<?php

namespace App\Models;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sub_category_id',
        'name',
        'brand',
        'description'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // public function items()
    // {
    //     return $this->hasMany(Item::class);
    // }
}