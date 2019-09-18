<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'payment_id', 'cart_id',
        'order_date',
    ];

    // this is order belongsto users
    public function customers()
    {
        return $this->belongsTo(User::class);
    }

    // this is order own one cart
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // this is order own one payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function ticekets()
    {
        return $this->hasMany(Ticket::class);
    }
}
