@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <!-- Daily Summary -->
        <div class="col-md-4">
            <span class="text-muted">{{ $date->format('l, F j, Y') }}</span>
            <div class="card bg-light mt-1 pl-2 pr-2">
                <div class="card-body">
                    Total Screen Time
                    <h3 class="text-right pb-4">{{ $totalScreenTime }} min</h3>
                    Average Session Length
                    <h5 class="text-right pb-4">{{ $avgSessionLength }} min</h5>
                    Average Segment Length
                    <h5 class="text-right pb-4">{{ $avgSegmentLength }} min</h5>
                </div>
            </div>

            <ul class="list-group mt-1">
                @foreach ($activities as $activity)
                    <li class="list-group-item">{{ $activity->name }}: {{ $activity->total }} minutes ({{ $activity->percent }}%)</li>
                @endforeach
            </ul>

            <!-- <ul class="list-group mt-1">
                <li class="list-group-item">Average break length</li>
            </ul> -->
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
