<?php

namespace App\Repositories;

use App\Segment;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SegmentRepository
{

    protected $segment;



    public function __construct(Segment $segment)
    {
        $this->segment = $segment;
    }

    public function create(Request $request, $session_id)
    {
        $start = new Carbon($request->date . ' ' . $request->start);
        $end = new Carbon($request->date . ' ' . $request->end);

        $segment = new Segment;
        $segment->start = $start;
        $segment->end = $end;
        $segment->session_id = $session_id;
        $segment->activity_id = $request->activity;
        $segment->glasses_id = $request->glasses;
        $segment->monitor_id = $request->monitor;
        $segment->eye_condition_id = $request->eye_condition;
        $segment->seat_id = $request->seat;
        $segment->save();

        $segment->symptoms()->attach($request->symptoms);
    }

    public function all()
    {
        //return Auth::user()->segments;
    }

    public function find($id)
    {
        //return Auth::user()->segments()->where('id', $id)->first();
    }

    public function update($id, array $attributes)
    {
        //return Auth::user()->segments()->where('id', $id)->first()->update($attributes);
    }

    public function delete($id)
    {
        //return Auth::user()->segments()->where('id', $id)->delete();
    }
}
