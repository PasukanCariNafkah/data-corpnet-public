<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportWeeklyNetwork extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];


    public function reportWeek() {
        return $this->belongsTo('App\LogbookWeeklyNetwork', 'logbook_id', 'id');
    }
}
