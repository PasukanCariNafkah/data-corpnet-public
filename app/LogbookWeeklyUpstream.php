<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogbookWeeklyUpstream extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany('App\LogbookWeeklyUpstream', 'parent_id');

    }

    public function parent() {
        return $this->belongsTo('App\LogbookWeeklyUpstream', 'parent_id', 'id');
    }

    public function reportLogbook() {
        return $this->hasMany('App\ReportWeeklyUpstream', 'logbook_id');
    }
}
