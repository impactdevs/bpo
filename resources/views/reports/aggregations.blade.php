<x-app-layout>
    <div class="py-6">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="">
                <h2 class="text-2xl font-bold text-center mb-6">Aggregation Report Overview</h2>

            </div>
            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto" id="table-wrapper">
                <table data-toggle="table" data-search="true" data-show-export="true" class="display table table-striped table-bordered order-column" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Option</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aggregatedData as $question => $options)
                            @php
                                // Count the number of options
                                $isFirstRow = true;
                            @endphp

                            @foreach ($options as $option => $count)
                                @if ($isFirstRow)
                                    <tr>
                                        <td class="text-start" rowspan="{{ count($options) }}">{{ $question }}</td>
                                        <td class="text-start">{{ $option }}</td>
                                        <td class="text-start">{{ $count }}</td>
                                    </tr>
                                    @php
                                        $isFirstRow = false;
                                    @endphp
                                @else
                                    <tr>
                                        <td class="text-start">{{ $option }}</td>
                                        <td class="text-start">{{ $count }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
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

                .table-wrapper {
                    table-layout: fixed;
                }
            </style>

            <script>

            </script>
        @endpush
    </div>
</x-app-layout>
