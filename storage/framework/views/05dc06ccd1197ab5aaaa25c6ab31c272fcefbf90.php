<?php $__env->startSection('header'); ?>
    <section class="content-header">
        <h1>
            <?php echo e(trans('admin::messages.edit')); ?> <span class="text-lowercase"><?php echo $xPanel->entity_name; ?></span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(admin_url()); ?>"><?php echo e(trans('admin::messages.dashboard')); ?></a></li>
            <li><a href="<?php echo e(url($xPanel->route)); ?>" class="text-capitalize"><?php echo $xPanel->entity_name_plural; ?></a></li>
            <li class="active"><?php echo e(trans('admin::messages.edit')); ?></li>
        </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Default box -->
            <?php if($xPanel->hasAccess('list')): ?>
                <a href="<?php echo e(url($xPanel->route)); ?>"><i class="fa fa-angle-double-left"></i> <?php echo e(trans('admin::messages.back_to_all')); ?> <span class="text-lowercase"></span></a><br><br>
            <?php endif; ?>

            <?php echo Form::open(array('url' => $xPanel->route.'/'.$entry->getKey(), 'method' => 'put', 'files'=>$xPanel->hasUploadFields('update', $entry->getKey()))); ?>

            <div class="box box-primary">
                <?php if(!in_array($xPanel->getModel()->getTable(), ['settings', 'home_sections', 'domain_settings'])): ?>
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(trans('admin::messages.edit')); ?></h3>
                </div>
				<?php endif; ?>
                <div class="box-body row">
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <?php if(view()->exists('vendor.admin.panel.' . $xPanel->entity_name . '.form_content')): ?>
                        <?php echo $__env->make('vendor.admin.panel.' . $xPanel->entity_name . '.form_content', ['fields' => $xPanel->getFields('update', $entry->getKey())], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif(view()->exists('vendor.admin.panel.form_content')): ?>
                        <?php echo $__env->make('vendor.admin.panel.form_content', ['fields' => $xPanel->getFields('update', $entry->getKey())], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('admin::panel.form_content', ['fields' => $xPanel->getFields('update', $entry->getKey())], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </div><!-- /.box-body -->
                <div class="box-footer">
	
					<?php echo $__env->make('admin::panel.inc.form_save_buttons', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>