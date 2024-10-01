<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogbookWeeklyUser extends Model
{
    protected $guarded= ['id'];

    public function children() {
        return $this->hasMany('App\LogbookWeeklyUser', 'parent_id');
    }

    public function parent() {
        return $this->belongsTo('App\LogbookWeeklyUser', 'parent_id', 'id');
    }

    public function logbookReport() {
        return $this->hasMany(ReportWeekly::class, 'logbook_id');
    }
}
