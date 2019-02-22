@extends('layouts.app')

@section('content')

<div class="container">
    <!-- List of segment -->
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">{{ $session->date->format('m-d-Y') }}</li>
                </ol>
            </nav>

            <div class="d-none d-md-block">
                @session_table(['session' => $session])
                @endsession_table
            </div>

            <div class="d-md-none">
                @foreach ($session->segments as $segment)
                    @segment_card(['segment' => $segment])
                    @endsegment_card
                @endforeach
            </div>
        </div>
    </div>

    <!-- Form for adding segments -->
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <form action="/segments" method="POST">
                @csrf
                <input type="hidden" name="session" value="{{ $session->id }}">
                <hr>
                <h5>Add a Segment</h5>
                <hr>
                <div class="form-group">
                    <label for="start-input">Start</label>
                    <input type="time" class="form-control" id="start-input" name="start">
                </div>
                <div class="form-group">
                    <label for="end-input">End</label>
                    <input type="time" class="form-control" id="end-input" name="end">
                </div>
                <div class="form-group">
                    <label for="seating-input">Seating</label>
                    <select class="form-control" id="seating-input" name="seat">
                        @foreach ($seats as $seat)
                            <option value="{{ $seat->id }}" @if ($mostRecentSegment->seat_id === $seat->id) selected @endif>{{ $seat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="monitor-input">Monitor</label>
                    <select class="form-control" id="monitor-input" name="monitor">
                        @foreach ($monitors as $monitor)
                            <option value="{{ $monitor->id }}" @if ($mostRecentSegment->monitor_id === $monitor->id) selected @endif>{{ $monitor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="glasses-input">Glasses</label>
                    <select class="form-control" id="glasses-input" name="glasses">
                        @foreach ($glasses as $glass)
                            <option value="{{ $glass->id }}" @if ($mostRecentSegment->glasses_id === $glass->id) selected @endif>{{ $glass->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity-input">Activity</label>
                    <select class="form-control" id="activity-input" name="activity">
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" @if ($mostRecentSegment->activity_id === $activity->id) selected @endif>{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="eye-condition-input">Eye Condition</label>
                    <select class="form-control" id="eye-condition-input" name="eye_condition">
                        <option value="0"></option>
                        @foreach ($eyeConditions as $condition)
                            <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="symptom-input">Symptoms</label>
                    <select multiple class="form-control" id="symptom-input" name="symptoms[]">
                        @foreach ($symptoms as $symptom)
                            <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row justify-content-end pr-3">
                    <input type="submit" class="btn btn-outline-secondary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
