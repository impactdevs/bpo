<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Form Builder') }} -> {{ __($form->name) }}
            </h2>

            <a href="{{ route('forms.settings', $form->uuid) }}" class="btn btn-primary">
                <i class="bi bi-gear-fill"></i></i> Settings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        @if ($form->fields->isEmpty())
            <h1>This form has no form fields</h1>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFieldModal">
                    <i class="bi bi-plus"></i> Add a Field
                </button>
            </div>
        @else
            @foreach ($form->fields as $key => $field)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            @if ($field->type === 'radio' || $field->type === 'checkbox')
                                <div class="mb-3 d-flex flex-row justify-content-between">
                                    <label for="{{ $field->id }}" class="form-label">{{ $key + 1 }}.
                                        {{ $field->label }}</label>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary btn-sm ms-2">Edit</button>
                                        <button type="button" class="btn btn-primary btn-sm ms-2">Delete</button>
                                        <button type="button" class="btn-sm ms-2"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </div>

                                </div>
                                @foreach (explode(',', $field->options) as $option)
                                    <div class="m-4">
                                        <input type="{{ $field->type }}" id="{{ $field->id }}_{{ $loop->index }}"
                                            name="{{ $option }}" value="{{ $option }}">
                                        <label for="{{ $field->id }}_{{ $loop->index }}"
                                            class="ml-2">{{ $option }}</label>
                                    </div>
                                @endforeach
                            @else
                                <div class="mb-3 d-flex flex-row justify-content-between">
                                    <label for="{{ $field->id }}" class="form-label">{{ $key + 1 }}.
                                        {{ $field->label }}</label>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary btn-sm ms-2">Edit</button>
                                        <button type="button" class="btn btn-primary btn-sm ms-2">Delete</button>
                                        <button type="button" class="btn-sm ms-2"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFieldModal">
                    <i class="bi bi-plus"></i> Add a Field
                </button>
            </div>
        @endif
    </div>
</x-app-layout>


<!-- Modal -->
<div class="modal fade" id="addFieldModal" tabindex="-1" aria-labelledby="addFieldModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFieldModalLabel">Add a Field</h5>
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
                        </select>
                    </div>
                    <input type="hidden" name="form_id" value="{{ $form->uuid }}">
                    <div class="mb-4" id="options_container" style="display: none;">
                        <label for="field_options"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Options</label>
                        <input type="text" name="options" id="field_options"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">Enter options separated by commas
                            (e.g., Option 1, Option 2)</p>
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
