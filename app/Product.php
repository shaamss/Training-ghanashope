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

    //this Product belongsto one category

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasUnit()
    {
        return $this->belongsTo(Unit::class, 'unit', 'id');
    }

}
