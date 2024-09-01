<x-app-layout>
    <div class="py-6">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="d-flex justify-content-between">
                <h2 class="text-2xl font-bold text-center mb-6">Report Overview</h2>
                <div id="export-buttons"></div>
            </div>
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
                                        // Check if data is an array (for checkboxes) or simply a value (for radio buttons)
                                        if (Array.isArray(data)) {
                                            return data.includes(sub_header) ? sub_header : '';
                                        } else {
                                            return data === sub_header ? sub_header : '';
                                        }
                                    }
                                });
                            });
                        } else {
                            columns.push({
                                data: header.label,
                                render: function(data, type, row) {
                                    return data !== undefined ? data : ''; // Handle missing data
                                }
                            });
                        }
                    });

                    // Initialize DataTables
                    var table = $('#example').DataTable({
                        processing: true,
                        serverSide: true,
                        searching: true,
                        ajax: {
                            url: '{{ route('reports.data', ['uuid' => $uuid]) }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            }
                        },
                        columns: columns,
                        pageLength: 15
                    });


                    new $.fn.dataTable.Buttons(table, {
                        buttons: [{
                            extend: 'collection', // Use a collection button
                            text: 'Export', // Button text

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
                            ], // List of buttons in the dropdown
                            className: 'btn btn-warning dropdown-toggle btn-lg text-white' // Bootstrap button classes
                        }]

                    });

                    // Add the export buttons to the container
                    table.buttons().container().appendTo($('#export-buttons'));
                });
            </script>
        @endpush
</x-app-layout>
