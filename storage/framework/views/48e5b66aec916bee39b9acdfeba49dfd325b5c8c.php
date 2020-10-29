<?php if($xPanel->hasAccess('create')): ?>
	<a href="<?php echo e(url($xPanel->route.'/create')); ?>" class="btn btn-primary ladda-button" data-style="zoom-in">
		<span class="ladda-label">
            <i class="fa fa-plus"></i> <?php echo e(trans('admin::messages.add')); ?> <?php echo $xPanel->entity_name; ?>

        </span>
    </a>
<?php endif; ?>