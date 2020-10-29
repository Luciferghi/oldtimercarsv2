<?php if($xPanel->hasAccess('revisions') && count($entry->revisionHistory)): ?>
    <a href="<?php echo e(url($xPanel->route.'/'.$entry->getKey().'/revisions')); ?>" class="btn btn-xs btn-default"><i class="fa fa-history"></i> <?php echo e(trans('admin::messages.revisions')); ?></a>
<?php endif; ?>
