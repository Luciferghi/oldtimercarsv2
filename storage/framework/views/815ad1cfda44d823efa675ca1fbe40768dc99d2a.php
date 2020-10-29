<?php
if (!isset($cats)) {
    $cats = collect([]);
}

$cats = $cats->groupBy('parent_id');
$subCats = $cats;
if ($cats->has(0)) {
	$cats = $cats->get(0);
}
if ($subCats->has(0)) {
	$subCats = $subCats->forget(0);
}
?>
<?php
	if (
		(isset($subCats) and !empty($subCats) and isset($cat) and !empty($cat) and $subCats->has($cat->tid)) ||
		(isset($cats) and !empty($cats))
	):
?>
<?php if(isset($subCats) and !empty($subCats) and isset($cat) and !empty($cat)): ?>
	<?php if($subCats->has($cat->tid)): ?>
		<div class="container hide-xs">
			<div class="category-links">
				<ul>
				<?php $__currentLoopData = $subCats->get($cat->tid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iSubCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li>
						<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $cat->slug, 'subCatSlug' => $iSubCat->slug]; ?>
						<a href="<?php echo e(lurl(trans('routes.v-search-subCat', $attr), $attr)); ?>">
							<?php echo e($iSubCat->name); ?>

						</a>
					</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
<?php else: ?>
	<?php if(isset($cats) and !empty($cats)): ?>
		<div class="container hide-xs">
			<div class="category-links">
				<ul>
				<?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li>
						<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $iCategory->slug]; ?>
						<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>">
							<?php echo e($iCategory->name); ?>

						</a>
					</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>