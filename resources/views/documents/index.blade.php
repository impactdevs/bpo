<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Document Manager') }}
            </h2>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUpload"
                aria-controls="offcanvasUpload"><i class="bi bi-upload"></i> Upload Document</button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Uploaded Date</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (filled($documents))
                                @foreach ($documents as $document)
                                    <tr id="document-row-{{ $document->id }}">
                                        <td>{{ $document->created_at?->diffForHumans() }}</td>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->description }}</td>
                                        <td>
                                            <a href="{{ route('documents.show', $document->id) }}" class="">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ route('documents.download', $document->id) }}" class="">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                            <a href="#" onclick="deleteDocument('{{ $document->id }}')" class="">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No documents found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!-- Upload Off-Canvas -->
                    <div class="offcanvas offcanvas-end border" tabindex="-1" id="offcanvasUpload"
                        aria-labelledby="offcanvasUploadLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasUploadLabel">Upload Document</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body small">
                            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <label for="document_name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Document
                                        Name</label>
                                    <input type="text" name="description" id="document_name"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label for="document_file"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload
                                        File</label>
                                    <input type="file" name="document" id="document_file"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md transition duration-300 ease-in-out">
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteDocument(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/documents/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'The document has been deleted.',
                                'success'
                            );

                            // Remove the document row from the table
                            $(`#document-row-${id}`).remove();
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'The document could not be deleted.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

