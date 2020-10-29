<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo e($latestUsersChart->title); ?></h3>
		
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body chart-responsive">
		<div class="chart" id="barChartUsers" style="height: 300px;"></div>
	</div>
</div>

<?php $__env->startPush('dashboard_styles'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('dashboard_scripts'); ?>
    <script>
        $(function () {
            "use strict";
        
            // USERS STATS
            var area = new Morris.Bar({
                element: 'barChartUsers',
                resize: true,
                data: <?php echo $latestUsersChart->data; ?>,
                xkey: 'y',
                ykeys: ['activated', 'unactivated'],
                labels: ['<?php echo e(trans('admin::messages.Activated')); ?>', '<?php echo e(trans('admin::messages.Unactivated')); ?>'],
                lineColors: ['#3c8dbc', '#a0d0e0'],
                hideHover: 'auto',
                parseTime: false
            });
        });
    </script>
<?php $__env->stopPush(); ?>
