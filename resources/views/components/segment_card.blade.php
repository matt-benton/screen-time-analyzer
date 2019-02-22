<div class="card mb-3 @switch ($segment->eyeCondition->name) @case('green') border-success @break @case('yellow') border-warning @break @case('red') border-danger @break @default @endswitch" >
    <a href="/segments/{{ $segment->id }}/edit">
        <div class="card-header bg-transparent @switch ($segment->eyeCondition->name) @case('green') border-success @break @case('yellow') border-warning @break @case('red') border-danger @break @default @endswitch">
            <div class="row justify-content-between">
                <div class="col text-dark">
                    {{ $segment->lengthFormatted() }}
                </div>
                <div class="col text-right">
                    <span class="card-subtitle text-muted">{{ $segment->start->format('g:i a') }} - {{ $segment->end->format('g:i a') }}</span>
                </div>
            </div>
        </div>
    </a>
    <div class="card-body">
        {{ $segment->seat->name }}<br>
        {{ $segment->monitor->name }}<br>
        {{ $segment->activity->name }}<br>
        {{ $segment->glasses->name }}<br>

        @foreach ($segment->symptoms as $symptom)
            {{ $symptom->name }}<br>
        @endforeach
    </div>
</div>
