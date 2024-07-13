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
                                        {{-- input --}}
                                        <input type="{{ $field->type }}" id="{{ $field->id }}" name="{{ $field->id }}"
                                            value="{{ $field->id }}">
                                </div>
                                @foreach (explode(',', $field->options) as $option)
                                    <div class="m-4">
                                        <input type="{{ $field->type }}" id="{{ $field->id }}_{{ $loop->index }}"
                                            name="{{ $option }}" value="{{ $option }}">
                                        <label for="{{ $field->id }}_{{ $loop->index }}"
                                            class="ml-2">{{ $option }}</label>
                                    </div>
                                @endforeach
                            @elseif ($field->type === 'textarea')
                                <div class="mb-3 d-flex flex-column justify-content-between">
                                    <label for="{{ $field->id }}" class="form-label">{{ $key + 1 }}.
                                        {{ $field->label }}</label>
                                    <textarea id="{{ $field->id }}" name="{{ $field->id }}"></textarea>
                                </div>
                            @else
                                <div class="mb-3 d-flex flex-column justify-content-between">
                                    <label for="{{ $field->id }}" class="form-label">{{ $key + 1 }}.
                                        {{ $field->label }}</label>
                                    <input type="{{ $field->type }}" id="{{ $field->id }}" name="{{ $field->id }}">
                                </div>
                            @endif

                            {{-- hidden form_id --}}
                            <input type="hidden" name="form_id" value="{{ $form->uuid }}">
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="form-check pt-3">
                <input class="form-check-input" type="checkbox" value="consent" id="flexCheckChecked"
                    required>
                <label class="form-check-label" for="flexCheckChecked">
                    I agree that the information provided is accurate and Impact Outsourcing can use it for research purposes.
                </label>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Submit' }}">
                </div>
            </div>
        @endif
    </div>
