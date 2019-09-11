<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // Add Name table for model
    protected $table = 'cities';

    // Add primaryKey
    protected $primaryKey = 'id' ;

    //this city belongsto one country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    //this city belongsto one state
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
