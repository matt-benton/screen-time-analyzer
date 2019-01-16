@extends('layouts.app')

@section('content')

<div class="container">
    <div class="progress mb-3" style="height:4px;">
        @foreach ($sessions as $session)
            @foreach ($session->segments as $segment)
                <div class="progress-bar @if ($segment->eyeCondition->name === 'green') bg-success @elseif ($segment->eyeCondition->name === 'yellow') bg-warning @else bg-danger @endif" style="width: {{ $segment->percentage_of_screen_time }}%"></div>
            @endforeach
        @endforeach
    </div>
    <div class="row justify-content-center">
        <!-- Daily Summary -->
        <div class="col-md-4">
            <span class="text-muted">{{ $date->format('l, F j, Y') }}</span>
            <div class="card bg-light mt-1 pl-2 pr-2">
                <div class="card-body">
                    Total Screen Time
                    <h3 class="text-right pb-4">{{ $totalScreenTime }}</h3>
                    Average Session Length
                    <h5 class="text-right pb-4">{{ $avgSessionLength }}</h5>
                    Average Segment Length
                    <h5 class="text-right pb-4">{{ $avgSegmentLength }}</h5>
                </div>
            </div>

            <ul class="list-group mt-1">
                @foreach ($activities as $activity)
                    @if ($activity->percent > 0)
                        <li class="list-group-item">{{ $activity->name }}: {{ $activity->total }} minutes ({{ $activity->percent }}%)</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Sessions list -->
        <div class="col-md-8">
            @foreach ($sessions as $session)
                @session_table(['session' => $session])
                @endsession_table
            @endforeach
        </div>
    </div>
</div>

@endsection
