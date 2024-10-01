<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogbookUser extends Model
{
    protected $guarded = ['id'];
    protected $hidden = [];

    public function corpnet()
    {
        return $this->belongsTo(Corpnet::class, 'customer_id', 'id');
    }
}
