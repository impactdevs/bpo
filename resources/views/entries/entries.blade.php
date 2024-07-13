<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Sub title</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (filled($entries))
                                @foreach ($entries as $entry)
                                    <tr>
                                        <th scope="row">{{ $entry->id }}</th>
                                        <td>{{ $entry->title }}</td>
                                        <td>{{ $entry->subtitle }}</td>
                                        <td>{{ $entry->user->name??'Un Known User' }}</td>
                                        <td>{{ $entry->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ url('entries', $entry->id) }}" class="">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
