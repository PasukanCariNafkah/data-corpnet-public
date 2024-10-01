<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportWeeklyUpstream extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];

    public function reportWeek() {
        return $this->belongsTo('App\LogbookWeeklyUpstream', 'logbook_id', 'id');
    }

    public function reportWeekUpstream() {
        return $this->belongsTo('App\UserUpstream', 'upstream_id', 'id');
    }
}
