<?php $__env->startSection('header'); ?>
	<section class="content-header">
		<h1>
			<?php echo e(trans('admin::messages.dashboard')); ?>

			<small><?php echo e(trans('admin::messages.first_page_you_see', ['app_name' => config('app.name'), 'app_version' => config('app.version')])); ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(admin_url()); ?>"><?php echo e(config('app.name')); ?></a></li>
			<li class="active"><?php echo e(trans('admin::messages.dashboard')); ?></li>
		</ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
        
			<!-- Small Boxes (Stats Boxes) -->
			<?php echo $__env->make('admin::dashboard.inc.stats-boxes', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
			<div class="row">
				<!-- Left Col -->
				<section class="col-lg-6 connectedSortable">
					
					<?php echo $__env->make('admin::dashboard.inc.charts.morris.' . config('settings.app.dashboard_latest_entries_chart', 'bar') . '.latest-posts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
					
					<?php echo $__env->make('admin::dashboard.inc.latest-posts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
					
					<?php echo $__env->make('admin::dashboard.inc.charts.chartjs.pie.posts-per-country', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</section>
				
				<!-- Right Col -->
				<section class="col-lg-6 connectedSortable">
					
					<?php echo $__env->make('admin::dashboard.inc.charts.morris.' . config('settings.app.dashboard_latest_entries_chart', 'bar') . '.latest-users', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
					
					<?php echo $__env->make('admin::dashboard.inc.latest-users', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
					
					<?php echo $__env->make('admin::dashboard.inc.charts.chartjs.pie.users-per-country', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</section>
			</div>
			
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('after_styles'); ?>
	<?php /*<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">*/ ?>
	<link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/plugins/morris/0.5.1/morris.css">
	
	<!-- DASHBOARD LIST CONTENT - dashboard_styles stack -->
	<?php echo $__env->yieldPushContent('dashboard_styles'); ?>
	
	<style>
		/* Bootstrap tooltip need to be in single line */
		.tooltip-inner {
			white-space: nowrap;
			max-width: none;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="<?php echo e(asset('vendor/adminlte')); ?>/plugins/morris/morris.min.js"></script>
	<script src="<?php echo e(asset('vendor/adminlte')); ?>/plugins/chartjs/2.7.2/Chart.js"></script>
	
	<!-- DASHBOARD LIST CONTENT - dashboard_scripts stack -->
	<?php echo $__env->yieldPushContent('dashboard_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>