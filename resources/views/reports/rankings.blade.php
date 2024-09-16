<x-app-layout>
    <div class="py-6">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="">
                <h2 class="text-2xl font-bold text-center mb-6">Rankings for BPOs</h2>

            </div>
            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto" id="table-wrapper">
                <table id="aggregation-table" data-toggle="table" class="" data-pagination="true" data-search="true"
                    data-show-export="true" data-show-columns-toggle-all="true"   data-show-columns="true"  data-click-to-select="true" data-detail-formatter="detailFormatter"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="organization" class="bg-primary text-light">Respondent's Organization</th>
                            <th data-sortable="true" class="bg-primary text-light">Do you use specialized software to provide your services</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">If yes, What software platforms and tools are essential for your
                                business operations?
                                (e.g., CRM, ERP, Project Management Tools):</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">Do you do any of the following as part of your business
                                processes(Tick)</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">Do You have any of the following work practices?</th>
                            <th data-sortable="true">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">Are any of your services , processes, data, and platforms broken
                                down into smaller,
                                often disjointed parts.</th>
                            <th data-sortable="true">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">If yes outline examples of how they are broken down (i.e
                                accounting, training, IT
                                Section)</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">Are you registered on any online platform to facilitate trade and
                                enable you provide
                                your services</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">If yes, which ones(check):</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">In the last 4 years, has your staff attended any training aimed at
                                improving skills in
                                outsourcing IT-Enabled Services?</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">If YES, outline the main areas of training attended</th>
                            <th data-sortable="true" class="bg-primary text-light">Score</th>
                            <th data-sortable="true" class="bg-primary text-light">Total Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankingData as $key => $value)
                            <tr>
                                @foreach ($value as $question => $response)
                                    {{-- check if response is an array --}}
                                    @if (is_array($response))
                                        <td class="text-start">

                                            @foreach ($response as $res)
                                                {{ $res }},
                                            @endforeach
                                        </td>
                                    @else
                                        <td class="text-start" style="width: 100px;">{{ $response }}</td>
                                    @endif
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
                    width: 200px;
                    /* Adjust as needed */
                    box-sizing: border-box;
                    /* Ensure padding and border are included in width */
                }

                .table-wrapper {
                    table-layout: fixed;
                }
            </style>
        @endpush
    </div>
</x-app-layout>
