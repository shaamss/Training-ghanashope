<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount', 'user_id', 'order_id',
        'paid_on', 'payment_reference',
    ];
    // this is payment belongsto one user
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    // this is payment belongsto one order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
