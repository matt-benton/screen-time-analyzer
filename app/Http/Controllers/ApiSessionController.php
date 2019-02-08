<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SessionService;
use App\Services\FormatTimes;

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
        $sessions = $this->sessionService->index();

        $sessions->map(function ($session) {
            $session->length = $session->lengthFormatted();
            $session->start = $session->startFormatted();
            $session->end = $session->endFormatted();
            $session->screen_time = $this->formatTimes->hoursAndMinutes($session->totalScreenTime());
        });

        return response()->json(['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
