<div class="row justify-content-between">
    <div class="col-md-6 text-left">
        <span class="text-muted">{{ $session->startFormatted() }} - {{ $session->endFormatted() }} ({{ $session->daytime->name }})</span>
    </div>
    <div class="col-md-6 text-right">
        <span class="text-muted"><b>{{ $session->lengthFormatted() }}</b></span>
    </div>
</div>
<div class="card mb-3 mt-1">
    <table class="table mb-0">
        <thead>
            <tr>
                <th class="text-muted">LENGTH</th>
                <th class="text-muted">SEATING</th>
                <th class="text-muted">MONITOR</th>
                <th class="text-muted">ACTIVITY</th>
                <th class="text-muted">GLASSES</th>
                <th class="text-muted">SYMPTOMS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($session->segments as $segment)
                @switch ($segment->eyeCondition->name)
                    @case('green')
                        <tr class="table-success">
                        @break
                    @case('yellow')
                        <tr class="table-warning">
                        @break
                    @case('red')
                        <tr class="table-danger">
                        @break
                    @default
                        <tr>
                @endswitch
                    <td>
                        <a href="/segments/{{ $segment->id }}/edit" class="text-dark">
                            <b>{{ $segment->lengthFormatted() }}</b><br>
                        </a>
                        <span class="text-muted" style="font-size:0.7rem">
                            {{ $segment->start->format('g:i a') }} - {{ $segment->end->format('g:i a') }}
                        </span>
                    </td>
                    <td>{{ $segment->seat->name }}</td>
                    <td>
                        @foreach ($segment->monitors as $monitor) 
                            {{ $monitor->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ $segment->activity->name }}</td>
                    <td>{{ $segment->glasses->name }}</td>
                    <td>
                        @foreach ($segment->symptoms as $symptom)
                            {{ $symptom->name }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
