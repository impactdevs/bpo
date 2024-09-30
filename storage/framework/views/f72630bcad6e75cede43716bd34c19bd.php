<!-- Modal -->
<?php
    $modalId = ($mode == 'create') ? 'addSectionModal' : 'editSectionModal';
?>
<div class="modal fade" id="<?php echo e($modalId); ?>" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel"><?php echo e($mode == 'create' ? 'Add Section' : 'Edit Section'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('sections.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="section_name" class="form-label">Section Title</label>
                        <input type="text" class="form-control" id="section_name" name="section_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="section_description" class="form-label">Section Description</label>
                        <textarea class="form-control" id="section_description" name="section_description" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="form_id" value="<?php echo e($form->uuid); ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php /**PATH D:\bpo\resources\views\components\section-modal.blade.php ENDPATH**/ ?>