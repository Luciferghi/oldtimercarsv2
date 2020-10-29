<!-- configurable color picker -->
<div <?php echo $__env->make('admin::panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <div class="input-group colorpicker-component">

        <input
        	type="text"
        	name="<?php echo e($field['name']); ?>"
            value="<?php echo e(old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ))); ?>"
            <?php echo $__env->make('admin::panel.inc.field_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	>
        <div class="input-group-addon">
            <i class="color-preview-<?php echo e($field['name']); ?>"></i>
        </div>
    </div>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>




<?php if($xPanel->checkIfFieldIsFirstOfItsType($field, $fields)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.5/css/bootstrap-colorpicker.min.css" />
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.5/js/bootstrap-colorpicker.min.js"></script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>

<?php $__env->startPush('crud_fields_scripts'); ?>
<script type="text/javascript">
    jQuery('document').ready(function($){
        //https://itsjaviaguilar.com/bootstrap-colorpicker/
        var config = jQuery.extend({}, <?php echo isset($field['color_picker_options']) ? json_encode($field['color_picker_options']) : '{}'; ?>);
        var picker = $('[name="<?php echo e($field['name']); ?>"]').parents('.colorpicker-component').colorpicker(config);
        $('[name="<?php echo e($field['name']); ?>"]').on('focus', function(){
            picker.colorpicker('show');
        });
    })
</script>
<?php $__env->stopPush(); ?>



