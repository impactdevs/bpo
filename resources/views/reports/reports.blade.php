<x-app-layout>
    <div class="py-3">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-2xl font-bold text-center mb-6">Report Overview</h2>

            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto">
                <table id="example" class="display table table-striped table-bordered" style="width:100%;">
                    <thead class="bg-gray-200 text-gray-800 text-sm">
                        <tr>
                            @foreach ($headers as $header)
                                @if (Arr::exists($header, 'sub_headers'))
                                    <th colspan="{{ count($header['sub_headers']) }}" class="header-cell text-center">
                                        {{ $header['label'] }}
                                    </th>
                                @else
                                    <th class="header-cell text-center">{{ $header['label'] }}</th>
                                @endif
                            @endforeach
                        </tr>
                        <tr class="bg-gray-100">
                            @foreach ($headers as $header)
                                @if (Arr::exists($header, 'sub_headers'))
                                    @foreach ($header['sub_headers'] as $sub_header)
                                        <th class="text-center">{{ $sub_header }}</th>
                                    @endforeach
                                @else
                                    <th></th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <style>
            .table-wrapper {
                overflow-x: auto;
                width: 100%;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 10px;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
            }

            th.header-cell {
                font-weight: bold;
                background-color: #1f2937;
                /* Dark gray */
                color: #ffffff;
                border-bottom: 2px solid #e5e7eb;
            }

            td {
                background-color: #f9fafb;
            }

            table tr:nth-child(even) td {
                background-color: #f1f5f9;
            }

            table tr:hover td {
                background-color: #e5e7eb;
            }
        </style>

        <script>
            $(document).ready(function() {
                // Define columns based on headers
                var headers = @json($headers);
                var columns = [];

                // Prepare columns
                $.each(headers, function(key, header) {
                    if (header.sub_headers) {

                        $.each(header.sub_headers, function(index, sub_header) {
                            columns.push({
                                data: header.label,
                                render: function(data, type, row) {
                                    console.log(data);
                                    //  if sub_header is Male, console.log(data)
                                    // Check if data is an array (for checkboxes) or simply a value (for radio buttons)
                                    if (Array.isArray(data)) {
                                        // For checkboxes, check if the sub_header exists in the array
                                        return data.includes(sub_header) ? sub_header : '';
                                    } else {
                                        // For radio buttons or other simple fields, return the value directly
                                        return data === sub_header ? sub_header : '';
                                    }
                                }
                            });
                        });
                    } else {
                        columns.push({
                            data: header.label,
                            render: function(data, type, row) {
                                // Simply return the data if it's not a subheader-based field
                                return data !== undefined ? data : ''; // Handle missing data
                            }
                        });
                    }
                });

                // Initialize DataTables
                $('#example').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: '{{ route('reports.data', ['uuid' => $uuid]) }}',
                        type: 'POST', // Change GET to POST
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token for POST requests in Laravel
                        }
                    },
                    columns: columns,
                    dom: 'Bfrltip',
                    buttons: [
                        'excel',
                        'pdf'
                    ],
                    pageLength: 15
                });

            });
        </script>
    @endpush
</x-app-layout>
