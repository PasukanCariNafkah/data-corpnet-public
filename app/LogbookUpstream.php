<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogbookUpstream extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];

    public function upstream() {
        return $this->belongsTo('App\UserUpstream', 'upstream_id', 'id');

    }

    public function reportUserUpstream() {
        return $this->hasMany('App\ReportWeeklyUptream', 'upstream_id');
    }
}
