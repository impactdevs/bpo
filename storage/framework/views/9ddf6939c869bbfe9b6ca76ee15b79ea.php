 <div class="py-12">
     <?php if($form->sections->isEmpty()): ?>
         <h1>This form has no form fields</h1>
     <?php else: ?>
         
         <?php for($i = 0; $i < count($form->sections); $i++): ?>
             
             <?php if(isset($user)): ?>
                 <input type="hidden" name="user_id" value="<?php echo e($user); ?>">
             <?php endif; ?>
             
             <div class="row">
                 <div class="border border-5 border-primary col-12">
                     
                     <div class="m-2 d-flex flex-row justify-between">
                         <p class="h6">
                             <a class="btn btn-primary" data-bs-toggle="collapse" href="#section<?php echo e($i); ?>"
                                 role="button" aria-expanded="false" aria-controls="section<?php echo e($i); ?>">
                                 <?php echo e($i + 1); ?>.<?php echo e($form->sections[$i]->section_name); ?>

                             </a>
                         </p>
                     </div>

                     
                     <p class="h6">
                         <?php echo e($form->sections[$i]->section_description ?? ''); ?>

                     </p>

                     
                     <?php if($form->sections[$i]->fields->isEmpty()): ?>
                         <div class="m-2">
                             <p>This section has no form fields</p>
                         </div>
                     <?php else: ?>
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
                                 data-radio-field="<?php echo e($condional_id); ?>" data-trigger-value="<?php echo e($trigger_value); ?>"
                                 style="<?php if($condional_id != null): ?> display:none; <?php endif; ?>">
                                 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
                                     <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                         <div class="p-6 text-gray-900 dark:text-gray-100">
                                             <?php if($field->type === 'radio'): ?>
                                                 <div class="mb-3 d-flex flex-column justify-content-between">
                                                     <label for="<?php echo e($field->id); ?>"
                                                         class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                         <?php echo e($field->label); ?></label>

                                                 </div>
                                                 <?php $__currentLoopData = explode(',', $field->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <div class="m-4">
                                                         <input type="<?php echo e($field->type); ?>"
                                                             id="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                             name="<?php echo e($field->id); ?>" value="<?php echo e($option); ?>">
                                                         <label for="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                             class="ml-2"><?php echo e($option); ?></label>
                                                     </div>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             <?php elseif($field->type === 'checkbox'): ?>
                                                 <div class="mb-3 d-flex flex-column justify-content-between">
                                                     <label for="<?php echo e($field->id); ?>"
                                                         class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                         <?php echo e($field->label); ?></label>
                                                 </div>
                                                 <?php $__currentLoopData = explode(',', $field->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <div class="m-4">
                                                         <input type="<?php echo e($field->type); ?>"
                                                             id="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                             name="<?php echo e($field->id); ?>[]" value="<?php echo e($option); ?>">
                                                         <label for="<?php echo e($field->id); ?>_<?php echo e($loop->index); ?>"
                                                             class="ml-2"><?php echo e($option); ?></label>
                                                     </div>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             <?php elseif($field->type === 'select'): ?>
                                                 <div class="mb-3 d-flex flex-column justify-content-between">
                                                     <label for="<?php echo e($field->id); ?>"
                                                         class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                         <?php echo e($field->label); ?></label>

                                                     
                                                     <select name="<?php echo e($field->id); ?>" id="<?php echo e($field->id); ?>"
                                                         class="form-select">
                                                         <option value="">-- Select --</option>
                                                         <?php $__currentLoopData = explode(',', $field->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                             <option value="<?php echo e($option); ?>"><?php echo e($option); ?>

                                                             </option>
                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     </select>
                                                 </div>
                                             <?php elseif($field->type === 'textarea'): ?>
                                                 <div class="mb-3 d-flex flex-column justify-content-between">
                                                     <div class="d-flex justify-content-between mb-2">
                                                         <label for="<?php echo e($field->id); ?>"
                                                             class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                             <?php echo e($field->label); ?></label>
                                                     </div>

                                                     <textarea id="<?php echo e($field->id); ?>" name="<?php echo e($field->id); ?>" rows="15"
                                                         placeholder="The responses here should be comma separated"></textarea>

                                                 </div>
                                             <?php else: ?>
                                                 <div class="mb-3 d-flex flex-column justify-content-between">
                                                     <label for="<?php echo e($field->id); ?>"
                                                         class="form-label"><?php echo e($i + 1); ?>.<?php echo e($key + 1); ?>.
                                                         <?php echo e($field->label); ?></label>
                                                     <input type="<?php echo e($field->type); ?>" id="<?php echo e($field->id); ?>"
                                                         name="<?php echo e($field->id); ?>" class="form-control w-75 ms-2">
                                                 </div>
                                             <?php endif; ?>


                                         </div>
                                     </div>
                                 </div>
                             </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                 </div>
             </div>
 </div>
 <?php endfor; ?>
 
 <input type="hidden" name="form_id" value="<?php echo e($form->uuid); ?>">
 
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-3">
     <div class="d-flex justify-content-center">
         <div class="form-group me-5">
             <button class="btn btn-primary" type="submit" name="action" value="submit">
                 <?php echo e($formMode === 'edit' ? 'Update' : 'Submit'); ?>

             </button>
         </div>

         
     </div>
     <?php endif; ?>

 </div>
<?php /**PATH D:\bpo\resources\views\entries\form.blade.php ENDPATH**/ ?>