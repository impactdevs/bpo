<a href="<?php echo e(url('entries', $entry->id)); ?>" class="btn btn-link">
    <i class="bi bi-eye"></i>
</a>

<form action="<?php echo e(route('entries.edit', $entry->id)); ?>" method="GET" class="d-inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <input type="hidden" name="form_id" value="<?php echo e($entry->form_id); ?>">
    <button type="submit" class="btn btn-link">
        <i class="bi bi-pencil"></i>
    </button>
</form>

<form action="<?php echo e(route('entries.destroy', $entry->id)); ?>" method="POST" class="d-inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-link">
        <i class="bi bi-trash"></i>
    </button>
</form><?php /**PATH D:\bpo-project\resources\views/entries/actions.blade.php ENDPATH**/ ?>