<x-app-layout>
    <div class="py-6">
        <div class="text-gray-900 dark:text-gray-100">
            <div class="d-flex justify-content-between">
                <h2 class="text-2xl font-bold text-center mb-6">Report Overview</h2>

                <div class="d-flex flex-row justify-between">
                    <div id="export-buttons"></div>
                </div>

            </div>
            <div id="spinner" class="flex justify-center items-center h-48">
                <!-- You can use any spinner animation you prefer -->
                <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-blue-500"></div>
            </div>
            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto" style="display:none;"
                id="table-wrapper">
                <table id="example" class="display table table-striped table-bordered order-column"
                    style="width:100%;">
                    <thead class="bg-gray-200 text-gray-800 text-sm">
                        <tr>
                            @foreach ($headers as $header)
                                @if (Arr::exists($header, 'sub_headers') && count($header['sub_headers']) > 0)
                                    <th colspan="{{ count($header['sub_headers']) }}" class="header-cell text-center">
                                        {{ $header['label'] }}
                                    </th>
                                @elseif ($header['type'] === 'textarea' || $header['type'] === 'text')
                                    <th colspan="2" class="header-cell text-center">
                                        {{ $header['label'] }}
                                        <i class="fas fa-info-circle header-icon"
                                            data-header="{{ $header['label'] }}"></i>
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

                                @if ($header['type'] === 'textarea' || $header['type'] === 'text')
                                    <th class="text-center">Raw</th>
                                    <th class="text-center">Cleaned</th>
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
                /* Custom class to control input width */
                .custom-input {
                    width: 200px;
                    /* Adjust as needed */
                    box-sizing: border-box;
                    /* Ensure padding and border are included in width */
                }

                .selected {
                    background-color: #e0f7fa;
                    /* Light cyan background for selected rows */
                }
            </style>

            <script>
                $(document).ready(function() {
                    var headers = @json($headers);
                    var columns = [];

                    // Define columns based on headers
                    $.each(headers, function(key, header) {
                        if (header.sub_headers) {
                            $.each(header.sub_headers, function(index, sub_header) {
                                columns.push({
                                    data: function(row) {
                                        return row[header.label];
                                    },
                                    render: function(data, type, row) {
                                        if (Array.isArray(data)) {
                                            return data.includes(sub_header) ? sub_header : '';
                                        } else {
                                            return data === sub_header ? sub_header : '';
                                        }
                                    },
                                    orderable: sub_header !== ''
                                });
                            });
                        } else if (header.type === 'textarea' || header.type === 'text') {
                            columns.push({
                                data: function(row) {
                                    return row[header.label];
                                },
                                render: function(data, type, row) {
                                    let newValue;
                                    if (data !== undefined) {
                                        newValue = '';
                                    }

                                    // Check if data is an object and not null
                                    if (typeof data === 'object' && data !== null) {
                                        console.log(data);

                                        // Assign newValue with the value of the 'value' key in the data object
                                        // If data.value is null, assign an empty string
                                        newValue = data.value === null ? '' : data.value;
                                    } else {
                                        // If data is not an object, handle it appropriately
                                        newValue = data !== null ? data : '';
                                    }


                                    return newValue;
                                },
                                orderable: true,
                            });

                            columns.push({
                                data: function(row) {
                                    return row[header.label];
                                },
                                render: function(data, type, row) {
                                    // Ensure header.cleaning_options is an array, defaulting to an empty array if not
                                    var cleaningOptions = header.cleaning_options ?? [];

                                    // Check if data is an object and not null
                                    var isObject = typeof data === 'object' && data !== null;

                                    // Generate the select input with unique ID attached as a data attribute
                                    var select = '<select class="cleaned-select" ' +
                                        'data-row-id="' + row.entry_id + '" ' +
                                        'data-question-id="' + header.question_id + '">';

                                    // add an option for empty value
                                    select += '<option value="" ' + (!isObject ? 'selected' : '') +
                                        '>Select</option>';

                                    for (var i = 0; i < cleaningOptions.length; i++) {
                                        // Determine if the current option should be selected
                                        var isSelected = (isObject && data.processed ===
                                            cleaningOptions[
                                                i]) || (!isObject && data === cleaningOptions[i]);
                                        // set the first option to select value... and select it if the value is empty



                                        select += '<option value="' + cleaningOptions[i] + '" ' +
                                            (isSelected ? 'selected' : '') +
                                            '>' + cleaningOptions[i] + '</option>';
                                    }

                                    select += '</select>';
                                    return select;
                                },
                                orderable: true,
                            });
                        } else {
                            columns.push({
                                data: function(row) {
                                    return row[header.label];
                                },
                                render: function(data, type, row) {
                                    return data !== undefined ? data : '';
                                },
                                orderable: true,
                            });
                        }
                    });

                    var table = $('#example').DataTable({
                        columnDefs: [{
                            targets: -1,
                            visible: false
                        }],
                        processing: true,
                        serverSide: true,
                        scrollY: 'calc(100vh - 447px)',
                        scrollCollapse: true,
                        scrollX: true,
                        search: {
                            return: true
                        },
                        ajax: {
                            url: '{{ route('reports.data', ['uuid' => $uuid]) }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        },
                        columns: columns,
                        lengthMenu: [50, 100, 150, 200, 300, 400, 500],
                        createdRow: function(row, data, dataIndex) {
                            // Attach the unique ID to the row element
                            $(row).attr('data-row-id', data.entry_id);
                        }
                    });

                    table.columns.adjust().draw();


                    // Export buttons
                    new $.fn.dataTable.Buttons(table, {
                        buttons: [{
                                extend: 'csv',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Response Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'excel',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Response Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'pdf',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Response Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'print',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Response Report"
                            }

                        ]
                    });

                    table.buttons().container().appendTo($('#export-buttons'));

                    // Move the spinner hiding logic here
                    table.on('draw', function() {
                        $('#spinner').hide();
                        $('#table-wrapper').show();
                    });

                    // // Row selection logic
                    // $('#example tbody').on('click', 'tr', function() {
                    //     $(this).toggleClass('selected'); // Toggle the 'selected' class on row click
                    // });

                    // Optional: Capture selected row data
                    $('#example tbody').on('dblclick', 'tr', function() {
                        var data = table.row(this).data(); // Get data for the clicked row
                        console.log(data); // You can process the data as needed
                    });
                    // Change action for select inputs
                    $('#example').on('change', '.cleaned-select', function() {
                        var select = $(this);
                        var rowId = select.data('row-id'); // Get the unique row ID
                        var questionId = select.data('question-id'); // Get the unique question ID
                        var newValue = select.val();
                        $.ajax({
                            url: '/update-cleaned-data',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                entry_id: rowId,
                                question_id: questionId,
                                value: newValue
                            },
                            success: function(response) {
                                if (response.success) {
                                    console.log('Update successful');
                                } else {
                                    console.error('Update failed:', response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Update failed:', error);
                            }
                        });
                    });
                });
            </script>
        @endpush
    </div>
</x-app-layout>
