<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'unit', 'price',
        'total'
    ];

    //this product own many images
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // this Product own many Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}