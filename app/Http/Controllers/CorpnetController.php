<?php

namespace App\Http\Controllers;

use App\Olt;
use App\Corpnet;
use App\History;
use App\LogbookWeeklyUser;
use Illuminate\Http\Request;

class CorpnetController extends Controller
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
        $items = Corpnet::orderBy('created_at', 'DESC')->get();
        
        return view('corpnet.pages.index', compact('items'));
    }

    
    public function create()
    {
        $items = Olt::all();
        return view('corpnet.pages.create', compact('items'));
    }

    public function create_to_logbook($id)
    {
        $item = Corpnet::findOrFail($id);
        $category = LogbookWeeklyUser::all();
        return view('corpnet.pages.create-to-logbook', compact('item', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'cid' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'node' => 'required',
            'tanggal_regis' => 'required',
            'olt' => 'required',
            'fsan' => 'required|min:6',
            'speed' => 'required|numeric',
            'vlan' => 'required|min:4|numeric',
            'ip' => 'required'
            
        ]);

        $data = $request->all();

        // $data['olt'] = $request->olt_name.' '.$request->olt_number;
        // dd($data);
        // $history = new History;

        // $history->fsan_lama = "Null";
        // $history->fsan_baru = $data['fsan'];
        
        Corpnet::create($data);

        // $history->save();
        

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
        $data = Corpnet::findOrFail($id);
        $histories = History::where('customer_id', $id)->get();

        // dd($data);
        

        return view('corpnet.pages.show', compact('data', 'histories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Corpnet::findOrFail($id);
        $items = Olt::all();

        return view('corpnet.pages.edit', compact('data', 'items'));
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
        $validator = $request->validate([
            'cid' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_regis' => 'required',
            'olt' => 'required',
            'node' => 'required',
            'fsan' => 'required|min:6',
            'speed' => 'required|numeric',
            'vlan' => 'required|min:4|numeric',
            'ip' => 'required'
            
        ]);


        $data = $request->all();
        $history = new History;

        // $data['olt'] = $request->olt_name.' '.$request->olt_number;
        // dd($data);

            if ($request->old_fsan != $request->fsan) {
                $history->customer_id = $id;
                $history->fsan_lama = $request->old_fsan;
                $history->fsan_baru = $request->fsan;
                $history->save();
            }
        $item = Corpnet::findOrFail($id);
        $item->update($data);
        // Corpnet::create($data);

        return redirect()->route('corpnet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Corpnet::findOrFail($id);
        // dd($data);
        $data->delete();

        return redirect()->route('corpnet.index');
    }
}
