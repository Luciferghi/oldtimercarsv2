<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo e(trans('admin::messages.Latest Users')); ?></h3>
		
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table no-margin">
				<thead>
				<tr>
					<th class="td-nowrap"><?php echo e(trans('admin::messages.ID')); ?></th>
					<th><?php echo e(trans('admin::messages.Name')); ?></th>
					<th class="td-nowrap"><?php echo e(trans('admin::messages.Country')); ?></th>
					<th class="td-nowrap"><?php echo e(trans('admin::messages.Status')); ?></th>
					<th class="td-nowrap"><?php echo e(trans('admin::messages.Date')); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php if($latestUsers->count() > 0): ?>
					<?php $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td class="td-nowrap"><a href="<?php echo e(admin_url('users/' . $user->id . '/edit')); ?>"><?php echo e($user->id); ?></a></td>
							<td>
								<a href="<?php echo e(admin_url('users/' . $user->id . '/edit')); ?>">
									<?php echo e(\Illuminate\Support\Str::limit($user->name, 70)); ?>

								</a>
							</td>
							<td class="td-nowrap"><?php echo getCountryFlag($user); ?></td>
							<td class="td-nowrap">
								<?php if(isVerifiedUser($user)): ?>
									<span class="label label-success"><?php echo e(trans('admin::messages.Activated')); ?></span>
								<?php else: ?>
									<span class="label label-warning"><?php echo e(trans('admin::messages.Unactivated')); ?></span>
								<?php endif; ?>
							</td>
							<td class="td-nowrap">
								<?php
									try {
										$user->created_at = \Date::parse($user->created_at)->timezone(config('app.timezone'));
									} catch (\Exception $e) {}
								?>
								<div class="sparkbar" data-color="#00a65a" data-height="20">
									<?php echo e($user->created_at->formatLocalized(config('settings.app.default_datetime_format'))); ?>

								</div>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
					<tr>
						<td colspan="5">
							<?php echo e(trans('admin::messages.No users found')); ?>

						</td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix">
		<a href="<?php echo e(admin_url('users')); ?>" class="btn btn-sm btn-default btn-flat pull-right"><?php echo e(trans('admin::messages.View All Users')); ?></a>
	</div>
	<!-- /.box-footer -->
</div>

<?php $__env->startPush('dashboard_styles'); ?>
	<style>
		.td-nowrap {
			width: 10px;
			white-space: nowrap;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('dashboard_scripts'); ?>
<?php $__env->stopPush(); ?>
