<?php if(isset($categoriesOptions) and isset($categoriesOptions['type_of_display'])): ?>
	<?php echo $__env->make('home.inc.spacer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="container">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				<div class="col-xl-12 box-title no-border">
					<div class="inner">
						<h2>
							<span class="title-3"><?php echo e(t('Browse by')); ?> <span style="font-weight: bold;"><?php echo e(t('Category')); ?></span></span>
							<?php $attr = ['countryCode' => config('country.icode')]; ?>
							<a href="<?php echo e(lurl(trans('routes.v-sitemap', $attr), $attr)); ?>" class="sell-your-item">
								<?php echo e(t('View more')); ?> <i class="icon-th-list"></i>
							</a>
						</h2>
					</div>
				</div>
				
				<?php if($categoriesOptions['type_of_display'] == 'c_picture_icon'): ?>
					
					<?php if(isset($categories) and $categories->count() > 0): ?>
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
								<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $cat->slug]; ?>
								<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>">
									<img src="<?php echo e(\Storage::url($cat->picture) . getPictureVersion()); ?>" class="img-fluid" alt="<?php echo e($cat->name); ?>">
									<h6>
										<?php echo e($cat->name); ?>

										<?php if(isset($categoriesOptions['count_categories_posts']) and $categoriesOptions['count_categories_posts']): ?>
											<?php if($cat->children->count() > 0): ?>
												&nbsp;(<?php echo e($cat->posts->count() + $cat->childrenPosts->count()); ?>)
											<?php else: ?>
												&nbsp;(<?php echo e($cat->childrenPosts->count()); ?>)
											<?php endif; ?>
										<?php endif; ?>
									</h6>
								</a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					
				<?php elseif(in_array($categoriesOptions['type_of_display'], ['cc_normal_list', 'cc_normal_list_s'])): ?>
					
					<div style="clear: both;"></div>
					<?php $styled = ($categoriesOptions['type_of_display'] == 'cc_normal_list_s') ? ' styled' : ''; ?>
					
					<?php if(isset($categories) and $categories->count() > 0): ?>
						<div class="col-xl-12">
							<div class="list-categories-children<?php echo e($styled); ?>">
								<div class="row">
									<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cols): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-md-4 col-sm-4 <?php echo e((count($categories) == $key+1) ? 'last-column' : ''); ?>">
											<?php $__currentLoopData = $cols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												
												<?php
													$randomId = '-' . substr(uniqid(rand(), true), 5, 5);
												?>
											
												<div class="cat-list">
													<h3 class="cat-title rounded">
														<?php if(isset($categoriesOptions['show_icon']) and $categoriesOptions['show_icon'] == 1): ?>
															<i class="<?php echo e($iCat->icon_class ?? 'icon-ok'); ?>"></i>&nbsp;
														<?php endif; ?>
														<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $iCat->slug]; ?>
														<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>">
															<?php echo e($iCat->name); ?>

															<?php if(isset($categoriesOptions['count_categories_posts']) and $categoriesOptions['count_categories_posts']): ?>
																<?php if($iCat->children->count() > 0): ?>
																	&nbsp;(<?php echo e($iCat->posts->count() + $iCat->childrenPosts->count()); ?>)
																<?php else: ?>
																	&nbsp;(<?php echo e($iCat->childrenPosts->count()); ?>)
																<?php endif; ?>
															<?php endif; ?>
														</a>
														<span class="btn-cat-collapsed collapsed"
															  data-toggle="collapse"
															  data-target=".cat-id-<?php echo e($iCat->id . $randomId); ?>"
															  aria-expanded="false"
														>
															<span class="icon-down-open-big"></span>
														</span>
													</h3>
													<ul class="cat-collapse collapse show cat-id-<?php echo e($iCat->id . $randomId); ?> long-list-home">
														<?php if(isset($subCategories) and $subCategories->has($iCat->tid)): ?>
															<?php $__currentLoopData = $subCategories->get($iCat->tid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iSubCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<li>
																	<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $iCat->slug, 'subCatSlug' => $iSubCat->slug]; ?>
																	<a href="<?php echo e(lurl(trans('routes.v-search-subCat', $attr), $attr)); ?>">
																		<?php echo e($iSubCat->name); ?>

																	</a>
																	<?php if(isset($categoriesOptions['count_categories_posts']) and $categoriesOptions['count_categories_posts']): ?>
																		&nbsp;(<?php echo e($iSubCat->childrenPosts->count()); ?>)
																	<?php endif; ?>
																</li>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														<?php endif; ?>
													</ul>
												</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
							<div style="clear: both;"></div>
						</div>
					<?php endif; ?>
					
				<?php else: ?>
					
					<?php
					$listTab = [
						'c_circle_list' => 'list-circle',
						'c_check_list'  => 'list-check',
						'c_border_list' => 'list-border',
					];
					$catListClass = (isset($listTab[$categoriesOptions['type_of_display']])) ? 'list ' . $listTab[$categoriesOptions['type_of_display']] : 'list';
					?>
					<?php if(isset($categories) and $categories->count() > 0): ?>
						<div class="col-xl-12">
							<div class="list-categories">
								<div class="row">
									<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<ul class="cat-list <?php echo e($catListClass); ?> col-md-4 <?php echo e((count($categories) == $key+1) ? 'cat-list-border' : ''); ?>">
											<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li>
													<?php if(isset($categoriesOptions['show_icon']) and $categoriesOptions['show_icon'] == 1): ?>
														<i class="<?php echo e($cat->icon_class ?? 'icon-ok'); ?>"></i>&nbsp;
													<?php endif; ?>
													<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $cat->slug]; ?>
													<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>">
														<?php echo e($cat->name); ?>

													</a>
													<?php if(isset($categoriesOptions['count_categories_posts']) and $categoriesOptions['count_categories_posts']): ?>
														<?php if($cat->children->count() > 0): ?>
															&nbsp;(<?php echo e($cat->posts->count() + $cat->childrenPosts->count()); ?>)
														<?php else: ?>
															&nbsp;(<?php echo e($cat->childrenPosts->count()); ?>)
														<?php endif; ?>
													<?php endif; ?>
												</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
					
				<?php endif; ?>
		
			</div>
		</div>
	</div>
<?php endif; ?>

<?php $__env->startSection('before_scripts'); ?>
	##parent-placeholder-094e37d5f5003ce853bb823b74f26393141d779d##
	<?php if(isset($categoriesOptions) and isset($categoriesOptions['max_sub_cats']) and $categoriesOptions['max_sub_cats'] >= 0): ?>
		<script>
			var maxSubCats = <?php echo e((int)$categoriesOptions['max_sub_cats']); ?>;
		</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
