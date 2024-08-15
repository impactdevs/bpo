 <div class="py-12">
     @if ($form->sections->isEmpty())
         <h1>This form has no form fields</h1>
     @else
         {{-- iterate through sections and create an accordion --}}
         @for ($i = 0; $i < count($form->sections); $i++)
             {{-- create an accordion for each section --}}
             <div class="border border-5 border-primary">
                 {{-- section title --}}
                 <div class="m-2 d-flex flex-row justify-between">
                     <p class="h6">
                         <a class="btn btn-primary" data-bs-toggle="collapse" href="#section{{ $i }}"
                             role="button" aria-expanded="false" aria-controls="section{{ $i }}">
                             {{ $i + 1 }}.{{ $form->sections[$i]->section_name }}
                         </a>
                     </p>
                 </div>

                 {{-- description --}}
                 <p class="h6">
                     {{ $form->sections[$i]->section_description ?? '' }}
                 </p>

                 {{-- if there are no fields --}}
                 @if ($form->sections[$i]->fields->isEmpty())
                     <div class="m-2">
                         <p>This section has no form fields</p>
                     </div>
                 @else
                     @foreach ($form->sections[$i]->fields as $key => $field)
                         @php
                             $condional_id = null;
                             $trigger_value = null;
                             //condional file
                             if ($field->properties && isset($field->properties[0])) {
                                 $condional_id = $field->properties[0]->conditional_visibility_field_id;

                                 $trigger_value = $field->properties[0]->conditional_visibility_operator;
                             }
                         @endphp
                         <div class="form-group question" id="question_{{ $field->id }}"
                             data-radio-field="{{ $condional_id }}" data-trigger-value="{{ $trigger_value }}"
                             style="@if ($condional_id != null) display:none; @endif">
                             <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                     <div class="p-6 text-gray-900 dark:text-gray-100">
                                         @if ($field->type === 'radio')
                                             <div class="mb-3 d-flex flex-column justify-content-between">
                                                 <label for="{{ $field->id }}"
                                                     class="form-label">{{ $i + 1 }}.{{ $key + 1 }}.
                                                     {{ $field->label }}</label>

                                             </div>
                                             @foreach (explode(',', $field->options) as $option)
                                                 <div class="m-4">
                                                     <input type="{{ $field->type }}"
                                                         id="{{ $field->id }}_{{ $loop->index }}"
                                                         name="{{ $field->id }}" value="{{ $option }}">
                                                     <label for="{{ $field->id }}_{{ $loop->index }}"
                                                         class="ml-2">{{ $option }}</label>
                                                 </div>
                                             @endforeach
                                         @elseif ($field->type === 'checkbox')
                                             <div class="mb-3 d-flex flex-column justify-content-between">
                                                 <label for="{{ $field->id }}"
                                                     class="form-label">{{ $i + 1 }}.{{ $key + 1 }}.
                                                     {{ $field->label }}</label>
                                             </div>
                                             @foreach (explode(',', $field->options) as $option)
                                                 <div class="m-4">
                                                     <input type="{{ $field->type }}"
                                                         id="{{ $field->id }}_{{ $loop->index }}"
                                                         name="{{ $field->id }}[]" value="{{ $option }}">
                                                     <label for="{{ $field->id }}_{{ $loop->index }}"
                                                         class="ml-2">{{ $option }}</label>
                                                 </div>
                                             @endforeach
                                         @elseif ($field->type === 'textarea')
                                             <div class="mb-3 d-flex flex-column justify-content-between">
                                                 <div class="d-flex justify-content-between mb-2">
                                                     <label for="{{ $field->id }}"
                                                         class="form-label">{{ $i + 1 }}.{{ $key + 1 }}.
                                                         {{ $field->label }}</label>
                                                 </div>

                                                 <textarea id="{{ $field->id }}" name="{{ $field->id }}"></textarea>

                                             </div>
                                         @else
                                             <div class="mb-3 d-flex flex-column justify-content-between">
                                                 <label for="{{ $field->id }}"
                                                     class="form-label">{{ $i + 1 }}.{{ $key + 1 }}.
                                                     {{ $field->label }}</label>
                                                 <input type="{{ $field->type }}" id="{{ $field->id }}"
                                                     name="{{ $field->id }}" class="form-control w-75 ms-2">
                                             </div>
                                         @endif


                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @endif
             </div>
 </div>
 @endfor
 {{-- hidden form_id --}}
 <input type="hidden" name="form_id" value="{{ $form->uuid }}">
 {{-- submit button --}}
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
     <div class="form-group">
         <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Submit' }}">
     </div>
 </div>
 @endif

 </div>
