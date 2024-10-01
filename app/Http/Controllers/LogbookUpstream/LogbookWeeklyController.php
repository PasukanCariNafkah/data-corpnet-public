<?php

namespace App\Http\Controllers\LogbookUpstream;

use Illuminate\Http\Request;
use App\LogbookWeeklyUpstream;
use App\Http\Controllers\Controller;

class LogbookWeeklyController extends Controller
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
        $categories = LogbookWeeklyUpstream::where('parent_id', null)->get();

        return view('logbook-upstream.logbook-weekly.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        LogbookWeeklyUpstream::create($data);

        return redirect()->route('logbook-upstream-weekly.index');
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
        $category = LogbookWeeklyUpstream::findOrFail($id);
        $categories = LogbookWeeklyUpstream::where('parent_id', null)->get();

        return view('logbook-upstream.logbook-weekly.edit', compact('category', 'categories'));
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
        $data = $request->all();

        $item = LogbookWeeklyUpstream::findOrFail($id);
        $item->update($data);

        return redirect()->route('logbook-upstream-weekly.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LogbookWeeklyUpstream::findOrFail($id);

        $data->delete();

        return redirect()->route('logbook-upstream-weekly.index');
    }
}
