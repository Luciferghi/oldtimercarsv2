<div class="row">
	<?php if(isset($countUnactivatedPosts)): ?>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo e($countUnactivatedPosts); ?></h3>
				<p><?php echo e(trans('admin::messages.Unactivated ads')); ?></p>
			</div>
			<div class="icon">
				<i class="fa fa-edit"></i>
			</div>
			<a href="<?php echo e(admin_url('posts?active=0')); ?>" class="small-box-footer">
				<?php echo e(trans('admin::messages.View more')); ?> <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if(isset($countActivatedPosts)): ?>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo e($countActivatedPosts); ?></h3>
				<p><?php echo e(trans('admin::messages.Activated ads')); ?></p>
			</div>
			<div class="icon">
				<i class="fa fa-check-circle-o"></i>
			</div>
			<a href="<?php echo e(admin_url('posts?active=1')); ?>" class="small-box-footer">
				<?php echo e(trans('admin::messages.View more')); ?> <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if(isset($countUsers)): ?>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?php echo e($countUsers); ?></h3>
				<p><?php echo e(mb_ucfirst(trans('admin::messages.users'))); ?></p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="<?php echo e(admin_url('users')); ?>" class="small-box-footer">
				<?php echo e(trans('admin::messages.View more')); ?> <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if(isset($countCountries)): ?>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo e($countCountries); ?></h3>
				<p>
					<?php echo e(trans('admin::messages.Activated countries')); ?>

                    <span class="label label-default tooltipHere"
                          title="" data-placement="bottom" data-toggle="tooltip" type="button"
                          data-original-title="<?php echo trans('admin::messages.To launch your website for several countries you need to activate these countries.') . ' ' . trans('admin::messages.By disabling or removing a country the ads of this country (also) will be deleted.'); ?>">
                        <?php echo e(trans('admin::messages.Help')); ?> <i class="fa fa-support"></i>
                    </span>
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-globe"></i>
			</div>
			<a href="<?php echo e(admin_url('countries')); ?>" class="small-box-footer">
				<?php echo e(trans('admin::messages.View more')); ?> <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<?php endif; ?>
</div>

<?php $__env->startPush('dashboard_styles'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('dashboard_scripts'); ?>
<?php $__env->stopPush(); ?>
