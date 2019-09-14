<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactSupport extends Model
{
    protected $fillable = [
        'title', 'message', 'supporttype_id',
        'user_id', 'order_id',

    ];

    // this contactsupport own one supportType
    public function supporttype()
    {
        return $this->hasOne(SupportType::class);
    }

    // this contactsupport belongsto one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
