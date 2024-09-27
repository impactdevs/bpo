
<div class="form-group">
    <label for="form_field_id" class="control-label"><?php echo e('Question'); ?></label>
    <select class="form-control shadow-none" name="form_field_id" id="form_field_id">
        <?php $__currentLoopData = $form_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($value->id); ?>" <?php echo e((isset($currentItem) && $currentItem->form_field_id == $value->id) ? 'selected' : ''); ?>>
                <?php echo e($value->label); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group">
    <label for="name" class="control-label"><?php echo e('Option'); ?></label>
    <input class="form-control shadow-none" name="name" type="text" id="name" value="<?php echo e(isset($currentItem) ? $currentItem->name : ''); ?>">
</div>

<div class="form-group m-3">
    <input class="btn btn-primary" type="submit" value="<?php echo e($formMode === 'edit' ? 'Update' : 'Create'); ?>">
</div>
<?php /**PATH D:\bpo\resources\views\settings\form.blade.php ENDPATH**/ ?>