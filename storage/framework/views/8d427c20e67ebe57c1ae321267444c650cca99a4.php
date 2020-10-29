<?php
$advertising = \App\Models\Advertising::where('slug', 'bottom')->first();
?>
<?php if(!empty($advertising)): ?>
	<?php echo $__env->make('home.inc.spacer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="container">
		
		<div class="container mb20 ads-parent-responsive d-none d-xl-block d-lg-block d-md-none d-sm-none">
			<div class="text-center">
				<?php echo $advertising->tracking_code_large; ?>

			</div>
		</div>
		
		<div class="container mb20 ads-parent-responsive d-none d-xl-none d-lg-none d-md-block d-sm-none">
			<div class="text-center">
				<?php echo $advertising->tracking_code_medium; ?>

			</div>
		</div>
		
		<div class="container ads-parent-responsive d-block d-xl-none d-lg-none d-md-none d-sm-block">
			<div class="text-center">
				<?php echo $advertising->tracking_code_small; ?>

			</div>
		</div>
	</div>
<?php endif; ?>