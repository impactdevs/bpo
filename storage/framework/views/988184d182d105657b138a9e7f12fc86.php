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
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="">
                <h2 class="text-2xl font-bold text-center mb-6">Rankings for BPOs</h2>

            </div>
            <div class="table-wrapper shadow-lg border border-gray-300 rounded-lg overflow-x-auto" id="table-wrapper">
                <table id="aggregation-table" data-toggle="table" class="" data-pagination="true" data-search="true"
                    data-show-export="true" data-show-columns-toggle-all="true"   data-show-columns="true"  data-click-to-select="true" data-detail-formatter="detailFormatter"
                    data-page-list="[10, 25, 50, 100, 200, 500, all]" style="width:100%;">
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
                        <?php $__currentLoopData = $rankingData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question => $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php if(is_array($response)): ?>
                                        <td class="text-start">

                                            <?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($res); ?>,
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                    <?php else: ?>
                                        <td class="text-start" style="width: 100px;"><?php echo e($response); ?></td>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>

        <?php $__env->startPush('script'); ?>
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
<?php /**PATH D:\bpo\resources\views/reports/rankings.blade.php ENDPATH**/ ?>