<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Manager') }}
            </h2>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUpload"
                aria-controls="offcanvasUpload">
                <i class="bi bi-upload"></i> Upload Data
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Table to display document data -->
                    <table id="data-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Location</th>
                                <th>Position</th>
                                <th>Employer</th>
                                <th>Office Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentData as $data)
                                <tr>
                                    <td>{{ $data->name ?? 'N/A' }}</td>
                                    <td>{{ $data->company ?? 'N/A' }}</td>
                                    <td>{{ $data->email ?? 'N/A' }}</td>
                                    <td>{{ $data->contact ?? 'N/A' }}</td>
                                    <td>{{ $data->location ?? 'N/A' }}</td>
                                    <td>{{ $data->position ?? 'N/A' }}</td>
                                    <td>{{ $data->employer ?? 'N/A' }}</td>
                                    <td>{{ $data->office_number ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Off-canvas Upload Form -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUpload" aria-labelledby="offcanvasUploadLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasUploadLabel">Upload Document Data</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('documents.import', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Select Excel File</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-success"><i class="bi bi-cloud-arrow-up"></i> Upload</button>
            </form>
        </div>
    </div>


</x-app-layout>


<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<!-- Include jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Include DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<!-- Include DataTables initialization script -->
<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });

    $('#data-table').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "pageLength": 10
    });
</script>
