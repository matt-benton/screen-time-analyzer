<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Session;
use App\Daytime;
use Carbon\Carbon;
use App\Segment;
use App\EyeCondition;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Auth::user()->sessions()->paginate(20);

        return view('sessions.sessions', ['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('sessions.create', [
            'daytimes' => $user->daytimes,
            'seats' => $user->seats,
            'monitors' => $user->monitors,
            'activities' => $user->activities,
            'glasses' => $user->glasses,
            'symptoms' => $user->symptoms,
            'eyeConditions' => EyeCondition::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start = new Carbon($request->date . ' ' . $request->start);
        $end = new Carbon($request->date . ' ' . $request->end);

        $session = new Session;
        $session->date = $request->date;
        $session->user_id = Auth::user()->id;
        $session->daytime_id = $request->daytime;
        $session->save();

        $segment = new Segment;
        $segment->start = $start;
        $segment->end = $end;
        $segment->session_id = $session->id;
        $segment->activity_id = $request->activity;
        $segment->glasses_id = $request->glasses;
        $segment->monitor_id = $request->monitor;
        $segment->eye_condition_id = $request->eye_condition;
        $segment->seat_id = $request->seat;
        $segment->save();

        $segment->symptoms()->attach($request->symptoms);

        return redirect('/sessions/' . $session->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $session = $user->sessions()->where('id', $id)->first();
        $segments = $session->segments()->with('seat', 'monitor', 'activity', 'eyeCondition', 'glasses', 'symptoms')->get();

        return view('sessions.session', [
            'session' => $session,
            'segments' => $segments,
            'seats' => $user->seats,
            'activities' => $user->activities,
            'monitors' => $user->monitors,
            'eyeConditions' => EyeCondition::all(),
            'symptoms' => $user->symptoms,
            'glasses' => $user->glasses,
        ]);
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

    public function showByDate(Request $request)
    {
        $date = new Carbon($request->date);
        $sessions = Auth::user()->sessions()->whereDate('date', $request->date)->get();

        // make calculations
        $totalScreenTime = $this->getTotalScreenTime($sessions);
        $avgSessionLength = $this->getAverageSessionLength($sessions);
        $avgSegmentLength = round($this->getTotalScreenTime($sessions) / Auth::user()->segments()->whereDate('start', $request->date)->count());

        // Calculate how much time was spent on each activity
        $activities = Auth::user()->activities;
        $activities->map(function ($activity, $key) use ($date, $totalScreenTime) {
            $activity->total = $activity->calculateTotalTimeSpentByDate($date);
            $activity->percent = ($activity->total / $totalScreenTime) * 100;
        });

        return view('sessions.show_by_date', [
            'sessions' => $sessions,
            'date' => $date,
            'totalScreenTime' => $totalScreenTime,
            'avgSessionLength' => $avgSessionLength,
            'avgSegmentLength' => $avgSegmentLength,
            'activities' => $activities,
        ]);
    }

    private function getTotalScreenTime($sessions)
    {
        $total = 0;

        foreach ($sessions as $session) {
            $total += $session->totalScreenTime();
        }

        return $total;
    }

    private function getAverageSessionLength($sessions)
    {
        $total = 0;
        $numSessions = $sessions->count();

        // add up the length of all sessions
        foreach ($sessions as $session) {
            $total += $session->length();
        }

        // divide the total by the number of sessions
        return round($total / $numSessions);
    }

    private function getAverageSegmentLength($sessions)
    {
        foreach ($sessions as $session) {
            round($session->averageSegmentLength());
        }
    }
}
