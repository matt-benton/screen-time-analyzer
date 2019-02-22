@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-12 col-lg-8">
            <form action="/sessions" method="POST">
                @csrf
                <hr>
                <h5>New Session</h5>
                <hr>
                <div class="form-group">
                    <label for="date-input">Date</label>
                    <input type="date" class="form-control" id="date-input" name="date">
                </div>
                <div class="form-group">
                    <label for="daytime-input">Daytime</label>
                    <select class="form-control" id="daytime-input" name="daytime">
                        @foreach ($daytimes as $daytime)
                            <option value="{{ $daytime->id }}">{{ $daytime->name }}</option>
                        @endforeach
                    </select>
                </div>
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
                    <label for="eye-condition-input">Eye Condition</label>
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
