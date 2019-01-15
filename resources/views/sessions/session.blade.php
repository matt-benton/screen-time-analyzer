@extends('layouts.app')

@section('content')

<div class="container">
    <!-- List of segment -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Length</th>
                        <th>Seat</th>
                        <th>Monitor</th>
                        <th>Activity</th>
                        <th>Glasses</th>
                        <th>Eye Condition</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($segments as $segment)
                        <tr>
                            <td>
                                {{ $segment->length() }} minutes
                                <br>
                                {{ $segment->start->format('g:i a') }} - {{ $segment->end->format('g:i a') }}
                            </td>
                            <td>{{ $segment->seat->name }}</td>
                            <td>{{ $segment->monitor->name }}</td>
                            <td>{{ $segment->activity->name }}</td>
                            <td>{{ $segment->glasses->name }}</td>
                            <td>
                                {{ $segment->eyeCondition->name }}
                                <br>
                                @foreach ($segment->symptoms as $symptom)
                                    {{ $symptom->name }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form for adding segments -->
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                            <option value="{{ $seat->id }}">{{ $seat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="monitor-input">Monitor</label>
                    <select class="form-control" id="monitor-input" name="monitor">
                        @foreach ($monitors as $monitor)
                            <option value="{{ $monitor->id }}">{{ $monitor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="glasses-input">Glasses</label>
                    <select class="form-control" id="glasses-input" name="glasses">
                        @foreach ($glasses as $glass)
                            <option value="{{ $glass->id }}">{{ $glass->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity-input">Activity</label>
                    <select class="form-control" id="activity-input" name="activity">
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="eye-condition-input">Eye Conditions</label>
                    <select class="form-control" id="eye-condition-input" name="eye_condition">
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
