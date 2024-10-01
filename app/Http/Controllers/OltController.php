<?php

namespace App\Http\Controllers;

use App\Olt;
use Illuminate\Http\Request;

class OltController extends Controller
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
        $items = Olt::orderBy('created_at', 'DESC')->get();
        return view('olt.pages.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('olt.pages.create');
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
            'name_olt' => 'required'
        ]);

        $data = $request->all();

        Olt::create($data);

        return redirect()->route('olt.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Olt  $olt
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Olt  $olt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Olt::findOrFail($id);
        return view('olt.pages.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Olt  $olt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name_olt' => 'required'
        ]);

        $data = $request->all();

        $item = Olt::findOrFail($id);

        $item->update($data);

        return redirect()->route('olt.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Olt  $olt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Olt::findOFail($id);

        $data->delete();

        return redirect()->route('olt.index');    
    }
}
