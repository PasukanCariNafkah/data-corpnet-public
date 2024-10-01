<?php

namespace App\Http\Controllers\LogbookUpstream;

use App\UserUpstream;
use App\LogbookUpstream;
use Illuminate\Http\Request;
use App\ReportWeeklyUpstream;
use App\LogbookWeeklyUpstream;
use App\Http\Controllers\Controller;

class LogbookDailyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = LogbookUpstream::all();

        return view('logbook-upstream.logbook-daily.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = LogbookWeeklyUpstream::all();
        $userUpstream = UserUpstream::all();
        return view('logbook-upstream.logbook-daily.create', compact('category', 'userUpstream'));
    }

    public function subcat(Request $request) {
        $category_name = $request->cat_name;

        $children = LogbookWeeklyUpstream::where('nama', $category_name)->with('children')->get();

        return response()->json([
            'children' => $children
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $userUpstream = UserUpstream::where('id', $request->upstream)->first();
        $logbook_weekly = LogbookWeeklyUpstream::where('nama', $request->impact)->first();
        $report_weekly = ReportWeeklyUpstream::where('logbook_id', $logbook_weekly->id)->where('tanggal', $request->off_date)->where('upstream_id', $request->upstream)->first();
        // dd($report_weekly);
        
        if ($report_weekly == null) {
        $report = new ReportWeeklyUpstream;
        // dd("Data null");
        $report->upstream_id = $request->upstream;
        $report->logbook_id = $logbook_weekly->id;
        $report->tanggal = $request->off_date;
        $report->jumlah_komplain++;
        
        $report->save();
        } else {
            $report_weekly->jumlah_komplain++;
            $report_weekly->save();
            // dd($report_weekly);
        }
        



        $logbook = new LogbookUpstream;

        $logbook->upstream_id = $request->upstream;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->location_site = $request->location_site;
        $logbook->link = $request->link;
        $logbook->segment = $request->segment;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        $logbook->ticket = $request->ticket;
        
        $logbook->save();
        return redirect()->route('logbook-upstream-daily.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = LogbookUpstream::findOrFail($id);
        $userUpstream = UserUpstream::all();
        $category = LogbookWeeklyUpstream::where('parent_id', null)->get();

        return view('logbook-upstream.logbook-daily.edit', compact('item', 'category', 'userUpstream'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $logbookOld = LogbookWeeklyUpstream::where('nama', $request->impact_old)->first();
        $reportOld= ReportWeeklyUpstream::where('upstream_id', $request->upstream_old)->where('tanggal', $request->off_date_old)->where('logbook_id', $logbookOld->id)->first();
        $logbookNew = LogbookWeeklyUpstream::where('nama', $request->impact)->first();
        $reportNew= ReportWeeklyUpstream::where('upstream_id', $request->upstream)->where('tanggal', $request->off_date)->where('logbook_id', $logbookNew->id)->first();
        
        
        
       

        if ($reportOld->upstream_id == $request->upstream && $reportOld->tanggal == $request->off_date && $reportOld->logbook_id == $logbookNew->id ) {
            $reportOld->upstream_id = $reportOld->upstream_id;
                    $reportOld->logbook_id = $reportOld->logbook_id;
                    $reportOld->tanggal = $reportOld->tanggal;
                    $reportOld->jumlah_komplain = $reportOld->jumlah_komplain;
                    // dd($reportOld);
        } else {
            if ($reportNew == null) {
                if ($reportOld->jumlah_komplain == 1) {
                    $reportOld->delete();
                } else {
                    $reportOld->jumlah_komplain--;
                    $reportOld->save();
                }
                
                $newReport = new ReportWeeklyUpstream;
                $newReport->upstream_id = $request->upstream;
                $newReport->logbook_id = $logbookNew->id;
                $newReport->tanggal = $request->off_date;
                $newReport->jumlah_komplain++;

                $newReport->save();
            } else {
                if ($reportOld->jumlah_komplain == 1) {
                    $reportOld->delete();
                } else {
                    $reportOld->jumlah_komplain--;
                    $reportOld->save();
                }

                $reportNew->jumlah_komplain++;
                $reportNew->save();
            }
            
        }
        
        


        $logbook = LogbookUpstream::findOrFail($id);

        $logbook->upstream_id = $request->upstream;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->location_site = $request->location_site;
        $logbook->link = $request->link;
        $logbook->segment = $request->segment;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        $logbook->ticket = $request->ticket;

        $logbook->save();
        return redirect()->route('logbook-upstream-daily.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $logbook = LogbookUpstream::findOrFail($id);
        $logbookOld = LogbookWeeklyUpstream::where('nama', $logbook->impact)->first();
        $reportOld= ReportWeeklyUpstream::where('upstream_id', $logbook->upstream_id)->where('tanggal', $logbook->off_date)->where('logbook_id', $logbookOld->id)->first();
        // dd($reportOld);
        if ($reportOld->jumlah_komplain == 1) {
            $reportOld->delete();
        } else {
            $reportOld->jumlah_komplain--;
            $reportOld->save();
        }
        $logbook->delete();
        return redirect()->route('logbook-upstream-daily.index');
    }
}
