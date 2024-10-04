<x-app-layout>
    <div class="py-6">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="d-flex justify-content-between">
                <h2 class="text-2xl font-bold text-center">Report Overview</h2>

                <div class="d-flex flex-row justify-between">
                    <div id="export-buttons"></div>
                </div>
            </div>

            <!-- Max Score Toggle -->
            <div class="mb-4">
                <label for="max-score" class="block text-sm font-medium text-gray-700">Max Threshold:</label>
                <input type="range" id="max-score" min="0" max="100" value="{{ $minimum_points }}"
                    class="custom-input" />
                <span id="score-value" class="ml-2">{{ $minimum_points }}</span>
                <span id="count" class="ml-2 font-bold text-lg text-blue-600"></span>
                <!-- Updated styling for count -->
            </div>

            <div class="table-responsive shadow-lg border border-gray-300 rounded-lg" id="table-wrapper">
                <table id="aggregation-table" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="header-cell">Respondent's Organization</th>
                            <th class="header-cell">Do you use specialized software to provide your services</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">If yes, What software platforms and tools are essential for your
                                business operations?</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">Do you do any of the following as part of your business processes?
                            </th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">Do You have any of the following work practices?</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">Are any of your services, processes, data, and platforms broken down
                                into smaller, often disjointed parts?</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">If yes outline examples of how they are broken down</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">Are you registered on any online platform to facilitate trade and
                                enable you to provide your services?</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">If yes, which ones?</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">In the last 4 years, has your staff attended any training aimed at
                                improving skills in outsourcing IT-Enabled Services?</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">If YES, outline the main areas of training attended</th>
                            <th class="header-cell">Score</th>
                            <th class="header-cell">Total Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankingData as $key => $value)
                            <tr>
                                @foreach ($value as $question => $response)
                                    <td class="text-start">
                                        @if (is_array($response))
                                            @foreach ($response as $res)
                                                {{ $res }},
                                            @endforeach
                                        @else
                                            {{ $response }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @push('script')
            <style>
                /* Custom class to control input width */
                .custom-input {
                    width: 100%;
                    margin-top: 8px;
                    cursor: pointer;
                }

                .table-responsive {
                    overflow-x: auto;
                    /* Ensure horizontal scrolling */
                }

                .dataTables_wrapper .dataTables_paginate {
                    justify-content: center;
                    /* Center pagination buttons */
                }

                .dataTables_wrapper .dataTables_length,
                .dataTables_wrapper .dataTables_filter {
                    margin: 1em 0;
                    /* Add some spacing */
                }
            </style>

            <script>
                $(document).ready(function() {
                    var table;

                    function drawTable() {
                        return $('#aggregation-table').DataTable({
                            paging: true,
                            searching: true,
                            ordering: true,
                            scrollY: 'calc(100vh - 530px)',
                            scrollCollapse: true,
                            scrollX: true,
                            //fix the last column
                            fixedColumns: {
                                rightColumns: 1
                            },
                            search: {
                                return: true
                            },
                            lengthMenu: [50, 100, 150, 200, 300, 400, 500],
                            order: [
                                [20, 'desc']
                            ]
                        });
                    }

                    table = drawTable(); // Initial table draw

                    function filterByMaxScore(maxScore) {
                        var count = 0;
                        // Check if the table is already drawn
                        if (table) {
                            table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                                var totalScore = this.data()[21]; // Access the correct index for "Total Score"

                                // Check if the total score is less than the maxScore
                                if (Number(totalScore) < Number(maxScore)) {
                                    this.nodes().to$().hide(); // Hide the row
                                } else {
                                    count++;
                                    this.nodes().to$().show(); // Show the row
                                }
                            });

                            $('#count').text(`${count} entities`); // Update the count

                            // Redraw the table layout
                            table.columns.adjust().responsive
                                .recalc(); // Adjust column widths and recalculate responsive elements
                        }
                    }

                    // Event listener for the slider
                    $('#max-score').on('input', function() {
                        var maxScore = $(this).val();
                        $('#score-value').text(maxScore); // Update displayed score value


                        //update the minimum points with maxScore
                        $.ajax({
                            url: "{{ route('update-minimum-points') }}",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                minimum_points: maxScore,
                            },
                            success: function(response) {
                                console.log(response);
                            }
                        });
                        filterByMaxScore(maxScore); // Call filter function
                    });

                    // Export buttons
                    new $.fn.dataTable.Buttons(table, {
                        buttons: [{
                                extend: 'csv',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Ranking Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'excel',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Ranking Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'pdf',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Ranking Report",
                                orientation: "landscape",
                            },
                            {
                                extend: 'print',
                                className: "btn btn-primary btn-small text-white",
                                messageTop: "Ranking Report"
                            }
                        ]
                    });

                    table.buttons().container().appendTo($('#export-buttons'));

                    // Initial filter
                    filterByMaxScore($('#max-score').val());
                });
            </script>
        @endpush
    </div>
</x-app-layout>
