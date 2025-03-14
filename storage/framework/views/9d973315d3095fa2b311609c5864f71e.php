<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-4">
        <div id="spinner" class="flex justify-center items-center h-48">
            <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-blue-500"></div>
        </div>
        <div class="content-wrapper" style="display: none;">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex flex-row">
                        <!-- Card Section -->
                        <div class="flex flex-col w-1/3 p-4 space-y-4">
                            <!-- Insights Card -->
                            <div
                                class="insights-card w-full p-6 border rounded-lg shadow-lg bg-blue-100 hover:shadow-2xl transition duration-300">
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">Insights</h2>
                                <p class="text-lg text-gray-600">Some important insights and statistics.</p>
                            </div>
                            <?php $__currentLoopData = [['count' => $entries, 'label' => 'Entries', 'icon' => 'fa-folder'], ['count' => $registered, 'label' => 'Registered Entities', 'icon' => 'fa-users'], ['count' => $office_locations, 'label' => 'Own Offices', 'icon' => 'fa-building'], ['count' => $home_based_locations, 'label' => 'Home Based', 'icon' => 'fa-home'], ['count' => $broken, 'label' => 'Companies Disjoint Processes', 'icon' => 'fa-exclamation-triangle'], ['count' => $registered_online, 'label' => 'Registered Online', 'icon' => 'fa-globe'], ['count' => $male_ceos, 'label' => 'Male CEOs', 'icon' => 'fa-male'], ['count' => $female_ceos, 'label' => 'Female CEOs', 'icon' => 'fa-female']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="card w-full p-4 border rounded-lg shadow-lg bg-gray-100 hover:shadow-2xl transition duration-300 flex items-center">
                                    <i class="fas <?php echo e($card['icon']); ?> fa-2x mr-4 text-blue-500"></i>
                                    <div>
                                        <p class="text-3xl font-bold text-gray-800"><?php echo e($card['count']); ?></p>
                                        <p class="text-lg text-gray-600"><?php echo e($card['label']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Graph Section -->
                        <div class="flex flex-col w-2/3 p-4">
                            <div class="row mb-4">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <figure class="highcharts-figure">
                                            <div id="container6"></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <figure class="highcharts-figure">
                                        <div id="container2"></div>
                                    </figure>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <figure class="highcharts-figure">
                                        <div id="container3"></div>
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <figure class="highcharts-figure">
                                        <div id="container4"></div>
                                    </figure>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <figure class="highcharts-figure">
                                        <div id="container5"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
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

                var labels = <?php echo json_encode($labels, 15, 512) ?>;
                var data = <?php echo json_encode($data, 15, 512) ?>;
                var labels2 = <?php echo json_encode($labels2, 15, 512) ?>;
                var data2 = <?php echo json_encode($data2, 15, 512) ?>;
                var labels3 = <?php echo json_encode($labels3, 15, 512) ?>;
                var data3 = <?php echo json_encode($data3, 15, 512) ?>;
                var data4 = <?php echo json_encode($data4, 15, 512) ?>;
                var labels4 = <?php echo json_encode($labels4, 15, 512) ?>;
                var data5 = <?php echo json_encode($data5, 15, 512) ?>;
                var labels5 = <?php echo json_encode($labels5, 15, 512) ?>;
                var data6 = <?php echo json_encode($data6, 15, 512) ?>;
                var labels6 = <?php echo json_encode($labels6, 15, 512) ?>;

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
                        name: 'Processes',
                        data: labels2.map((label, index) => [label, data2[index]])
                    }]
                });

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
                            neckWidth: '3%',
                            neckHeight: '25%',
                            width: '20%',
                            height: '80%'
                        }
                    },
                    series: [{
                        name: 'Work Practice',
                        data: labels3.map((label, index) => [label, data3[index]])
                    }]
                });

                Highcharts.chart('container4', {
                    chart: {
                        type: 'cylinder',
                        options3d: {
                            enabled: true,
                            alpha: 15,
                            beta: 15,
                            depth: 50,
                            viewDistance: 25
                        }
                    },
                    title: {
                        text: 'Categorization By Main Clients'
                    },
                    xAxis: {
                        categories: labels4,
                        title: {
                            text: 'Clients'
                        },
                        labels: {
                            skew3d: true
                        }
                    },
                    yAxis: {
                        title: {
                            margin: 20,
                            text: 'Number of Clients'
                        },
                        labels: {
                            skew3d: true
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>Clients: {point.x}</b><br>'
                    },
                    plotOptions: {
                        series: {
                            depth: 25,
                            colorByPoint: true,
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b> ({point.y:,.0f})',
                                allowOverlap: true,
                                y: 10
                            }
                        }
                    },
                    series: [{
                        data: data4,
                        name: 'Clients',
                        showInLegend: false
                    }]
                });

                const chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container5',
                        type: 'bar',
                        options3d: {
                            enabled: true,
                            alpha: 15,
                            beta: 15,
                            depth: 50,
                            viewDistance: 50
                        },
                        height: 600, // Set the desired height here
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            enabled: false
                        },
                        max: 1300 // Set a maximum value slightly above your highest data point
                    },
                    tooltip: {
                        headerFormat: '<b>{point.key}</b><br>',
                        pointFormat: 'Number of Employees: {point.y} in {series.name}'
                    },
                    title: {
                        text: 'Academic Qualification of Employees (Management Vs Support Staff)',
                        align: 'center'
                    },
                    legend: {
                        enabled: true // Enable legend
                    },
                    plotOptions: {
                        column: {
                            depth: 15,
                            dataLabels: {
                                enabled: true, // Enable data labels
                                format: '{point.y}' // Display the value
                            }
                        }
                    },
                    series: [{
                            name: 'Management',
                            data: labels5.map((label, index) => [label, data5[index]]),
                            color: '#007bff', // Custom color for Management
                            colorByPoint: false // Disable colorByPoint
                        },
                        {
                            name: 'Support Staff',
                            data: labels6.map((label, index) => [label, data6[index]]),
                            color: '#28a745', // Custom color for Support Staff
                            colorByPoint: false // Disable colorByPoint
                        }
                    ]
                });

            });
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\bpo\resources\views\dashboard.blade.php ENDPATH**/ ?>