<?php if($xPanel->hasAccess('parent')): ?>
	<a href="<?php echo e(url($xPanel->parent_route)); ?>" class="btn btn-success ladda-button" data-style="zoom-in">
		<span class="ladda-label">
            <i class="fa fa-reply"></i> <?php echo e(trans('admin::messages.go_to')); ?> <?php echo $xPanel->parent_entity_name_plural; ?>

        </span>
    </a>
<?php endif; ?>