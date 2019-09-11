<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    // Add Name table for model
    protected $table = 'states';

    // Add primaryKey
    protected $primaryKey = 'id' ;

    //this state own many cities
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }

    //this state belongsto one country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
