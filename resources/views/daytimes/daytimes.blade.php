@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-8">
            <form action="/daytimes" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name-input">Name</label>
                    <input type="text" class="form-control" id="name-input" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                    <label for="description-textarea">Description</label>
                    <textarea class="form-control" id="description-textarea" placeholder="Description" name="description"></textarea>
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
                <div class="card-header">Daytimes</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daytimes as $daytime)
                            <tr>
                                <td><a href="/daytimes/{{ $daytime->id }}/edit">{{ $daytime->name }}</a></td>
                                <td>{{ $daytime->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
