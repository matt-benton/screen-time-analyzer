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
