<?php if(config('settings.app.show_countries_charts')): ?>
<?php
	$postsDataArr = json_decode($postsPerCountry->data, true);
	$countPostsLabels = (isset($postsDataArr['labels']) && is_array($postsDataArr['labels']) && count($postsDataArr['labels']) > 1) ? count($postsDataArr['labels']) : 0;
?>

<?php if($postsPerCountry->countCountries > 1): ?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo e($postsPerCountry->title); ?></h3>
		
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body chart-responsive">
		<?php if($countPostsLabels > 0): ?>
			<canvas id="pieChartPosts"></canvas>
		<?php else: ?>
			<?php echo trans('admin::messages.No data found.'); ?>

		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php $__env->startPush('dashboard_styles'); ?>
	<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('dashboard_scripts'); ?>
	<script>
		<?php if($postsPerCountry->countCountries > 1): ?>
		<?php if($countPostsLabels > 0): ?>
			<?php
				$postsDisplayLegend = ($countPostsLabels <= 15) ? 'true' : 'false';
			?>
			
			var config1 = {
				type: 'pie', /* pie, doughnut */
				data: <?php echo $postsPerCountry->data; ?>,
				options: {
					responsive: true,
					legend: {
						display: <?php echo e($postsDisplayLegend); ?>,
						position: 'left'
					},
					title: {
						display: false
					},
					animation: {
						animateScale: true,
						animateRotate: true
					}
				}
			};
			
			$(function () {
				var ctx = document.getElementById('pieChartPosts').getContext('2d');
				window.myPostsDoughnut = new Chart(ctx, config1);
			});
		<?php endif; ?>
		<?php endif; ?>
	</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
