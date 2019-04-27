<?php

namespace App\Services;

use App\Session;
use App\Repositories\SessionRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\FormatTimes;
use App\User;

use Auth;

class SessionService
{
    public function __construct(SessionRepository $session, FormatTimes $formatTimes)
    {
        $this->session = $session;
        $this->formatTimes = $formatTimes;
    }

    public function index()
    {
        $sessions = $this->session->all();

        $sessions->map(function ($session) {
            $session->lengthFormatted = $session->lengthFormatted();
            $session->length = $session->length();
            $session->start = $session->start()->toDateTimeString();
            $session->end = $session->end()->toDateTimeString();
            $session->screen_time = $this->formatTimes->hoursAndMinutes($session->totalScreenTime());
        });

        return $sessions;
    }

    public function create(Request $request)
    {
        return $this->session->create($request);
    }

    public function getScreenTimeByDate(Carbon $date)
    {
        $sessions = Auth::user()->sessions()->whereDate('date', $date)->get();

        return $this->totalScreenTime($sessions);
    }

    public function getScreenTimeByDateRange(User $user, Carbon $start, Carbon $end)
    {
        $sessions = $user->sessions()->whereBetween('date', [$start, $end])->get();

        return $this->totalScreenTime($sessions);
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

    public function totalScreenTime($sessions)
    {
        $total = 0;

        foreach ($sessions as $session) {
            $total += $session->totalScreenTime();
        }

        return $total;
    }
}
