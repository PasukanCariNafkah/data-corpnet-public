<?php

namespace App\Http\Controllers\LogbookUser;

use App\Corpnet;
use App\LogbookUser;
use App\ReportWeekly;
use App\LogbookWeeklyUser;
use Illuminate\Http\Request;
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

        // $corpnet = Corpnet::all();
        $category = LogbookWeeklyUser::all();
        $items = LogbookUser::orderBy("off_date", 'desc')->get();


    
        return view('logbook-user.logbook-daily.pages.index', compact('items', 'category'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $corpnets = Corpnet::all();
        $category = LogbookWeeklyUser::all();
        return view('logbook-user.logbook-daily.pages.create', compact('corpnets', 'category'));
    }

    public function add_logbook(Request $request)
    {
        $cid = $request->cid;

        $name_corpnet = Corpnet::where('cid', $cid)->first();
        // $name_corpnet = $data->nama;
       
        return response()->json([
            'name_corpnet' => $name_corpnet
        ]);
    }


    public function subcat(Request $request)
    {
        $category_name = $request->cat_name;

        $children = LogbookWeeklyUser::where('nama', $category_name)->with('children')->get();

       
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
    
 
    
    public function store_from_logbook(Request $request)
    {
        $corpnet = Corpnet::where('cid', $request->cid)->first();
        $logbook_weekly = LogbookWeeklyUser::where('nama', $request->impact)->first();
        $report_weekly = ReportWeekly::where('logbook_id', $logbook_weekly->id)->where('tanggal', $request->off_date)->first();
        // dd($report_weekly);
        if ($report_weekly == null) {
            
            $report = new ReportWeekly;
    
            $report->tanggal = $request->off_date;
            $report->logbook_id = $logbook_weekly->id;
            $report->jumlah_komplain++;

            $report->save();
           
        } else {

            if ($report_weekly->tanggal == $request->off_date && $report_weekly->logbook_id == $logbook_weekly->id) {
                
                $report_weekly->jumlah_komplain++;
                $report_weekly->save();
            
            } else {
                $report = new ReportWeekly;

                $report->tanggal = $request->off_date;
                $report->logbook_id = $logbook_weekly->id;
                $report->jumlah_komplain++;
    
                $report->save();
            }
           
        }

        $logbook = new LogbookUser;

        $logbook->customer_id = $corpnet->id;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->location_site = $request->location_site;
        $logbook->source_problem = $request->source_problem;
        $logbook->link = $request->link;
        $logbook->segment_isp = $request->segment_isp;
        $logbook->segment_user = $request->segment_user;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        $logbook->action = $request->action;
        $logbook->solved_by = $request->solved_by;
        $logbook->follow_up_by = $request->follow_up_by;
        $logbook->status = $request->status;


        $logbook->save();

        
        
        
        return redirect()->route('logbook-user-daily.index');
    }


    public function store_from_corpnet(Request $request, $id) {
        $logbook_weekly = LogbookWeeklyUser::where('nama', $request->impact)->first();
        $report_weekly = ReportWeekly::where('logbook_id', $logbook_weekly->id)->where('tanggal', $request->off_date)->first();
        // dd($report_weekly);
        if ($report_weekly == null) {
            
            $report = new ReportWeekly;
    
            $report->tanggal = $request->off_date;
            $report->logbook_id = $logbook_weekly->id;
            $report->jumlah_komplain++;

            $report->save();
           
        } else {

            if ($report_weekly->tanggal == $request->off_date && $report_weekly->logbook_id == $logbook_weekly->id) {
                
                $report_weekly->jumlah_komplain++;
                $report_weekly->save();
            
            } else {
                $report = new ReportWeekly;

                $report->tanggal = $request->off_date;
                $report->logbook_id = $logbook_weekly->id;
                $report->jumlah_komplain++;
    
                $report->save();
            }
           
        }

        $logbook = new LogbookUser;

        $logbook->customer_id = $id;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->location_site = $request->location_site;
        $logbook->source_problem = $request->source_problem;
        $logbook->link = $request->link;
        $logbook->segment_isp = $request->segment_isp;
        $logbook->segment_user = $request->segment_user;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        $logbook->action = $request->action;
        $logbook->solved_by = $request->solved_by;
        $logbook->follow_up_by = $request->follow_up_by;
        $logbook->status = $request->status;


        $logbook->save();

        
        
        
        return redirect()->route('corpnet.index');
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
        $item = LogbookUser::findOrFail($id);
        $category = LogbookWeeklyUser::all();
        return view('logbook-user.logbook-daily.pages.edit', compact('item', 'category'));
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

        $corpnet = Corpnet::where('cid', $request->cid)->first();
        $logbook = LogbookUser::findOrFail($id);
        $logbookWeeklyOld = LogbookWeeklyUser::where('nama', $request->impact_old)->first();
        $reportWeeklyOld = ReportWeekly::where("logbook_id", $logbookWeeklyOld->id)->Where('tanggal', $request->off_date_old)->first();
        $logbookWeelyNew = LogbookWeeklyUser::where('nama', $request->impact)->first();
            // dd($reportWeeklyOld);
            if ($reportWeeklyOld->tanggal == $request->off_date && $reportWeeklyOld->logbook_id == $logbookWeelyNew->id) {
                $reportWeeklyOld->tanggal = $reportWeeklyOld->tanggal;
                $reportWeeklyOld->logbook_id = $reportWeeklyOld->logbook_id;
                $reportWeeklyOld->jumlah_komplain = $reportWeeklyOld->jumlah_komplain;
                $reportWeeklyOld->save();
            } else if ($reportWeeklyOld->tanggal == $request->off_date && $reportWeeklyOld->logbook_id != $logbookWeelyNew->id) {
                
                $item = ReportWeekly::where('tanggal', $reportWeeklyOld->tanggal)->where('logbook_id', $logbookWeelyNew->id)->first();
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
                    
                    $report = new ReportWeekly;

                    $report->tanggal = $request->off_date;
                    $report->logbook_id = $logbookWeelyNew->id;
                    $report->jumlah_komplain++;
    
                    $report->save();
                }
                
                
                 
            } else {
                $tanggalReport = ReportWeekly::where('tanggal', $request->off_date)->where('logbook_id', $logbookWeelyNew->id)->first();
                
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
                        $report = new ReportWeekly;
        
                        $report->tanggal = $request->off_date;
                        $report->logbook_id = $logbookWeelyNew->id;
                        $report->jumlah_komplain++;
        
                        $report->save();
                    }
                    
                
           
                
               
            }
        $logbook->customer_id = $corpnet->id;
        $logbook->off_date = $request->off_date;
        $logbook->off_time = (string) $request->off_time;
        $logbook->location_site = $request->location_site;
        $logbook->source_problem = $request->source_problem;
        $logbook->link = $request->link;
        $logbook->segment_isp = $request->segment_isp;
        $logbook->segment_user = $request->segment_user;
        $logbook->on_date = $request->on_date;
        $logbook->on_time = (string) $request->on_time;
        $logbook->impact = $request->impact;
        $logbook->description = $request->description;
        $logbook->action = $request->action;
        $logbook->solved_by = $request->solved_by;
        $logbook->follow_up_by = $request->follow_up_by;
        $logbook->status = $request->status;
        $logbook->save();

        return redirect()->route('logbook-user-daily.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logbook = LogbookUser::findOrFail($id);

        $logbookWeeklyOld = LogbookWeeklyUser::where('nama', $logbook->impact)->first();
        $reportWeeklyOld = ReportWeekly::where("logbook_id", $logbookWeeklyOld->id)->where('tanggal', $logbook->off_date)->first();

        if ($reportWeeklyOld->jumlah_komplain == 1) {
            $reportWeeklyOld->delete();
        } else {
            $reportWeeklyOld->jumlah_komplain--;
            $reportWeeklyOld->save();
        }
        
        $logbook->delete();

        return redirect()->route('logbook-user-daily.index');
    }
}
