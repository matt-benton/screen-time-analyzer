<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Services\SessionService;
use App\Services\FormatTimes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SessionService $sessionService, FormatTimes $formatTimes)
    {
        $this->middleware('auth');
        $this->sessionService = $sessionService;
        $this->formatTimes = $formatTimes;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now('America/Chicago');

        // Get a list of session dates (most recent first) that excludes today
        $dates = Auth::user()->sessions()->whereDate('date', '<', $today)->latest()->pluck('date')->unique()->take(3)->reverse();   // NOTE: May need to limit this query to last few months or something when it gets too big

        $dateCards = [];

        foreach ($dates as $date) {
            $cardInfo = [];
            $cardInfo['date'] = $date;
            $cardInfo['sessions'] = Auth::user()->sessions()->whereDate('date', $date)->get();
            $cardInfo['totalScreenTime'] = $this->sessionService->getScreenTimeByDate($date);
            $cardInfo['totalScreenTimeFormatted'] = $this->formatTimes->hoursAndMinutes($cardInfo['totalScreenTime']);
            $cardInfo['averageSegmentLength'] = $this->formatTimes->hoursAndMinutes($this->sessionService->getAverageSegmentLength($date));
            $cardInfo['totalScreenTime'] = $this->sessionService->getScreenTimeByDate($date);
            array_push($dateCards, $cardInfo);
        }

        return view('home', [
            'dateCards' => $dateCards,
        ]);
    }
}
