<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpnet extends Model
{
    protected $guarded = ['id'];

    protected $hidden = [];


    public function histories()
    {
        return $this->hasMany(History::class, 'customer_id');
    }

    public function logbook_users()
    {
        return $this->hasMany(LogbookUser::class, 'customer_id');
    }
}
