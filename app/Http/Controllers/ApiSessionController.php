<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SessionService;
use App\Services\FormatTimes;
use Auth;

class ApiSessionController extends Controller
{
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
}
