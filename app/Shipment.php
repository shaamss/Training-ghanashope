<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'user_id', 'payment_id', 'order_id',
        'status', 'shipment_date',
    ];

    // this is shipment belongsto one user
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    // this is shipment belongsto one order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // this is shipment own one Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
