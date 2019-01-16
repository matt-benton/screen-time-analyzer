@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/segments/{{ $segment->id }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="session" value="{{ $segment->session->id }}">
                <hr>
                <h5>Edit Segment</h5>
                <hr>
                <div class="form-group">
                    <label for="start-input">Start</label>
                    <input type="time" class="form-control" id="start-input" name="start" value="{{ $segment->start->format('H:i') }}">
                </div>
                <div class="form-group">
                    <label for="end-input">End</label>
                    <input type="time" class="form-control" id="end-input" name="end" value="{{ $segment->end->format('H:i') }}">
                </div>
                <div class="form-group">
                    <label for="seating-input">Seating</label>
                    <select class="form-control" id="seating-input" name="seat">
                        @foreach ($seats as $seat)
                            <option value="{{ $seat->id }}" @if ($segment->seat_id === $seat->id) selected @endif>{{ $seat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="monitor-input">Monitor</label>
                    <select class="form-control" id="monitor-input" name="monitor">
                        @foreach ($monitors as $monitor)
                            <option value="{{ $monitor->id }}" @if ($segment->monitor_id === $monitor->id) selected @endif>{{ $monitor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="glasses-input">Glasses</label>
                    <select class="form-control" id="glasses-input" name="glasses">
                        @foreach ($glasses as $glass)
                            <option value="{{ $glass->id }}" @if ($segment->glasses_id === $glass->id) selected @endif>{{ $glass->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity-input">Activity</label>
                    <select class="form-control" id="activity-input" name="activity">
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" @if ($segment->activity_id === $activity->id) selected @endif>{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="eye-condition-input">Eye Conditions</label>
                    <select class="form-control" id="eye-condition-input" name="eye_condition">
                        @foreach ($eyeConditions as $condition)
                            <option value="{{ $condition->id }}" @if ($segment->eye_condition_id === $condition->id) selected @endif>{{ $condition->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="symptom-input">Symptoms</label>
                    <select multiple class="form-control" id="symptom-input" name="symptoms[]">
                        @foreach ($symptoms as $symptom)
                            <option value="{{ $symptom->id }}" @if ($segment->symptoms->contains('id', $symptom->id)) selected @endif>{{ $symptom->name }}</option>
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
