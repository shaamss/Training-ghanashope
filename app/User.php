<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'mobile', 'email_verified', 'mobile_verified',
        'shipping_address', 'billing_address'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // this user own many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

      // this user own many payments
      public function payments()
      {
          return $this->hasMany(Payment::class);
      }

      // this user own many shipments
      public function shipments()
      {
          return $this->hasMany(Shipment::class);
      }

      //this user own One shippingAddress
      public function shippinngAddress()
      {
          return $this->hasOne(Address::class, 'shipping_address', 'id');
      }

      //this user own One billingAddress
      public function billingAdress()
      {
          return $this->hasOne(Address::class, 'billing_address', 'id');
      }

      // this user own one wislist
      public function wishlist()
      {
          return $this->hasOne(WishList::class);
      }

      //this user own many reviews

      public function reviews()
      {
          return $this->hasMany(Review::class);
      }

}
