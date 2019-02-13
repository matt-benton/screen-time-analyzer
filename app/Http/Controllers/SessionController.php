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
use App\Services\FormatTimes;

class SessionController extends Controller
{
    protected $sessionService;
    protected $segmentService;
    protected $formatTimes;

    public function __construct(SessionService $sessionService, SegmentService $segmentService, FormatTimes $formatTimes)
    {
        $this->sessionService = $sessionService;
        $this->segmentService = $segmentService;
        $this->formatTimes = $formatTimes;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sessions.sessions');
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

        // Get most recent segment for this session
        $mostRecentSegment = $segments->sortBy('end')->pop();

        return view('sessions.session', [
            'session' => $session,
            'segments' => $segments,
            'seats' => $user->seats,
            'activities' => $user->activities,
            'monitors' => $user->monitors,
            'eyeConditions' => EyeCondition::all(),
            'symptoms' => $user->symptoms,
            'glasses' => $user->glasses,
            'mostRecentSegment' => $mostRecentSegment,
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

    public function showByDate($date)
    {
        $date = new Carbon($date);
        $sessions = Auth::user()->sessions()->whereDate('date', $date)->get();

        // make calculations
        $totalScreenTime = $this->sessionService->getScreenTimeByDate($date);
        $avgSessionLength = $this->sessionService->getAverageSessionLength($sessions);
        $avgSegmentLength = $this->sessionService->getAverageSegmentLength($date);

        return view('sessions.show_by_date', [
            'sessions' => $sessions,
            'date' => $date,
            'totalScreenTime' => $totalScreenTime,
            'totalScreenTimeFormatted' => $this->formatTimes->hoursAndMinutes($totalScreenTime),
            'avgSessionLength' => $this->formatTimes->hoursAndMinutes($avgSessionLength),
            'avgSegmentLength' => $this->formatTimes->hoursAndMinutes($avgSegmentLength),
            'activities' => Auth::user()->activities,
        ]);
    }
}
