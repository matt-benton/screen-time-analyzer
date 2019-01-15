@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-8">
            <form action="/monitors" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name-input">Name</label>
                    <input type="text" class="form-control" id="name-input" name="name">
                </div>
                <div class="form-group">
                    <label for="description-textarea">Description</label>
                    <textarea class="form-control" id="description-textarea" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="screen-size-input">Screen Size</label>
                    <input type="text" class="form-control" id="screen-size-input" name="screen_size">
                </div>
                <div class="form-group">
                    <label for="resolution-input">Resolution</label>
                    <input type="text" class="form-control" id="resolution-input" name="resolution">
                </div>
                <div class="form-group">
                    <label for="refresh-rate-input">Refresh Rate</label>
                    <input type="text" class="form-control" id="refresh-rate-input" name="refresh_rate">
                </div>
                <div class="row justify-content-end pr-3">
                    <input type="submit" class="btn btn-outline-secondary" value="Save">
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monitors</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Screen Size</th>
                            <th>Resolution</th>
                            <th>Refresh Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monitors as $monitor)
                            <tr>
                                <td><a href="/monitors/{{ $monitor->id }}/edit">{{ $monitor->name }}</a></td>
                                <td>{{ $monitor->description }}</td>
                                <td>{{ $monitor->screen_size }}</td>
                                <td>{{ $monitor->resolution }}</td>
                                <td>{{ $monitor->refresh_rate }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
