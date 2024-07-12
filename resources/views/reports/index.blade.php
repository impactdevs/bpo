<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Form Builder') }}
            </h2>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                aria-controls="offcanvasBottom"><i class="bi bi-plus"></i>Create</button>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Form Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (filled($forms))
                                @foreach ($forms as $form)
                                    <tr>
                                        <th scope="row">{{ $form->uuid }}</th>
                                        <td>{{ $form->name }}</td>
                                        <td>Active</td>
                                        <td>{{ $form->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('form-builder.show', $form->uuid) }}" class="">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <a href="#" class="">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="offcanvas offcanvas-end border" tabindex="-1" id="offcanvasBottom"
                        aria-labelledby="offcanvasBottomLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Add A Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body small">
                            <form action="{{ route('form-builder.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="form_name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Form
                                        Name</label>
                                    <input type="text" name="name" id="form_name"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md transition duration-300 ease-in-out">
                                        Add
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
