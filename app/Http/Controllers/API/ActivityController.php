<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FormatTimes;
use App\Services\SessionService;
use App\Activity;
use Carbon\Carbon;
use Auth;

class ActivityController extends Controller
{
    public function __construct(SessionService $sessionService, FormatTimes $formatTimes)
    {
        $this->sessionService = $sessionService;
        $this->formatTimes = $formatTimes;
    }

    public function indexWithStats($date)
    {
        $activities = Auth::user()->activities;

        $date = new Carbon($date);

        $totalScreenTime = $this->sessionService->getScreenTimeByDate($date);

        foreach ($activities as $activity) {
            $activity->total = $this->formatTimes->hoursAndMinutes($activity->calculateTotalTimeSpentByDate($date));
            $activity->percent = $activity->calculatePercentOfTotalTimeSpentByDate($date);
        }

        return response($activities);
    }

    public function getByDate(Request $request)
    {
        $date = new Carbon($request->date);
        $totalScreenTime = $this->sessionService->getScreenTimeByDate($date);

        $activities = Auth::user()->activities;

        foreach ($activities as $activity) {
            $activity->total = $activity->calculateTotalTimeSpentByDate($date);
            $activity->percent = $activity->calculatePercentOfTotalTimeSpentByDate($date);
        }

        return response($activities);
    }

    public function getByDateRange(Request $request)
    {
        $start = new Carbon($request->start);
        $end = new Carbon($request->end);
        $totalScreenTime = $this->sessionService->getScreenTimeByDateRange($start, $end);

        $activities = Auth::user()->activities;

        foreach ($activities as $activity) {
            $activity->total = $activity->calculateTotalTimeSpentByDateRange($start, $end);
            $activity->percent = $activity->calculatePercentOfTotalTimeSpentByDateRange($start, $end);
        }

        return response($activities);
    }
}
