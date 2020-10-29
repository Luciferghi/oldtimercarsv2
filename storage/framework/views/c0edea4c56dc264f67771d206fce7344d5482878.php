<?php if(config('settings.app.show_countries_charts')): ?>
<?php
	$usersDataArr = json_decode($usersPerCountry->data, true);
	$countUsersLabels = (isset($usersDataArr['labels']) && is_array($usersDataArr['labels']) && count($usersDataArr['labels']) > 1) ? count($usersDataArr['labels']) : 0;
?>

<?php if($usersPerCountry->countCountries > 1): ?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo e($usersPerCountry->title); ?></h3>
		
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body chart-responsive">
		<?php if($countUsersLabels > 0): ?>
			<canvas id="pieChartUsers"></canvas>
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
		<?php if($usersPerCountry->countCountries > 1): ?>
		<?php if($countUsersLabels > 0): ?>
			<?php
				$usersDisplayLegend = ($countUsersLabels <= 15) ? 'true' : 'false';
			?>
			
			var config = {
				type: 'pie', /* pie, doughnut */
				data: <?php echo $usersPerCountry->data; ?>,
				options: {
					responsive: true,
					legend: {
						display: <?php echo e($usersDisplayLegend); ?>,
						position: 'right'
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
				var ctx = document.getElementById('pieChartUsers').getContext('2d');
				window.myUsersDoughnut = new Chart(ctx, config);
			});
		<?php endif; ?>
		<?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
