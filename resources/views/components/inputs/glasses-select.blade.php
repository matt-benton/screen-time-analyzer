<label for="glasses-input">Glasses</label>
<select class="form-control" id="glasses-input" name="glasses">
    @foreach ($glasses as $glass)
        <option
                value="{{ $glass->id }}"
                @if ($segment)
                    @if ($segment->glasses_id === $glass->id) selected @endif
                @endif
                @if ($glass->active === 0) disabled @endif>{{ $glass->name }}</option>
    @endforeach
</select>
