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
                <?php echo e(__('Form Builder')); ?> -> <?php echo e(__($form->name)); ?>

            </h2>

            <a href="<?php echo e(route('forms.settings', $form->uuid)); ?>" class="btn btn-primary">
                <i class="bi bi-gear-fill"></i></i> Settings
            </a>
        </div>
     <?php $__env->endSlot(); ?>



    <div class="py-12">
        <?php if($form->sections->isEmpty()): ?>
            <h1>This form has no form fields</h1>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">


                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                    <i class="bi bi-plus"></i> Add section
                </button>

            </div>
        <?php else: ?>

            
            <?php for($i = 0; $i < count($form->sections); $i++): ?>
                <div class="sec-sort">
                    
                    <div class="border border-5 border-primary m-5">
                        
                        <div class="m-2 d-flex flex-row justify-between">
                            <p class="h6">
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#section<?php echo e($i); ?>"
                                    role="button" aria-expanded="false" aria-controls="section<?php echo e($i); ?>">
                                    <?php echo e($i + 1); ?>.<?php echo e($form->sections[$i]->section_name); ?>

                                </a>
                            </p>

                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#editSectionModal"
                                    data-id="<?php echo e($form->sections[$i]->id); ?>"
                                    data-section-name="<?php echo e($form->sections[$i]->section_name); ?>"
                                    data-section-description="<?php echo e($form->sections[$i]->section_description); ?>">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                                <form
                                    action="<?php echo e(route('sections.destroy', ['form' => $form->id, 'section' => $form->sections[$i]->id])); ?>"
                                    method="POST" class="d-inline" id="delete-form-<?php echo e($form->sections[$i]->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="btn btn-outline-danger btn-sm d-flex align-items-center btn-delete"
                                        data-id="<?php echo e($form->sections[$i]->id); ?>">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>

                        </div>

                        
                        <p class="h6">
                            <?php echo e($form->sections[$i]->section_description ?? ''); ?>

                        </p>

                        
                        <?php if($form->sections[$i]->fields->isEmpty()): ?>
                            <div class="m-2">
                                <p>This section has no form fields</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addFieldModal" data-section-id="<?php echo e($form->sections[$i]->id); ?>">
                                    <i class="bi bi-plus"></i> Add a Field
                                </button>

                            </div>
                        <?php else: ?>
                            <div class="sortable">
                                <?php $__currentLoopData = $form->sections[$i]->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $condional_id = null;
                                        $trigger_value = null;
                                        //condional file
                                        if ($field->properties && isset($field->properties[0])) {
                                            $condional_id = $field->properties[0]->conditional_visibility_field_id;

                                            $trigger_value = $field->properties[0]->conditional_visibility_operator;
                                        }
                                    ?>
                                    <div class="form-group question" id="question_<?php echo e($field->id); ?>"
                                        data-radio-field="<?php echo e($condional_id); ?>"
                                        data-trigger-value="<?php echo e($trigger_value); ?>"
                                        style="<?php if($condional_id != null): ?> display:none; <?php endif; ?>">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                                            <div
                                                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                                    <?php if($field->type === 'radio'): ?>
                                                        <div class="mb-3 d-flex flex-row justify-content-between">
                                                            <label for="<?php echo e($field->id); ?>"
                                                                class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                                <?php echo e($field->label); ?></label>
                                                            <div
                                                                class="d-flex justify-content-start align-items-center gap-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editFieldModal" data-mode="edit"
                                                                    data-id="<?php echo e($field->id); ?>"
                                                                    data-label="<?php echo e($field->label); ?>"
                                                                    data-type="<?php echo e($field->type); ?>"
                                                                    data-options="<?php echo e($field->options); ?>">
                                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                                </button>
                                                                <form
                                                                    action="<?php echo e(route('fields.destroy', ['form' => $form->id, 'field' => $field->id])); ?>"
                                                                    method="POST" class="d-inline"
                                                                    id="delete-form-<?php echo e($field->id); ?>">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
                                                                    <button type="submit"
                                                                        class="btn btn-outline-danger btn-sm d-flex align-items-center btn-delete"
                                                                        data-id="<?php echo e($field->id); ?>">
                                                                        <i class="bi bi-trash me-1"></i> Delete
                                                                    </button>
                                                                </form>
                                                                <button
                                                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                                                    type="button" data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasBottom"
                                                                    data-field-id="<?php echo e($field->id); ?>"
                                                                    aria-controls="offcanvasBottom">
                                                                    <i class="bi bi-gear me-1"></i> Properties
                                                                </button>
                                                            </div>


                                                        </div>
                                                        <?php $__currentLoopData = explode(',', $field->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="m-4">
                                                                <input type="<?php echo e($field->type); ?>"
                                                                    id="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                                    name="<?php echo e($field->label); ?>"
                                                                    value="<?php echo e($option); ?>">
                                                                <label for="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                                    class="ml-2"><?php echo e($option); ?></label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php elseif($field->type === 'select'): ?>
                                                        <div class="mb-3 d-flex flex-column justify-content-between">
                                                            <div class="d-flex flex-row justify-content-between">


                                                                <label for="<?php echo e($field->id); ?>"
                                                                    class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                                    <?php echo e($field->label); ?></label>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center gap-2">
                                                                    <button type="button"
                                                                        class="btn btn-outline-primary btn-sm d-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editFieldModal"
                                                                        data-mode="edit"
                                                                        data-id="<?php echo e($field->id); ?>"
                                                                        data-label="<?php echo e($field->label); ?>"
                                                                        data-type="<?php echo e($field->type); ?>"
                                                                        data-options="<?php echo e($field->options); ?>">
                                                                        <i class="bi bi-pencil me-1"></i> Edit
                                                                    </button>
                                                                    <form
                                                                        action="<?php echo e(route('fields.destroy', ['form' => $form->id, 'field' => $field->id])); ?>"
                                                                        method="POST" class="d-inline"
                                                                        id="delete-form-<?php echo e($field->id); ?>">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('DELETE'); ?>
                                                                        <button type="submit"
                                                                            class="btn btn-outline-danger btn-sm d-flex align-items-center btn-delete"
                                                                            data-id="<?php echo e($field->id); ?>">
                                                                            <i class="bi bi-trash me-1"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                    <button
                                                                        class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                                                        type="button" data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasBottom"
                                                                        data-field-id="<?php echo e($field->id); ?>"
                                                                        aria-controls="offcanvasBottom">
                                                                        <i class="bi bi-gear me-1"></i> Properties
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            
                                                            <select name="<?php echo e($field->id); ?>"
                                                                id="<?php echo e($field->id); ?>" class="form-select">
                                                                <option value="">-- Select --</option>
                                                                <?php $__currentLoopData = explode(',', $field->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option); ?>">
                                                                        <?php echo e($option); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    <?php elseif($field->type === 'checkbox'): ?>
                                                        <div class="mb-3 d-flex flex-row justify-content-between">
                                                            <label for="<?php echo e($field->id); ?>"
                                                                class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                                <?php echo e($field->label); ?></label>
                                                            <div
                                                                class="d-flex justify-content-start align-items-center gap-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editFieldModal" data-mode="edit"
                                                                    data-id="<?php echo e($field->id); ?>"
                                                                    data-label="<?php echo e($field->label); ?>"
                                                                    data-type="<?php echo e($field->type); ?>"
                                                                    data-options="<?php echo e($field->options); ?>">
                                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                                </button>
                                                                <form
                                                                    action="<?php echo e(route('fields.destroy', ['form' => $form->id, 'field' => $field->id])); ?>"
                                                                    method="POST" class="d-inline"
                                                                    id="delete-form-<?php echo e($field->id); ?>">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
                                                                    <button type="submit"
                                                                        class="btn btn-outline-danger btn-sm d-flex align-items-center btn-delete"
                                                                        data-id="<?php echo e($field->id); ?>">
                                                                        <i class="bi bi-trash me-1"></i> Delete
                                                                    </button>
                                                                </form>
                                                                <button
                                                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                                                    type="button" data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasBottom"
                                                                    data-field-id="<?php echo e($field->id); ?>"
                                                                    aria-controls="offcanvasBottom">
                                                                    <i class="bi bi-gear me-1"></i> Properties
                                                                </button>
                                                            </div>


                                                        </div>
                                                        <?php $__currentLoopData = explode(',', $field->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="m-4">
                                                                <input type="<?php echo e($field->type); ?>"
                                                                    id="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                                    name="<?php echo e($option); ?>"
                                                                    value="<?php echo e($option); ?>">
                                                                <label for="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                                    class="ml-2"><?php echo e($option); ?></label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php elseif($field->type === 'textarea'): ?>
                                                        <div class="mb-3 d-flex flex-column justify-content-between">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <label for="<?php echo e($field->id); ?>"
                                                                    class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                                    <?php echo e($field->label); ?></label>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center gap-2">
                                                                    <button type="button"
                                                                        class="btn btn-outline-primary btn-sm d-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editFieldModal"
                                                                        data-mode="edit"
                                                                        data-id="<?php echo e($field->id); ?>"
                                                                        data-label="<?php echo e($field->label); ?>"
                                                                        data-type="<?php echo e($field->type); ?>"
                                                                        data-options="<?php echo e($field->options); ?>">
                                                                        <i class="bi bi-pencil me-1"></i> Edit
                                                                    </button>
                                                                    <form
                                                                        action="<?php echo e(route('fields.destroy', ['form' => $form->id, 'field' => $field->id])); ?>"
                                                                        method="POST" class="d-inline"
                                                                        id="delete-form-<?php echo e($field->id); ?>">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('DELETE'); ?>
                                                                        <button type="submit"
                                                                            class="btn btn-outline-danger btn-sm d-flex align-items-center btn-delete"
                                                                            data-id="<?php echo e($field->id); ?>">
                                                                            <i class="bi bi-trash me-1"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                    <button
                                                                        class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                                                        type="button" data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasBottom"
                                                                        data-field-id="<?php echo e($field->id); ?>"
                                                                        aria-controls="offcanvasBottom">
                                                                        <i class="bi bi-gear me-1"></i> Properties
                                                                    </button>
                                                                </div>

                                                            </div>

                                                            <textarea id="<?php echo e($field->id); ?>" name="<?php echo e($field->id); ?>"></textarea>

                                                        </div>
                                                    <?php else: ?>
                                                        <div class="mb-3 d-flex flex-row justify-content-between">
                                                            <label for="<?php echo e($field->id); ?>"
                                                                class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                                <?php echo e($field->label); ?></label>
                                                            <div
                                                                class="d-flex justify-content-start align-items-center gap-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editFieldModal" data-mode="edit"
                                                                    data-id="<?php echo e($field->id); ?>"
                                                                    data-label="<?php echo e($field->label); ?>"
                                                                    data-type="<?php echo e($field->type); ?>"
                                                                    data-options="<?php echo e($field->options); ?>">
                                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                                </button>
                                                                <form
                                                                    action="<?php echo e(route('fields.destroy', ['form' => $form->id, 'field' => $field->id])); ?>"
                                                                    method="POST" class="d-inline"
                                                                    id="delete-form-<?php echo e($field->id); ?>">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
                                                                    <button type="submit"
                                                                        class="btn btn-outline-danger btn-sm d-flex align-items-center btn-delete"
                                                                        data-id="<?php echo e($field->id); ?>">
                                                                        <i class="bi bi-trash me-1"></i> Delete
                                                                    </button>
                                                                </form>
                                                                <button
                                                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                                                    type="button" data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasBottom"
                                                                    data-field-id="<?php echo e($field->id); ?>"
                                                                    aria-controls="offcanvasBottom">
                                                                    <i class="bi bi-gear me-1"></i> Properties
                                                                </button>
                                                            </div>

                                                        </div>
                                                    <?php endif; ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="max-w-7xl
                                mx-auto sm:px-6 lg:px-8 pt-3">
                                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addFieldModal"
                                            data-section-id="<?php echo e($form->sections[$i]->id); ?>">
                                            <i class="bi bi-plus"></i> Add a Field
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endfor; ?>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addSectionModal">
                            <i class="bi bi-plus"></i> Add section
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <?php $__env->startPush('script'); ?>
        <script>
            $(function() {
                $(".sortable").sortable(
                    {
                        stop: function(){
                            console.log("re-arranged.....")
                        }
                    }
                );
                //on dropping sortable item, make an update

                $(".sec-sort").sortable();
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Question Properties</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <form action="<?php echo e(route('fields.add-condition')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="field_id" id="field_id" value="">
            <div class="mb-3">
                <label for="conditional_field">Show this question if the answer to:</label>
                <select name="conditional_visibility_field_id" id="conditional_field" class="form-select">
                    <option value="">-- Select Field --</option>
                    <?php for($i = 0; $i < count($form->sections); $i++): ?>
                        <?php $__currentLoopData = $form->sections[$i]->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($field->type === 'radio'): ?>
                                <option value="<?php echo e($field->id); ?>"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                    <?php echo e($field->label); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="conditional_value">Is equal to:</label>
                <select name="conditional_visibility_operator" id="conditional_value" class="form-select" required>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>




<?php if (isset($component)) { $__componentOriginal3f192fc4f7146d50225d4799f3b9bd41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41 = $attributes; } ?>
<?php $component = App\View\Components\SectionModal::resolve(['form' => $form,'mode' => 'create'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SectionModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41)): ?>
<?php $attributes = $__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41; ?>
<?php unset($__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3f192fc4f7146d50225d4799f3b9bd41)): ?>
<?php $component = $__componentOriginal3f192fc4f7146d50225d4799f3b9bd41; ?>
<?php unset($__componentOriginal3f192fc4f7146d50225d4799f3b9bd41); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal3f192fc4f7146d50225d4799f3b9bd41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41 = $attributes; } ?>
<?php $component = App\View\Components\SectionModal::resolve(['form' => $form,'mode' => 'edit'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SectionModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41)): ?>
<?php $attributes = $__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41; ?>
<?php unset($__attributesOriginal3f192fc4f7146d50225d4799f3b9bd41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3f192fc4f7146d50225d4799f3b9bd41)): ?>
<?php $component = $__componentOriginal3f192fc4f7146d50225d4799f3b9bd41; ?>
<?php unset($__componentOriginal3f192fc4f7146d50225d4799f3b9bd41); ?>
<?php endif; ?>



<?php if (isset($component)) { $__componentOriginalfe7c0430e488c33129251a7e9d61d47c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7c0430e488c33129251a7e9d61d47c = $attributes; } ?>
<?php $component = App\View\Components\FieldModal::resolve(['section' => 1,'mode' => 'create'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('field-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FieldModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfe7c0430e488c33129251a7e9d61d47c)): ?>
<?php $attributes = $__attributesOriginalfe7c0430e488c33129251a7e9d61d47c; ?>
<?php unset($__attributesOriginalfe7c0430e488c33129251a7e9d61d47c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfe7c0430e488c33129251a7e9d61d47c)): ?>
<?php $component = $__componentOriginalfe7c0430e488c33129251a7e9d61d47c; ?>
<?php unset($__componentOriginalfe7c0430e488c33129251a7e9d61d47c); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginalfe7c0430e488c33129251a7e9d61d47c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7c0430e488c33129251a7e9d61d47c = $attributes; } ?>
<?php $component = App\View\Components\FieldModal::resolve(['section' => 1,'mode' => 'edit'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('field-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FieldModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfe7c0430e488c33129251a7e9d61d47c)): ?>
<?php $attributes = $__attributesOriginalfe7c0430e488c33129251a7e9d61d47c; ?>
<?php unset($__attributesOriginalfe7c0430e488c33129251a7e9d61d47c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfe7c0430e488c33129251a7e9d61d47c)): ?>
<?php $component = $__componentOriginalfe7c0430e488c33129251a7e9d61d47c; ?>
<?php unset($__componentOriginalfe7c0430e488c33129251a7e9d61d47c); ?>
<?php endif; ?>
<?php /**PATH D:\bpo\resources\views\forms\show.blade.php ENDPATH**/ ?>