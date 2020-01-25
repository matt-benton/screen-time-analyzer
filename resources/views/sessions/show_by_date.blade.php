@extends('layouts.app')

@section('content')

<div class="container col-md-12 col-xl-9">
    @eye_status_bar(['sessions' => $sessions, 'totalScreenTime' => $totalScreenTime])
    @endeye_status_bar
    <div class="row justify-content-center">
        <!-- Daily Summary -->
        <div class="col-md-4">
            <span class="text-muted">{{ $date->format('l, F j, Y') }}</span>
            <div class="card bg-light mt-1 pl-2 pr-2 mb-3">
                <div class="card-body">
                    Total Screen Time
                    <h3 class="text-right pb-4">{{ $totalScreenTimeFormatted }}</h3>
                    Average Session Length
                    <h5 class="text-right pb-4">{{ $avgSessionLength }}</h5>
                    Average Segment Length
                    <h5 class="text-right pb-4">{{ $avgSegmentLength }}</h5>
                </div>
            </div>
            <single-day-activity-display date="{{ $date->toDateString() }}"></single-day-activity-display>
        </div>

        <!-- Sessions list -->
        <div class="col-md-8">
            <div class="d-none d-md-block">
                @foreach ($sessions as $session)
                    @session_table(['session' => $session]) @endsession_table
                @endforeach
            </div>

            <div class="d-md-none">
                @foreach ($sessions as $session)
                    @foreach ($session->segments as $segment)
                        @segment_card(['segment' => $segment]) @endsegment_card
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection