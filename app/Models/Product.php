<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category', 'size', 'image'];


    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function setImageAttribute($value)
    {

        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        $this->attributes['image'] = json_encode(array_values($value), JSON_UNESCAPED_SLASHES);
    }


    public function getImageAttribute($value)
    {
        return json_decode($value, true);
    }




    // Casting thhe image field to a array 
    //is unnecessary because you are storing a string, not a JSON array. Remove this casting to prevent conflicts.
}
