<x-app-layout>
    <div class="py-12">
        @foreach ($entry->formatted_responses as $key => $field)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-3 d-flex flex-column justify-content-between">
                            <h6>{{ $key }}</h6>
                            <p>{{ $field }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
