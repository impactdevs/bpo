<x-app-layout>
    <div class="py-6">
        <div id="spinner" class="flex justify-center items-center h-48">
            <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-blue-500"></div>
        </div>

        <div class="content-wrapper" style="display: none;">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                    @foreach ([['count' => $entries, 'label' => 'Entries'], ['count' => $registered, 'label' => 'Registered Entities'], ['count' => $office_locations, 'label' => 'Own Offices'], ['count' => $home_based_locations, 'label' => 'Home Based'], ['count' => $broken, 'label' => 'Companies Disjoint Processes'], ['count' => $registered_online, 'label' => 'Registered Online'], ['count' => $male_ceos, 'label' => 'Male CEOs'], ['count' => $female_ceos, 'label' => 'Female CEOs']] as $card)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 text-center bg-light shadow-sm">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="h1">{{ $card['count'] }}</h1>
                                    <p class="mb-0">{{ $card['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12 pt-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                </figure>
                            </div>

                            <div class="col-md-6 mb-4">
                                <figure class="highcharts-figure">
                                    <div id="container2"></div>
                                </figure>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pt-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <figure class="highcharts-figure">
                                    <div id="container3"></div>
                                </figure>
                                <div class="col-md-6 mb-4">
                                    <figure class="highcharts-figure">
                                        <div id="container4"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/cylinder.js"></script>
        <script src="https://code.highcharts.com/modules/funnel3d.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script>
            $(document).ready(function() {

                $('#spinner').hide();
                $('.content-wrapper').show();

                var labels = @json($labels);
                var data = @json($data);
                var labels2 = @json($labels2);
                var data2 = @json($data2);
                var labels3 = @json($labels3);
                var data3 = @json($data3);


                Highcharts.chart('container', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: 'Categorization By Industry Segment',
                        align: 'center'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Share',
                        data: labels.map((label, index) => [label, data[index]])
                    }]
                });



                Highcharts.chart('container2', {
                    chart: {
                        type: 'cylinder',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: 'Categorization By Business Process',
                        align: 'center'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 100,
                            depth: 45
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Share',
                        data: labels2.map((label, index) => [label, data2[index]])
                    }]
                });
                // Set up the chart
                Highcharts.chart('container3', {
                    chart: {
                        type: 'funnel3d',
                        options3d: {
                            enabled: true,
                            alpha: 10,
                            depth: 50,
                            viewDistance: 50
                        }
                    },
                    title: {
                        text: 'Categorization By Work Practice'
                    },
                    accessibility: {
                        screenReaderSection: {
                            beforeChartFormat: '<{headingTagName}>' +
                                '{chartTitle}</{headingTagName}><div>{typeDescription}</div>' +
                                '<div>{chartSubtitle}</div><div>{chartLongdesc}</div>'
                        }
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b> ({point.y:,.0f})',
                                allowOverlap: true,
                                y: 10
                            },
                            neckWidth: '30%',
                            neckHeight: '25%',
                            width: '80%',
                            height: '80%'
                        }
                    },
                    series: [{
                        name: 'Work Practice',
                        data:labels3.map((label, index) => [label, data3[index]])
                    }]
                });

            });
        </script>
    @endpush
</x-app-layout>
