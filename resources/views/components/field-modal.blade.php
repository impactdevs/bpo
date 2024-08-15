<!-- Modal -->
@php
    $modalId = ($mode == 'create') ? 'addFieldModal' : 'editFieldModal';
@endphp
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="addFieldModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFieldModalLabel">{{ $mode == 'create' ? 'Add Field' : 'Edit Field' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fields.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Field Label</label>
                        <input type="text" class="form-control" id="field_name" name="label" required>
                    </div>
                    <div class="mb-3">
                        <label for="field_type" class="form-label">Field Type</label>
                        <select class="form-select" id="field_type" name="type" required>
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="textarea">Textarea</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                    <input type="hidden" name="section_id" value="{{ $section }}" id="section_id">
                    <div class="mb-4" id="options_container" style="display: none;">
                        <label for="field_options" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Options</label>
                        <input type="text" name="options" id="field_options" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">Enter options separated by commas (e.g., Option 1, Option 2)</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Field</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

