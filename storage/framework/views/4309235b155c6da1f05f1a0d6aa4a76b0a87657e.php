<!-- select2 from array -->
<div <?php echo $__env->make('admin::panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
	<label><?php echo $field['label']; ?></label>
	<select
			name="<?php echo e($field['name']); ?><?php if(isset($field['allows_multiple']) && $field['allows_multiple']==true): ?>[]<?php endif; ?>"
			style="width: 100%"
			<?php echo $__env->make('admin::panel.inc.field_attributes', ['default_class' =>  'form-control select2_from_array'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php if(isset($field['allows_multiple']) && $field['allows_multiple']==true): ?>multiple <?php endif; ?>
	>
		
		<?php if(isset($field['allows_null']) && $field['allows_null']==true): ?>
			<option value="">-</option>
		<?php endif; ?>
		
		<?php if(isset($field['options']) && !empty($field['options'])): ?>
			<?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($key); ?>"
						<?php if(isset($field['value']) && ($key==$field['value'] || (is_array($field['value']) && in_array($key, $field['value'])))
							|| ( ! is_null( old($field['name']) ) && old($field['name']) == $key)): ?>
						selected
						<?php endif; ?>
				><?php echo $value; ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</select>
	
	
	<?php if(isset($field['hint'])): ?>
		<p class="help-block"><?php echo $field['hint']; ?></p>
	<?php endif; ?>
</div>




<?php if($xPanel->checkIfFieldIsFirstOfItsType($field, $fields)): ?>
	
	
	<?php $__env->startPush('crud_fields_styles'); ?>
	<!-- include select2 css-->
	<link href="<?php echo e(asset('vendor/adminlte/plugins/select2/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php $__env->stopPush(); ?>
	
	
	<?php $__env->startPush('crud_fields_scripts'); ?>
	<!-- include select2 js-->
	<script src="<?php echo e(asset('vendor/adminlte/plugins/select2/select2.min.js')); ?>"></script>
	<script>
		jQuery(document).ready(function($) {
			// trigger select2 for each untriggered select2 box
			$('.select2_from_array').each(function (i, obj) {
				if (!$(obj).hasClass("select2-hidden-accessible"))
				{
					$(obj).select2({
						theme: "bootstrap"
					});
				}
			});
		});
	</script>
	<?php $__env->stopPush(); ?>

<?php endif; ?>

