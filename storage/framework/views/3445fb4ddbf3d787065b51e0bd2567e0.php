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
     <?php $__env->slot('header', null, []); ?> 
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <?php echo e(__('List of submitted entries')); ?>

            </h2>

            

        </div>
     <?php $__env->endSlot(); ?>
    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="entriesTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Sub title</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(filled($entries)): ?>
                                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($entry->id); ?></th>
                                        <td><?php echo e($entry->title); ?></td>
                                        <td><?php echo e($entry->subtitle); ?></td>
                                        <td><?php echo e($entry->user->name ?? 'Unknown User'); ?></td>
                                        <td><?php echo e($entry->created_at->format('M d, Y')); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('entries', $entry->id)); ?>" class="">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            
                                            <form action="<?php echo e(route('entries.edit', $entry->id)); ?>" method="GET"
                                                class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                
                                                <input type="hidden" name="form_id" value="<?php echo e($entry->form_id); ?>">
                                                <button type="submit" class="btn btn-link">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('script'); ?>
        <!-- Initialize DataTable -->
        <script>
            $(document).ready(function() {
                $('#entriesTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "lengthChange": true, // Ensure the length menu is shown
                    "lengthMenu": [10, 20, 30, 40, 50, 60, 70], // Define options for number of entries to show
                    // Export buttons
                    dom: "Bflrtip",
                    // Style the buttons
                    buttons: [{
                            extend: "csv",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Comments about Arrears",
                        },
                        {
                            extend: "excel",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Comments about Arrears",
                        },
                        {
                            extend: "pdf",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Comments about Arrears",
                            customize: function(doc) {
                                doc.styles.tableHeader.fillColor = '#FFA500';
                            }
                        },
                        {
                            extend: "print",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Comments about Arrears",
                        },
                    ],
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
<?php /**PATH D:\bpo\resources\views\entries\entries.blade.php ENDPATH**/ ?>