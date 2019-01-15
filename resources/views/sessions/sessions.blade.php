@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center pb-3">
        <div class="col-md-8 text-right">
            <a href="/sessions/create"><button class="btn btn-outline-secondary">New Session</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sessions</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Timeframe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                            <tr>
                                <td><a href="/sessions/{{ $session->id }}">{{ $session->startFormatted() }} - {{ $session->endFormatted() }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sessions->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
