<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUpstream extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];

    public function userUpstream() {
        $this->hasMany('App\LogbookUpstream', 'upstream_id');
    }

    public function reportUserUpstream()
    {
        return $this->hasMany('App\ReportWeeklyUpstream', 'upstream_id');
    }
}
