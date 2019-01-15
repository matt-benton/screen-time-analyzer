<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Segment;
use Carbon\Carbon;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $session = Auth::user()->sessions()->where('id', $request->session)->first();

        $start = new Carbon($session->date . $request->start);
        $end = new Carbon($session->date . $request->end);

        $segment = new Segment;
        $segment->start = $start;
        $segment->end = $end;
        $segment->seat_id = $request->seat;
        $segment->monitor_id = $request->monitor;
        $segment->activity_id = $request->activity;
        $segment->eye_condition_id = $request->eye_condition;
        $segment->glasses_id = $request->glasses;
        $segment->session_id = $session->id;
        $segment->save();
        $segment->symptoms()->attach($request->symptoms);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
