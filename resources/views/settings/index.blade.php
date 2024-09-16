<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Settings') }}
            </h2>
            <a class="btn btn-primary" href="{{ route('settings.create') }}"><i class="bi bi-upload"></i> Add</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table">
                        <thead>
                            <th>Question</th>
                            <th>Option</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach ($settings as $setting)
                                <tr>
                                    <td>{{ $setting->label }}</td>
                                    <td>{{ $setting->name }}</td>
                                    <td>
                                        <a href="{{ route('settings.edit', $setting->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        {{-- delete form --}}
                                        <form method="POST" action="{{ route('settings.destroy', $setting->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                        </form>                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
