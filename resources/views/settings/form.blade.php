{{-- Question --}}
<div class="form-group">
    <label for="form_field_id" class="control-label">{{ 'Question' }}</label>
    <select class="form-control shadow-none" name="form_field_id" id="form_field_id">
        @foreach ($form_fields as $item => $value)
            <option value="{{ $value->id }}" {{ (isset($currentItem) && $currentItem->form_field_id == $value->id) ? 'selected' : '' }}>
                {{ $value->label }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="name" class="control-label">{{ 'Option' }}</label>
    <input class="form-control shadow-none" name="name" type="text" id="name" value="{{ isset($currentItem) ? $currentItem->name : '' }}">
</div>

<div class="form-group m-3">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
