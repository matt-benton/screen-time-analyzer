<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $threeMonthsAgo = Carbon::now('America/Chicago')->subMonth(3)->toDateString();
        $yesterday = Carbon::now('America/Chicago')->subDay()->toDateString();

        // Get sessions from up to three months ago
        $sessions = Auth::user()->sessions()->whereBetween('date', [$threeMonthsAgo, $yesterday])->latest('date')->get();

        // Split sessions up into three most recent days
        $dates = $sessions->pluck('date')->unique();
        $mostRecentDate = $dates->shift();
        $secondMostRecentDate = $dates->shift();
        $thirdMostRecentDate = $dates->shift();

        $mostRecentSessions = $sessions->filter(function ($session, $key) use ($mostRecentDate) {
            return $session->date == $mostRecentDate;
        });

        // Calculate what percentage of total screen time each segment takes
        foreach ($mostRecentSessions as $sessions) {
            $session->segments->map(function ($segment, $key) use ($totalScreenTime) {
                $segment->percentage_of_screen_time = $segment->calculateDailyPercentageOfScreenTime($totalScreenTime);
            });
        }



        return view('home', [
            'sessions' => $mostRecentSessions,
        ]);
    }
}
