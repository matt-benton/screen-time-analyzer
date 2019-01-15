@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-8">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/eye_conditions">Eye Conditions</a></li>
                <li class="breadcrumb-item active">{{ $eyeCondition->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-center pb-3" style="display:none" id='delete-alert-container'>
        <div class="col-md-8">
            <div class="alert alert-danger">
                <div class="row">
                    <div class="col-md-6" style="padding-top:6px">Delete this eye condition?</div>
                    <div class="col-md-6 text-right">
                        <form action="/eye_conditions/{{ $eyeCondition->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Confirm">
                            <button type="button" class="btn btn-secondary" id="cancel-delete-button">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pb-3">
        <div class="col-md-8">
            <form action="/eye_conditions/{{ $eyeCondition->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name-input">Name</label>
                    <input type="text" class="form-control" id="name-input" name="name" value="{{ $eyeCondition->name }}">
                </div>
                <div class="form-group">
                    <label for="definition-textarea">Definition</label>
                    <textarea class="form-control" id="definition-textarea" name="definition">{{ $eyeCondition->definition }}</textarea>
                </div>
                <div class="row justify-content-end pr-3">
                    <input type="submit" class="btn btn-outline-primary mr-2" value="Save">
                    <button type="button" class="btn btn-outline-danger mr-2" id="delete-button">Delete</button>
                    <a href="/eye_conditions"><button type="button" class="btn btn-outline-secondary">Back</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // show the delete alert
    document.getElementById('delete-button').addEventListener('click', function () {
        document.getElementById('delete-alert-container').style.display = 'flex';
    });

    // hide the delete alert
    document.getElementById('cancel-delete-button').addEventListener('click', function () {
        document.getElementById('delete-alert-container').style.display = 'none';
    });
</script>
@endsection
