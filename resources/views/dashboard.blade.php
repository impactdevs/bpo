<x-app-layout>
    <div class="py-6">
        <div id="spinner" class="flex justify-center items-center h-48">
            <!-- You can use any spinner animation you prefer -->
            <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-blue-500"></div>
        </div>

        {{--  --}}
        <div class="content-wrapper" style="display: none;">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $entries }}</h1>
                                <p class="mb-0">Entries</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $registered }}</h1>
                                <p class="mb-0">Registered Entities</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $office_locations }}</h1>
                                <p class="mb-0">Own Offices</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $home_based_locations }}</h1>
                                <p class="mb-0">Home Based</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $male_ceos }}</h1>
                                <p class="mb-0">Male CEOs</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $female_ceos }}</h1>
                                <p class="mb-0">Female CEOs</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div style="width: 50%; margin: auto;">
                                    <canvas id="industrySegmentChart" width="300" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Charts Section -->
            <div class="bg-white dark:bg-gray-800 mt-8 p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Size of Companies</h3>
                {!! $sizeOfCompaniesChart->container() !!}
            </div>

            <div class="bg-white dark:bg-gray-800 mt-8 p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Adoption of Technologies</h3>
                {!! $adoptionOfTechnologiesChart->container() !!}
            </div>

            <div class="bg-white dark:bg-gray-800 mt-8 p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Trends Over Time</h3>
                {!! $trendsOverTimeChart->container() !!}
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                // stop the spinner and shw the content
                $('#spinner').hide();
                $('.content-wrapper').show();


        // Get the labels and data from Laravel
        var labels = @json($labels);
        var data = @json($data);

        // Create the chart
        var ctx = document.getElementById('industrySegmentChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FFCD56',
                        '#4DC0B5'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        offset: -10,
                        borderWidth: 2,
                        borderColor: '#fff',
                        borderRadius: 25,
                        backgroundColor: (context) => context.dataset.backgroundColor,
                        font: {
                            weight: 'bold',
                            size: 16,
                        },
                        formatter: (value, context) => {
                            let total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = ((value / total) * 100).toFixed(2);
                            return `${percentage}`;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
        </script>
    @endpush
    </div>
</x-app-layout>
