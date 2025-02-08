<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id','image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagesAttribute()
    {
        return explode(',', $this->image);
    }

    //              $product = Product::first();
   //               $images = $product->images;  Returns an array of image URLs//



    public function scopeSearch($query, $value){
        $query->where('name','like',"%{$value}%")
        ->orWhere('description','like',"%{$value}%");
    }
}