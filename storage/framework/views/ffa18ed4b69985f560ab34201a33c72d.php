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
                <?php echo e(__('Document Manager')); ?>

            </h2>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUpload"
                aria-controls="offcanvasUpload"><i class="bi bi-upload"></i> Upload Document</button>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Uploaded Date</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(filled($documents)): ?>
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="document-row-<?php echo e($document->id); ?>">
                                        <td><?php echo e($document->created_at?->diffForHumans()); ?></td>
                                        <td><?php echo e($document->name); ?></td>
                                        <td><?php echo e($document->description); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('documents.show', $document->id)); ?>" class="">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="<?php echo e(route('documents.download', $document->id)); ?>" class="">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                            <a href="#" onclick="deleteDocument('<?php echo e($document->id); ?>')" class="">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No documents found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Upload Off-Canvas -->
                    <div class="offcanvas offcanvas-end border" tabindex="-1" id="offcanvasUpload"
                        aria-labelledby="offcanvasUploadLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasUploadLabel">Upload Document</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body small">
                            <form action="<?php echo e(route('documents.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="mb-4">
                                    <label for="document_name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Document
                                        Name</label>
                                    <input type="text" name="description" id="document_name"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label for="document_file"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload
                                        File</label>
                                    <input type="file" name="document" id="document_file"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md transition duration-300 ease-in-out">
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteDocument(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/documents/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                        },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'The document has been deleted.',
                                'success'
                            );

                            // Remove the document row from the table
                            $(`#document-row-${id}`).remove();
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'The document could not be deleted.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

<?php /**PATH D:\bpo\resources\views\documents\index.blade.php ENDPATH**/ ?>