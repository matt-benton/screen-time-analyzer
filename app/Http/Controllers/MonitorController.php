<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Monitor;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('monitors.monitors', ['monitors' => Auth::user()->monitors]);
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
        $monitor = new Monitor;
        $monitor->name = $request->name;
        $monitor->description = $request->description;
        $monitor->resolution = $request->resolution;
        $monitor->refresh_rate = $request->refresh_rate;
        $monitor->screen_size = $request->screen_size;
        Auth::user()->monitors()->save($monitor);

        return back();
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
        return view('monitors.monitor', ['monitor' => Auth::user()->monitors()->where('id', $id)->first()]);
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
        $monitor = Auth::user()->monitors()->where('id', $id)->first();
        $monitor->name = $request->name;
        $monitor->description = $request->description;
        $monitor->refresh_rate = $request->refresh_rate;
        $monitor->screen_size = $request->screen_size;
        $monitor->resolution = $request->resolution;
        $monitor->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monitor = Auth::user()->monitors()->where('id', $id)->first();
        $monitor->delete();

        return redirect('/monitors');
    }
}
