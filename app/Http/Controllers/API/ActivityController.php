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

        $totalScreenTime = $this->sessionService->getScreenTimeByDate(new Carbon($date));

        foreach ($activities as $activity) {
            $activity->total = $this->formatTimes->hoursAndMinutes($activity->calculateTotalTimeSpentByDate($date));
            $activity->percent = $activity->calculatePercentOfTotalTimeSpentByDate($date, $totalScreenTime);
        }

        return response($activities);
    }
}
