<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Add Name table for model
    protected $table = 'countries';

    // Add primaryKey
    protected $primaryKey = 'id' ;

    //this Country own  many cities
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    //this Country own  many states
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
