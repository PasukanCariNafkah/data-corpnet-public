<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportWeekly extends Model
{
    protected $hidden = [];
    protected $guarded = ['id'];

    public function reportWeek()
    {
        return $this->belongsTo(LogbookWeeklyUser::class, 'logbook_id', 'id');
    }
}
