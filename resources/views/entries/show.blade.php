<x-app-layout>
    <div class="py-12">
        @foreach ($entry->formatted_responses as $key => $field)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-3 d-flex flex-column justify-content-between">
                            {{-- Check if there are no answers and style the question accordingly --}}
                            @if (empty($field))
                                <h6 class="font-bold text-lg text-red-600">
                                    Question {{ $loop->iteration }}: {{ $key }}
                                    <span class="text-red-500"> - No answer</span>
                                </h6>
                            @else
                                <h6 class="font-bold text-lg">
                                    Question {{ $loop->iteration }}: {{ $key }}
                                </h6>
                            @endif

                            @if (is_array($field))
                                {{-- Handle the case where $field is an array with special styling for answers --}}
                                <ul class="list-disc pl-5 mt-2">
                                    @foreach ($field as $item)
                                        <li class="text-blue-600">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {{-- Handle the case where $field is not an array with special styling for answers --}}
                                <p class="text-green-600">{{ $field }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
