<!-- hidden input -->
<div <?php echo $__env->make('admin::panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
  <input
  	type="hidden"
    name="<?php echo e($field['name']); ?>"
    value="<?php echo e(old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ))); ?>"
    <?php echo $__env->make('admin::panel.inc.field_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  	>
</div>