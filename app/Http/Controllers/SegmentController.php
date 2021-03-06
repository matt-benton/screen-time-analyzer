<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Segment;
use Carbon\Carbon;
use App\Daytime;
use App\EyeCondition;
use App\Services\SegmentService;

class SegmentController extends Controller
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

        $start = new Carbon($session->date->toDateString() . ' ' . $request->start);
        $end = new Carbon($session->date->toDateString() . ' ' . $request->end);

        $segment = new Segment;
        $segment->start = $start;
        $segment->end = $end;
        $segment->seat_id = $request->seat;
        $segment->activity_id = $request->activity;
        $segment->eye_condition_id = $request->eye_condition;
        $segment->glasses_id = $request->glasses;
        $segment->session_id = $session->id;
        $segment->save();
        $segment->symptoms()->attach($request->symptoms);
        $segment->monitors()->attach($request->monitors);

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
        $user = Auth::user();
        $segment = Auth::user()->segments()->where('segments.id', $id)->first();

        return view('segments.segment', [
            'segment' => $segment,
            'daytimes' => Daytime::all(),
            'seats' => $user->seats,
            'monitors' => $user->monitors,
            'activities' => $user->activities,
            'glasses' => $user->glasses,
            'symptoms' => $user->symptoms,
            'eyeConditions' => EyeCondition::all(),
        ]);
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
        $segment = Auth::user()->segments()->where('segments.id', $id)->first();

        $start = new Carbon($request->start_date . ' ' . $request->start_time);
        $end = new Carbon($request->end_date . ' ' . $request->end_time);

        $segment->start = $start;
        $segment->end = $end;
        $segment->seat_id = $request->seat;
        $segment->monitors()->sync($request->monitors); 
        $segment->activity_id = $request->activity;
        $segment->eye_condition_id = $request->eye_condition;
        $segment->glasses_id = $request->glasses;
        $segment->save();
        $segment->symptoms()->sync($request->symptoms);

        return redirect('/sessions/' . $segment->session->id);
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
