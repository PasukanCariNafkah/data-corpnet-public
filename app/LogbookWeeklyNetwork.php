<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogbookWeeklyNetwork extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];

    public function children() {
        return $this->hasMany('App\LogbookWeeklyNetwork', 'parent_id');
    }

    public function parent() {
        return $this->belongsTo('App\LogbookWeeklyNetwork', 'parent_id', 'id');


    }
    
    public function reportLogbook() {
        return $this->hasMany('App\ReportWeeklyNetwork', 'logbook_id');
    }
}
