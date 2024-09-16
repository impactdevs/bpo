<x-app-layout>
    <div class="py-6">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="">
                <h2 class="text-2xl font-bold text-center mb-6">Rankings for BPOs</h2>

            </div>
            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto" id="table-wrapper">
                <table id="aggregation-table" class="display table table-striped table-bordered order-column"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th>Respondent's Organization</th>
                            <th>Do you use specialized software to provide your services</th>
                            <th>Score</th>
                            <th>If yes, What software platforms and tools are essential for your business operations?
                                (e.g., CRM, ERP, Project Management Tools):</th>
                            <th>Score</th>
                            <th>Do you do any of the following as part of your business processes(Tick)</th>
                            <th>Score</th>
                            <th>Do You have any of the following work practices?</th>
                            <th>Score</th>
                            <th>Are any of your services , processes, data, and platforms broken down into smaller,
                                often disjointed parts.</th>
                            <th>Score</th>
                            <th>If yes outline examples of how they are broken down (i.e accounting, training, IT
                                Section)</th>
                            <th>Score</th>
                            <th>Are you registered on any online platform to facilitate trade and enable you provide
                                your services</th>
                            <th>Score</th>
                            <th>If yes, which ones(check):</th>
                            <th>Score</th>
                            <th>In the last 4 years, has your staff attended any training aimed at improving skills in
                                outsourcing IT-Enabled Services?</th>
                            <th>Score</th>
                            <th>If YES, outline the main areas of training attended</th>
                            <th>Score</th>
                            <th>Total Score</th>
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

            <script></script>
        @endpush
    </div>
</x-app-layout>
