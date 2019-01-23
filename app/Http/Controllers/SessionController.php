<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Session;
use App\Daytime;
use Carbon\Carbon;
use App\Segment;
use App\EyeCondition;
use App\Services\SessionService;
use App\Services\SegmentService;

class SessionController extends Controller
{
    protected $sessionService;
    protected $segmentService;

    public function __construct(SessionService $sessionService, SegmentService $segmentService)
    {
        $this->sessionService = $sessionService;
        $this->segmentService = $segmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sessions.sessions', ['sessions' => $this->sessionService->index()]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = $this->sessionService->create($request);
        $segment = $this->segmentService->create($request, $session->id);

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
        $totalScreenTime = $this->sessionService->getScreenTimeByDate($date);
        $avgSessionLength = $this->sessionService->getAverageSessionLength($sessions);
        $avgSegmentLength = $this->sessionService->getAverageSegmentLength($date);

        return view('sessions.show_by_date', [
            'sessions' => $sessions,
            'date' => $date,
            'totalScreenTime' => $totalScreenTime,
            'totalScreenTimeFormatted' => $this->formatIntoHoursAndMinutes($totalScreenTime),
            'avgSessionLength' => $this->formatIntoHoursAndMinutes($avgSessionLength),
            'avgSegmentLength' => $this->formatIntoHoursAndMinutes($avgSegmentLength),
            'activities' => Auth::user()->activities,
        ]);
    }

    private function formatIntoHoursAndMinutes(int $minutes)
    {
        if ($minutes < 60) {
            return $minutes . " min";
        } else {
            $hours = floor($minutes / 60) . " hr, ";
            $minutes = $minutes % 60 . " min";
            return $hours . $minutes;
        }
    }
}
