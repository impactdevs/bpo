<a href="{{ url('entries', $entry->id) }}" class="btn btn-link">
    <i class="bi bi-eye"></i>
</a>

<form action="{{ route('entries.edit', $entry->id) }}" method="GET" class="d-inline">
    @csrf
    @method('PUT')
    <input type="hidden" name="form_id" value="{{ $entry->form_id }}">
    <button type="submit" class="btn btn-link">
        <i class="bi bi-pencil"></i>
    </button>
</form>

<form action="{{ route('entries.destroy', $entry->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link">
        <i class="bi bi-trash"></i>
    </button>
</form>