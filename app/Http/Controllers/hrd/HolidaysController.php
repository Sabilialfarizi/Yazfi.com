<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Holidays;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Holidays = Holidays::orderBy('id', 'desc')->get();
        return view('hrd.holidays.index',compact('Holidays'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Holidays = new Holidays();
        return view('hrd.holidays.create',compact('Holidays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Holidays::create($request->all());

        return redirect()->route('hrd.holidays.index')->with('success', 'Holidays has been added');
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
        $Holidays = Holidays::findOrFail($id);
        return view('hrd.holidays.edit',compact('Holidays'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        

        Holidays::find($id)->update($request->all());

        return redirect()->route('hrd.holidays.index')->with('success', 'Holiday Date has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Holidays::findOrFail($id)->delete();
            return redirect()->route('hrd.holidays.index')->with('success', 'Holiday Date has been deleted');
    }
}
