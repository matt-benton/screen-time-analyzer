@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <current-day-summary></current-day-summary>
        </div>
    </div>
    <hr>
    <div class="row pt-4">
        <div class="col-md-12">
            <h5 class="text-muted">Most Recent Days</h5>
        </div>
    </div>
    <div class="row justify-content-center pb-4">
        @foreach ($dateCards as $card)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        @eye_status_bar([
                            'sessions' => $card['sessions'],
                            'totalScreenTime' => $card['totalScreenTime'],
                        ])
                        @endeye_status_bar
                        <h2 class="pb-1 pt-5">{{ $card['totalScreenTimeFormatted'] }}</h2>
                        <p class="pb-4">Total Screen Time</p>
                        <h2 class="pb-1">{{ $card['averageSegmentLength'] }}</h2>
                        <p class="pb-4">Average Segment Length</p>
                    </div>
                    <a href="/sessions/date/{{ $card['date']->toDateString() }}" style="text-decoration:none">
                        <div class="card-footer text-muted">
                            <div class="row justify-content-between pl-3 pr-3">
                                <span>{{ $card['date']->englishDayOfWeek }}</span>
                                <span>{{ $card['date']->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="row pt-4">
        <div class="col-md-12">
            <multi-day-activity-display></multi-day-activity-display>
        </div>
    </div>
</div>
@endsection
