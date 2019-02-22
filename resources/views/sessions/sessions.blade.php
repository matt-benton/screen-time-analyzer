@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-12 col-lg-8 text-right">
            <a href="/sessions/create"><button class="btn btn-outline-secondary">New Session</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <session-list></session-list>
        </div>
    </div>
</div>

@endsection
