<?php if($xPanel->hasAccess('delete')): ?>
	<a href="<?php echo e(url($xPanel->route.'/'.$entry->getKey())); ?>" class="btn btn-xs btn-danger" data-button-type="delete">
        <i class="fa fa-trash"></i>
		<?php echo e(trans('admin::messages.delete')); ?>

	</a>
<?php endif; ?>