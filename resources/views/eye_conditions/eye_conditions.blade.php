@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-8">
            <form action="/eye_conditions" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name-input">Name</label>
                    <input type="text" class="form-control" id="name-input" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                    <label for="definition-textarea">Definition</label>
                    <textarea class="form-control" id="definition-textarea" placeholder="Definition" name="definition"></textarea>
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
                <div class="card-header">Eye Conditions</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Definition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eyeConditions as $eyeCondition)
                            <tr>
                                <td><a href="/eye_conditions/{{ $eyeCondition->id }}/edit">{{ $eyeCondition->name }}</a></td>
                                <td>{{ $eyeCondition->definition }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
