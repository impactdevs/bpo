<x-app-layout>
    <div class="py-6">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="d-flex justify-content-between">
                <h2 class="text-2xl font-bold text-center mb-6">Report Overview</h2>
                <div id="export-buttons"></div>
            </div>
            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto">
                <table id="example" class="display table table-striped table-bordered order-column" style="width:100%;">
                    <thead class="bg-gray-200 text-gray-800 text-sm">
                        <tr>
                            @foreach ($headers as $header)
                                @if (Arr::exists($header, 'sub_headers') && count($header['sub_headers']) > 0)
                                    <th colspan="{{ count($header['sub_headers']) }}" class="header-cell text-center">
                                        {{ $header['label'] }}
                                    </th>
                                @else
                                    <th rowspan="2" class="header-cell text-center">{{ $header['label'] }}</th>
                                @endif
                            @endforeach
                        </tr>
                        <tr class="bg-gray-100">
                            @foreach ($headers as $header)
                                @if (Arr::exists($header, 'sub_headers') && count($header['sub_headers']) > 0)
                                    @foreach ($header['sub_headers'] as $sub_header)
                                        <th class="text-center">{{ $sub_header }}</th>
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        @push('script')
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
                                    data: function(row) {
                                        // Extract the data for this particular column (sub_header)
                                        return row[header.label];
                                    },
                                    render: function(data, type, row) {
                                        if (sub_header === 'Female' || sub_header === 'Male') {
                                            return data === sub_header ? sub_header : '';
                                        }

                                        if (Array.isArray(data)) {
                                            return data.includes(sub_header) ? sub_header : '';
                                        } else {
                                            return data === sub_header ? sub_header : '';
                                        }
                                    },
                                    orderable: sub_header !==
                                        '', // Disable sorting for empty subheaders
                                });
                            });
                        } else {
                            columns.push({
                                data: function(row) {
                                    return row[header.label];
                                },
                                render: function(data, type, row) {
                                    return data !== undefined ? data : '';
                                },
                                orderable: true, // Enable sorting for regular headers
                            });
                        }
                    });

                    // Initialize DataTables
                    var table = $('#example').DataTable({
                        columnDefs: [{
                            targets: -1,
                            visible: false
                        }],
                        processing: true,
                        serverSide: true,
                        searching: true,
                        sorting: true,
                        ajax: {
                            url: '{{ route('reports.data', ['uuid' => $uuid]) }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            }
                        },
                        columns: columns,
                        lengthMenu: [50, 100, 150, 200, 300, 400, 500],
                    });

                    // Export buttons
                    new $.fn.dataTable.Buttons(table, {
                        buttons: [{
                                extend: 'csv',
                                className: "btn btn-warning btn-small text-white",
                                messageTop: "Response Report"
                            },
                            {
                                extend: 'excel',
                                className: "btn btn-warning btn-small text-white",
                                messageTop: "Response Report"
                            },
                            {
                                extend: 'pdf',
                                className: "btn btn-warning btn-small text-white",
                                messageTop: "Response Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'print',
                                className: "btn btn-warning btn-small text-white",
                                messageTop: "Response Report"
                            }
                        ]
                    });

                    // Add the export buttons to the container
                    table.buttons().container().appendTo($('#export-buttons'));
                });
            </script>
        @endpush
</x-app-layout>
