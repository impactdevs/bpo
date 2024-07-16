<div>
    <p>{{ $question }}</p>
    @foreach ($options as $optionValue => $optionLabel)
        <div class="form-check">
            <input class="form-check-input shadow-none" type="checkbox" id="{{ $id . '-' . $loop->index }}" name="{{ $name }}[]" value="{{ $optionValue }}">
            <label class="form-check-label" for="{{ $id . '-' . $loop->index }}">
                {{ $optionLabel }}
            </label>
        </div>
    @endforeach
</div>
