<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Jam;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jam = Jam::orderBy('id', 'desc')->get();
        return view('hrd.jam.index',compact('jam'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jam = new Jam();
        return view('hrd.jam.create',compact('jam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request['is_active'] = 1;

        Jam::create($request->all());

        return redirect()->route('hrd.jam.index')->with('success', 'Jam Masuk dan Pulang has been added');
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
        $jam = Jam::findOrFail($id);
        return view('hrd.jam.edit',compact('jam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jam $jam )
    {

        $jam->update($request->all());

        return redirect()->route('hrd.jam.index')->with('success', 'Jam Masuk dan Pulang has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
            Jam::findOrFail($id)->delete();
            return redirect()->route('hrd.jam.index')->with('success', 'Jam Masuk dan Pulang has been deleted');
    }
}
