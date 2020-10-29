<?php $__env->startSection('search'); ?>
	##parent-placeholder-3559d7accf00360971961ca18989adc0614089c0##
	<?php echo $__env->make('errors/layouts/inc/search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('common.spacer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">

					<div class="col-md-12 page-content">

						<div class="error-page" style="margin: 100px 0;">
							<h2 class="headline text-center" style="font-size: 180px; float: none;"> 500</h2>
							<div class="text-center m-l-0" style="margin-top: 60px;">
								<h3 class="m-t-0"><i class="fa fa-warning"></i> 500 Internal Server Error.</h3>
								<p>
									<?php
									$defaultErrorMessage = "An internal server error has occurred. If the error persists please contact the development team.";
									?>
									<?php echo isset($exception) ? ($exception->getMessage() ? $exception->getMessage() : $defaultErrorMessage) : $defaultErrorMessage; ?>

								</p>
							</div>
						</div>

					</div>

				</div>
			</div>
			
			<?php
				$requirements = [];
				if (!version_compare(PHP_VERSION, '7.1.3', '>=')) {
					$requirements[] = 'PHP 7.1.3 or higher is required.';
				}
				if (!extension_loaded('openssl')) {
					$requirements[] = 'OpenSSL PHP Extension is required.';
				}
				if (!extension_loaded('mbstring')) {
					$requirements[] = 'Mbstring PHP Extension is required.';
				}
				if (!extension_loaded('pdo')) {
					$requirements[] = 'PDO PHP Extension is required.';
				}
				if (!extension_loaded('tokenizer')) {
					$requirements[] = 'Tokenizer PHP Extension is required.';
				}
				if (!extension_loaded('xml')) {
					$requirements[] = 'XML PHP Extension is required.';
				}
				if (!extension_loaded('fileinfo')) {
					$requirements[] = 'PHP Fileinfo Extension is required.';
				}
				if (!(extension_loaded('gd') && function_exists('gd_info'))) {
					$requirements[] = 'PHP GD Library is required.';
				}
			?>
			<?php if(isset($requirements)): ?>
			<div class="row">
				<div class="col-md-12">
					<ul class="installation">
						<?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li>
								<i class="icon-cancel text-danger"></i>
								<h5 class="title-5">
									Error #<?php echo e($key); ?>

								</h5>
								<p>
									<?php echo e($item); ?>

								</p>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>
			
		</div>
	</div>
	<!-- /.main-container -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>