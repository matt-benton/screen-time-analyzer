<?php

namespace App\Services;

use App\Session;
use App\Repositories\SessionRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class SessionService
{
    public function __construct(SessionRepository $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        return $this->session->all();
    }

    public function create(Request $request)
    {
        return $this->session->create($request);
    }

    public function getScreenTimeByDate(Carbon $date)
    {
        $sessions = Auth::user()->sessions()->whereDate('date', $date)->get();

        $total = 0;

        foreach ($sessions as $session) {
            $total += $session->totalScreenTime();
        }

        return $total;
    }

    public function getAverageSessionLength($sessions)
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

    public function getAverageSegmentLength(Carbon $date)
    {
        return round($this->getScreenTimeByDate($date) / Auth::user()->segments()->whereDate('start', $date)->count());
    }
}
