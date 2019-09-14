<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportType extends Model
{
    protected $fillable = [
        'type',
    ];

    // this supportType own many contactsupport
    public function contactsupports()
    {
        return $this->hasMany(ContactSupport::class);
    }
}
