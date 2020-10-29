<?php if($xPanel->reorder): ?>
	<?php if($xPanel->hasAccess('reorder')): ?>
	  <a href="<?php echo e(url($xPanel->route.'/reorder')); ?>" class="btn btn-default ladda-button" data-style="zoom-in">
		  <span class="ladda-label">
              <i class="fa fa-arrows"></i> <?php echo e(trans('admin::messages.reorder')); ?> <?php echo $xPanel->entity_name_plural; ?>

          </span>
      </a>
	<?php endif; ?>
<?php endif; ?>