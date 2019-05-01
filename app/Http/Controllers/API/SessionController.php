<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\SessionService;
use App\Services\FormatTimes;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Auth;

class SessionController extends Controller
{
    protected $sessionService;
    protected $formatTimes;

    public function __construct(SessionService $sessionService, FormatTimes $formatTimes)
    {
        $this->sessionService = $sessionService;
        $this->formatTimes = $formatTimes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['sessions' => $this->sessionService->index()]);
    }

    public function getTotalScreenTime($year, $month, $day)
    {
        $date = new Carbon($year . '-' . $month . '-' . $day);
        $totalScreenTime = $this->sessionService->getScreenTimeByDate($date);

        return response($this->formatTimes->hoursAndMinutes($totalScreenTime));
    }
}
