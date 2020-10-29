<div class="container">
	<nav aria-label="breadcrumb" role="navigation" class="search-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo e(lurl('/')); ?>"><i class="icon-home fa"></i></a></li>
			<li class="breadcrumb-item">
				<?php $attr = ['countryCode' => config('country.icode')]; ?>
				<a href="<?php echo e(lurl(trans('routes.v-search', $attr), $attr)); ?>">
					<?php echo e(config('country.name')); ?>

				</a>
			</li>
			<?php if(isset($bcTab) and count($bcTab) > 0): ?>
				<?php $__currentLoopData = $bcTab; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $value = collect($value); ?>
					<?php if($value->has('position') and $value->get('position') > count($bcTab)+1): ?>
						<li class="breadcrumb-item active">
							<?php echo $value->get('name'); ?>

							&nbsp;
							<?php if(isset($city) or isset($admin)): ?>
								<a href="#browseAdminCities" id="dropdownMenu1" data-toggle="modal"> <span class="caret"></span></a>
							<?php endif; ?>
						</li>
					<?php else: ?>
						<li class="breadcrumb-item"><a href="<?php echo e($value->get('url')); ?>"><?php echo $value->get('name'); ?></a></li>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</ol>
	</nav>
</div>
