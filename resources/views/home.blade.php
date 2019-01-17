@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @eye_status_bar(['sessions' => $sessions]);
                    @endeye_status_bar
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
