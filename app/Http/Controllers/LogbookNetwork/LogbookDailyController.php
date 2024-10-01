<?php

namespace App\Http\Controllers\LogbookNetwork;

use App\LogbookNetwork;
use App\ReportWeeklyNetwork;
use Illuminate\Http\Request;
use App\LogbookWeeklyNetwork;
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
        $items = LogbookNetwork::all();
        return view('logbook-network.logbook-daily.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = LogbookWeeklyNetwork::all();
        return view('logbook-network.logbook-daily.create', compact('category'));
    }


    public function subcat(Request $request) {
        $category_name = $request->cat_name;

        $children = LogbookWeeklyNetwork::where('nama', $category_name)->with('children')->get();

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
        $logbook = new LogbookNetwork;

        $logbook->area = $request->area;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->sites = $request->sites;
        $logbook->segment = $request->segment;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        
        $logbook->save();
    

        $logbook_weekly = LogbookWeeklyNetwork::where('nama', $request->impact)->first();
        $report_weekly = ReportWeeklyNetwork::where('logbook_id', $logbook_weekly->id)->where('tanggal', $request->off_date)->first();
        if ($report_weekly == null) {
            
            $report = new ReportWeeklyNetwork;
    
            $report->tanggal = $request->off_date;
            $report->logbook_id = $logbook_weekly->id;
            $report->jumlah_komplain++;

            $report->save();
           
        } else {

            if ($report_weekly->tanggal == $request->off_date && $report_weekly->logbook_id == $logbook_weekly->id) {
                $item = ReportWeeklyNetwork::where('logbook_id', $logbook_weekly->id)->first();
                $item->jumlah_komplain++;
                $item->save();
            
            } else {
                $report = new ReportWeeklyNetwork;

                $report->tanggal = $request->off_date;
                $report->logbook_id = $logbook_weekly->id;
                $report->jumlah_komplain++;
    
                $report->save();
            }
           
        }


        return redirect()->route('logbook-network-daily.index');
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
        $item = LogbookNetwork::findOrFail($id);
        $category = LogbookWeeklyNetwork::where('parent_id', null)->get();

        return view('logbook-network.logbook-daily.edit', compact('item', 'category'));
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
        $logbook = LogbookNetwork::findOrFail($id);
        $logbookWeeklyOld = LogbookWeeklyNetwork::where('nama', $request->impact_old)->first();
        // dd($request->off_date_old);
        $reportWeeklyOld = ReportWeeklyNetwork::where("logbook_id", $logbookWeeklyOld->id)->where('tanggal', $request->off_date_old)->first();
        $logbookWeelyNew = LogbookWeeklyNetwork::where('nama', $request->impact)->first();
            // dd($reportWeeklyOld);
            if ($reportWeeklyOld->tanggal == $request->off_date && $reportWeeklyOld->logbook_id == $logbookWeelyNew->id) {
                $reportWeeklyOld->tanggal = $reportWeeklyOld->tanggal;
                $reportWeeklyOld->logbook_id = $reportWeeklyOld->logbook_id;
                $reportWeeklyOld->jumlah_komplain = $reportWeeklyOld->jumlah_komplain;
                $reportWeeklyOld->save();
            } else if ($reportWeeklyOld->tanggal == $request->off_date && $reportWeeklyOld->logbook_id != $logbookWeelyNew->id) {
                
                $item = ReportWeeklyNetwork::where('tanggal', $reportWeeklyOld->tanggal)->where('logbook_id', $logbookWeelyNew->id)->first();
                // dd("error");

                if ($item !=null) {
                    if ($reportWeeklyOld->jumlah_komplain == 1) {
                        $reportWeeklyOld->delete();
                        // dd($reportWeeklyOld);
                    } else {
                        $reportWeeklyOld->jumlah_komplain--;
                        $reportWeeklyOld->save();
                    }
                   

                    $item->jumlah_komplain++;
                    $item->save();
                    
                } else {
                    if ($reportWeeklyOld->jumlah_komplain == 1) {
                        // dd($reportWeeklyOld);
                        $reportWeeklyOld->delete();
                    } else {
                        $reportWeeklyOld->jumlah_komplain--;
                        $reportWeeklyOld->save();
                    }       
                    
                    $report = new ReportWeeklyNetwork;

                    $report->tanggal = $request->off_date;
                    $report->logbook_id = $logbookWeelyNew->id;
                    $report->jumlah_komplain++;
    
                    $report->save();
                }
                
                
                 
            } else {
                $tanggalReport = ReportWeeklyNetwork::where('tanggal', $request->off_date)->where('logbook_id', $logbookWeelyNew->id)->first();
                
                    if ($tanggalReport != null) {
                        // dd($tanggalReport);
                        if ($reportWeeklyOld->jumlah_komplain == 1) {
                            // dd($reportWeeklyOld);
                            $reportWeeklyOld->delete();
                        } else {
                            $reportWeeklyOld->jumlah_komplain--;
                            $reportWeeklyOld->save();
                        }
                        $tanggalReport->jumlah_komplain++;
                        $tanggalReport->save();
                    } else {
                        // dd("error null");
                        if ($reportWeeklyOld->jumlah_komplain == 1) {
                            // dd($reportWeeklyOld);
                            $reportWeeklyOld->delete();
                        } else {
                            $reportWeeklyOld->jumlah_komplain--;
                            $reportWeeklyOld->save();
                        }  
                        $report = new ReportWeeklyNetwork;
        
                        $report->tanggal = $request->off_date;
                        $report->logbook_id = $logbookWeelyNew->id;
                        $report->jumlah_komplain++;
        
                        $report->save();
                    }
                    
                
           
                
               
            }
            
        $logbook->area = $request->area;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->sites = $request->sites;
        $logbook->segment = $request->segment;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        $logbook->save();

        return redirect()->route('logbook-network-daily.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logbook = LogbookNetwork::findOrFail($id);
        
        $logbookWeeklyOld = LogbookWeeklyNetwork::where('nama', $logbook->impact)->first();
        // dd($logbookWeeklyOld);
        $reportWeeklyOld = ReportWeeklyNetwork::where("logbook_id", $logbookWeeklyOld->id)->where('tanggal', $logbook->off_date)->first();

        // dd($reportWeeklyOld);
        if ($reportWeeklyOld->jumlah_komplain == 1) {
            $reportWeeklyOld->delete();
        } else {
            $reportWeeklyOld->jumlah_komplain--;
            $reportWeeklyOld->save();
        }
        
        $logbook->delete();

        return redirect()->route('logbook-network-daily.index');
    }
}
