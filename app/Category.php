<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    // this category own many product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
