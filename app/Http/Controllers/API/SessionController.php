<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\SessionService;
use App\Services\FormatTimes;
use App\Http\Controllers\Controller;
use Auth;

class SessionController extends Controller
{
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
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
