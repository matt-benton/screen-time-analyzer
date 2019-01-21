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

        // Get the last three days worth of sessions
        $sessions = Auth::user()->sessions()->whereBetween('date', [$threeMonthsAgo, $yesterday])->latest('date')->limit(3)->get();

        // Calculate what percentage of total screen time each segment takes
        // foreach ($sessions as $session) {
        //     $session->segments->map(function ($segment, $key) use ($totalScreenTime) {
        //         $segment->percentage_of_screen_time = $segment->calculateDailyPercentageOfScreenTime($totalScreenTime);
        //     });
        // }

        return view('home', [
            'sessions' => $sessions,
        ]);
    }
}
