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
                        <?php $__currentLoopData = $aggregatedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Count the number of options
                                $isFirstRow = true;
                            ?>

                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($isFirstRow): ?>
                                    <tr>
                                        <td class="text-start" rowspan="<?php echo e(count($options)); ?>"><?php echo e($question); ?></td>
                                        <td class="text-start"><?php echo e($option); ?></td>
                                        <td class="text-start"><?php echo e($count); ?></td>
                                    </tr>
                                    <?php
                                        $isFirstRow = false;
                                    ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-start"><?php echo e($option); ?></td>
                                        <td class="text-start"><?php echo e($count); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            <script>

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
<?php /**PATH D:\bpo\resources\views\reports\aggregations.blade.php ENDPATH**/ ?>