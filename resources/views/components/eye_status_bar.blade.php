<div class="progress mb-3" style="height:4px;">
    @foreach ($sessions as $session)
        @foreach ($session->segments as $segment)
            <div class="progress-bar @if ($segment->eyeCondition->name === 'green') bg-success @elseif ($segment->eyeCondition->name === 'yellow') bg-warning @else bg-danger @endif" style="width: {{ $segment->percentage_of_screen_time }}%"></div>
        @endforeach
    @endforeach
</div>
