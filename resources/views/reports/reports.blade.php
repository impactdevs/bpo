<x-app-layout>
    <div class="py-3">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-2xl font-bold text-center mb-6">Report Overview</h2>

            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto">
                <table id="example" class="display table table-striped table-bordered"
                    style="width:max-content; min-width: 100%;">
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
                    <tbody>
                        @foreach ($entries as $entry)
                            <tr>
                                @foreach ($headers as $header)
                                    @if (Arr::exists($header, 'sub_headers'))
                                        @foreach ($header['sub_headers'] as $sub_header)
                                            @php
                                                $response = $entry->formatted_responses[$header['label']] ?? null;
                                                $processed_response = is_array($response) ? $response[0] : $response;
                                                $cell_content =
                                                    $processed_response == trim($sub_header) ? $processed_response : '';
                                            @endphp
                                            <td class="text-center">{{ $cell_content }}</td>
                                        @endforeach
                                    @else
                                        @php
                                            $response = $entry->formatted_responses[$header['label']] ?? null;
                                            $cell_content = is_array($response) ? '' : $response;
                                        @endphp
                                        <td class="text-center">{{ $cell_content }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper mt-4">
                    {!! $entries->appends(['search' => Request::get('search')])->render() !!}
                </div>
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
                width: max-content;
                min-width: 100%;
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

            .pagination-wrapper {
                display: flex;
                justify-content: center;
                padding: 20px 0;
            }
        </style>
    @endpush
</x-app-layout>
