<?php

namespace App\Http\Controllers;

use App\Corpnet;
use App\LogbookUser;
use App\ReportWeekly;
use App\UserUpstream;
use App\LogbookNetwork;
use App\LogbookUpstream;
use App\LogbookWeeklyUser;
use App\ReportWeeklyNetwork;
use Illuminate\Http\Request;
use App\LogbookWeeklyNetwork;
use App\ReportWeeklyUpstream;
use App\LogbookWeeklyUpstream;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function report_logbook_user_daily() {
        $logbook = LogbookUser::all();
        $corpnet = Corpnet::all();
        // $logbook = LogbookUser::all();
        $items = LogbookUser::orderBy("off_date", 'desc')->get();

        return view('report.pages.reportLogbookUser', compact('corpnet', 'items'));
    }

    public function report_logbook_user_weekly() {
        $logbookWeekly = LogbookWeeklyUser::all();
        $items = ReportWeekly::all();

        return view('report.pages.reportLogbookUserWeekly', compact('logbookWeekly', 'items'));
    }
    public function report_logbook_network_daily() {
     
        $items = LogbookNetwork::orderBy("off_date", 'desc')->get();

        return view('report.pages.reportLogbookNetwork', compact( 'items'));
    }

    public function report_logbook_network_weekly() {
        $logbookWeekly = LogbookWeeklyNetwork::all();
        $items = ReportWeeklyNetwork::all();

        return view('report.pages.reportLogbookNetworkWeekly', compact('logbookWeekly', 'items'));
    }

    public function report_logbook_upstream_daily() {
        
        $items = LogbookUpstream::orderBy("off_date", 'desc')->get();

        return view('report.pages.reportLogbookUpstream', compact( 'items'));
    }

    public function report_logbook_upstream_weekly() {
        $userUpstream = UserUpstream::all();
        $logbookWeekly = LogbookWeeklyNetwork::all();
        $report = ReportWeeklyUpstream::all();

        // dd($items);

        return view('report.pages.reportLogbookUpstreamWeekly', compact('report', 'userUpstream', 'logbookWeekly'));
    }
}
