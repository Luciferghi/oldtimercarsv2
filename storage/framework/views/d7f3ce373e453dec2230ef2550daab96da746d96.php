<?php if($xPanel->hasAccess('show')): ?>
	<a href="<?php echo e(url($xPanel->route.'/'.$entry->getKey())); ?>" class="btn btn-xs btn-default"><i class="fa fa-eye"></i> <?php echo e(trans('admin::messages.preview')); ?></a>
<?php endif; ?>