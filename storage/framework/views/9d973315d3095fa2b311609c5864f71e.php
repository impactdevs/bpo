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
    <div class="py-6">
        <div id="spinner" class="flex justify-center items-center h-48">
            <!-- You can use any spinner animation you prefer -->
            <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-blue-500"></div>
        </div>

        
        <div class="content-wrapper" style="display: none;">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($entries); ?></h1>
                                <p class="mb-0">Entries</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($registered); ?></h1>
                                <p class="mb-0">Registered Entities</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($office_locations); ?></h1>
                                <p class="mb-0">Own Offices</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($home_based_locations); ?></h1>
                                <p class="mb-0">Home Based</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($broken); ?></h1>
                                <p class="mb-0">Companies Disjoint processes</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($registered_online); ?></h1>
                                <p class="mb-0">Registered Online</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($male_ceos); ?></h1>
                                <p class="mb-0">Male CEOs</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1"><?php echo e($female_ceos); ?></h1>
                                <p class="mb-0">Female CEOs</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <p>Categorization By Industry Segment</p>
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div style="width: 50%; margin: auto;">
                                    <canvas id="industrySegmentChart" width="300" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <p>Categorization By Size Of the Company</p>
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div style="width: 50%; margin: auto;">
                                    <canvas id="sizeOfTheCompany" width="300" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="col-12 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <p>Categorization By Business Processes</p>
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div style="width: 50%; margin: auto;">
                                    <canvas id="businessProcessChart" width="300" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="col-12 pt-4">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <p>Categorization By Work Practices</p>
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <div style="width: 50%; margin: auto;">
                                    <canvas id="workPracticeChart" width="300" height="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                </div>
            </div>

        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function() {
                // stop the spinner and shw the content
                $('#spinner').hide();
                $('.content-wrapper').show();


                // Get the labels and data from Laravel
                var labels = <?php echo json_encode($labels, 15, 512) ?>;
                var data = <?php echo json_encode($data, 15, 512) ?>;
                var labels2 = <?php echo json_encode($labels2, 15, 512) ?>;
                var data2 = <?php echo json_encode($data2, 15, 512) ?>;
                var labels3 = <?php echo json_encode($labels3, 15, 512) ?>;
                var data3 = <?php echo json_encode($data3, 15, 512) ?>;

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
                        title: {
                            display: true,
                            text: 'Industry Segment'
                        },
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
                                    let total = context.chart.data.datasets[0].data.reduce((a, b) => a + b,
                                        0);
                                    let percentage = ((value / total) * 100).toFixed(2);
                                    return `${percentage}`;
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });


                // Create the chart
                var ctx = document.getElementById('businessProcessChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels2,
                        datasets: [{
                            data: data2,
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
                        title: {
                            display: true,
                            text: 'Business Process'
                        },
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
                                    let total = context.chart.data.datasets[0].data.reduce((a, b) => a + b,
                                        0);
                                    let percentage = ((value / total) * 100).toFixed(2);
                                    return `${percentage}`;
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });

                // work practice
                var ctx = document.getElementById('workPracticeChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels3,
                        datasets: [{
                            data: data3,
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
                        title: {
                            display: true,
                            text: 'Work Practice'
                        },
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
                                    let total = context.chart.data.datasets[0].data.reduce((a, b) => a + b,
                                        0);
                                    let percentage = ((value / total) * 100).toFixed(2);
                                    return `${percentage}`;
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });





                // Make an AJAX request to fetch data
                $.ajax({
                    url: "<?php echo e(route('size_of_the_company')); ?>", // Use the named route for URL
                    method: 'GET',
                    success: function(response) {
                        // Get the labels and data from the response
                        var labels = response.labels;
                        var data = response.data;

                        // Create the chart
                        var ctx = document.getElementById('sizeOfTheCompany').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'doughnut',
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
                                        backgroundColor: (context) => context.dataset
                                            .backgroundColor,
                                        font: {
                                            weight: 'bold',
                                            size: 16,
                                        },
                                        formatter: (value, context) => {
                                            let total = context.chart.data.datasets[0].data
                                                .reduce((a, b) => a + b, 0);
                                            let percentage = ((value / total) * 100).toFixed(2);
                                            return `${percentage}%`;
                                        }
                                    }
                                }
                            },
                            plugins: [ChartDataLabels]
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
    </div>
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