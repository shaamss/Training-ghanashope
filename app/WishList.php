<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable =[
        'user_id', 'wish_list',
    ];

    // this wishlist belongsto one user
    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
