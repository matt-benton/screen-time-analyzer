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
                <div class="row justify-content-between">
                    <div class="col-md-6 text-left">
                        <span class="text-muted">{{ $session->startFormatted() }} - {{ $session->endFormatted() }} ({{ $session->daytime->name }})</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <span class="text-muted"><b>{{ $session->lengthFormatted() }}</b></span>
                    </div>
                </div>
                <div class="card mb-3 mt-1">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted">LENGTH</th>
                                <th class="text-muted">SEATING</th>
                                <th class="text-muted">MONITOR</th>
                                <th class="text-muted">ACTIVITY</th>
                                <th class="text-muted">GLASSES</th>
                                <th class="text-muted">SYMPTOMS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($session->segments as $segment)
                                @switch ($segment->eyeCondition->name)
                                    @case('Green')
                                        <tr class="table-success">
                                        @break
                                    @case('Orange')
                                        <tr class="table-warning">
                                        @break
                                    @case('Red')
                                        <tr class="table-danger">
                                        @break
                                    @default
                                        <tr>
                                @endswitch
                                    <td>
                                        <b>{{ $segment->lengthFormatted() }}</b><br>
                                        <span class="text-muted" style="font-size:0.7rem">{{ $segment->start->format('g:i a') }} - {{ $segment->end->format('g:i a') }}</span>
                                    </td>
                                    <td>{{ $segment->seat->name }}</td>
                                    <td>{{ $segment->monitor->name }}</td>
                                    <td>{{ $segment->activity->name }}</td>
                                    <td>{{ $segment->glasses->name }}</td>
                                    <td>
                                        @foreach ($segment->symptoms as $symptom)
                                            {{ $symptom->name }}<br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
