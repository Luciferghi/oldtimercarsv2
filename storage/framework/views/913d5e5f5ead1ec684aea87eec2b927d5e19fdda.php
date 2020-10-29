<!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
<?php
    $fullUrl = url(request()->getRequestUri());
    $tmpExplode = explode('?', $fullUrl);
    $fullUrlNoParams = current($tmpExplode);
?>
<div class="col-md-3 page-sidebar mobile-filter-sidebar pb-4">
	<aside>
		<div class="sidebar-modern-inner enable-long-words">
			
			<?php echo $__env->make('search.inc.fields', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <!-- Date -->
			<div class="block-title has-arrow sidebar-header">
				<h5><strong><a href="#"> <?php echo e(t('Date Posted')); ?> </a></strong></h5>
			</div>
            <div class="block-content list-filter">
                <div class="filter-date filter-content">
                    <ul>
                        <?php if(isset($dates) and !empty($dates)): ?>
                            <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <input type="radio" name="postedDate" value="<?php echo e($key); ?>" id="postedDate_<?php echo e($key); ?>" <?php echo e((request()->get('postedDate')==$key) ? 'checked="checked"' : ''); ?>>
                                    <label for="postedDate_<?php echo e($key); ?>"><?php echo e($value); ?></label>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <input type="hidden" id="postedQueryString" value="<?php echo e(httpBuildQuery(request()->except(['page', 'postedDate']))); ?>">
                    </ul>
                </div>
            </div>
            
            <?php if(isset($cat)): ?>
                <?php if(!in_array($cat->type, ['not-salable'])): ?>
					<!-- Price -->
					<div class="block-title has-arrow sidebar-header">
						<h5><strong><a href="#"><?php echo e((!in_array($cat->type, ['job-offer', 'job-search'])) ? t('Price range') : t('Salary range')); ?></a></strong></h5>
					</div>
					<div class="block-content list-filter">
						<form role="form" class="form-inline" action="<?php echo e($fullUrlNoParams); ?>" method="GET">
							<?php echo csrf_field(); ?>

							<?php $__currentLoopData = request()->except(['page', 'minPrice', 'maxPrice', '_token']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(is_array($value)): ?>
									<?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(is_array($v)): ?>
											<?php $__currentLoopData = $v; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ik => $iv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if(is_array($iv)) continue; ?>
												<input type="hidden" name="<?php echo e($key.'['.$k.']['.$ik.']'); ?>" value="<?php echo e($iv); ?>">
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<input type="hidden" name="<?php echo e($key.'['.$k.']'); ?>" value="<?php echo e($v); ?>">
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<div class="form-group col-sm-4 no-padding">
								<input type="text" placeholder="2000" id="minPrice" name="minPrice" class="form-control" value="<?php echo e(request()->get('minPrice')); ?>">
							</div>
							<div class="form-group col-sm-1 no-padding text-center hidden-xs"> -</div>
							<div class="form-group col-sm-4 no-padding">
								<input type="text" placeholder="3000" id="maxPrice" name="maxPrice" class="form-control" value="<?php echo e(request()->get('maxPrice')); ?>">
							</div>
							<div class="form-group col-sm-3 no-padding">
								<button class="btn btn-default pull-right btn-block-xs" type="submit"><?php echo e(t('GO')); ?></button>
							</div>
						</form>
						<div style="clear:both"></div>
					</div>
                <?php endif; ?>
				
				<?php $parentId = ($cat->parent_id == 0) ? $cat->tid : $cat->parent_id; ?>
                <!-- SubCategory -->
				<div id="subCatsList">
					<div class="block-title has-arrow sidebar-header">
						<h5><strong><a href="#"><i class="fa fa-angle-left"></i> <?php echo e(t('Others Categories')); ?></a></strong></h5>
					</div>
					<div class="block-content list-filter categories-list">
						<ul class="list-unstyled">
							<li>
								<?php if($cats->has($parentId)): ?>
									<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $cats->get($parentId)->slug]; ?>
									<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>" title="<?php echo e($cats->get($parentId)->name); ?>">
										<span class="title"><strong><?php echo e($cats->get($parentId)->name); ?></strong>
										</span><span class="count">&nbsp;<?php echo e($countCatPosts->get($parentId)->total ?? 0); ?></span>
									</a>
								<?php endif; ?>
								<ul class="list-unstyled long-list">
									<?php if($cats->groupBy('parent_id')->has($parentId)): ?>
									<?php $__currentLoopData = $cats->groupBy('parent_id')->get($parentId); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iSubCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(!$cats->has($iSubCat->parent_id)) continue; ?>
										<li>
											<?php $attr = [
												'countryCode' => config('country.icode'),
												'catSlug'     => $cats->get($iSubCat->parent_id)->slug,
												'subCatSlug'  => $iSubCat->slug
											]; ?>
											<?php if((isset($uriPathSubCatSlug) and $uriPathSubCatSlug == $iSubCat->slug) or (request()->input('sc') == $iSubCat->tid)): ?>
												<strong>
													<a href="<?php echo e(lurl(trans('routes.v-search-subCat', $attr), $attr)); ?>" title="<?php echo e($iSubCat->name); ?>">
														<?php echo e(\Illuminate\Support\Str::limit($iSubCat->name, 100)); ?>

														<span class="count">(<?php echo e($countSubCatPosts->get($iSubCat->tid)->total ?? 0); ?>)</span>
													</a>
												</strong>
											<?php else: ?>
												<a href="<?php echo e(lurl(trans('routes.v-search-subCat', $attr), $attr)); ?>" title="<?php echo e($iSubCat->name); ?>">
													<?php echo e(\Illuminate\Support\Str::limit($iSubCat->name, 100)); ?>

													<span class="count">(<?php echo e($countSubCatPosts->get($iSubCat->tid)->total ?? 0); ?>)</span>
												</a>
											<?php endif; ?>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<?php $style = 'style="display: none;"'; ?>
			<?php endif; ?>
        
            <!-- Category -->
			<div id="catsList" <?php echo (isset($style)) ? $style : ''; ?>>
				<div class="block-title has-arrow sidebar-header">
					<h5><strong><a href="#"><?php echo e(t('All Categories')); ?></a></strong></h5>
				</div>
				<div class="block-content list-filter categories-list">
					<ul class="list-unstyled">
						<?php if($cats->groupBy('parent_id')->has(0)): ?>
						<?php $__currentLoopData = $cats->groupBy('parent_id')->get(0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li>
								<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $iCat->slug]; ?>
								<?php if((isset($uriPathCatSlug) and $uriPathCatSlug == $iCat->slug) or (request()->input('c') == $iCat->tid)): ?>
									<strong>
										<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>" title="<?php echo e($iCat->name); ?>">
											<span class="title"><?php echo e($iCat->name); ?></span>
											<span class="count">&nbsp;<?php echo e($countCatPosts->get($iCat->tid)->total ?? 0); ?></span>
										</a>
									</strong>
								<?php else: ?>
									<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>" title="<?php echo e($iCat->name); ?>">
										<span class="title"><?php echo e($iCat->name); ?></span>
										<span class="count">&nbsp;<?php echo e($countCatPosts->get($iCat->tid)->total ?? 0); ?></span>
									</a>
								<?php endif; ?>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
            
            <!-- City -->
			<div class="block-title has-arrow sidebar-header">
				<h5><strong><a href="#"><?php echo e(t('Locations')); ?></a></strong></h5>
			</div>
			<div class="block-content list-filter locations-list">
				<ul class="browse-list list-unstyled long-list">
                    <?php if(isset($cities) and $cities->count() > 0): ?>
						<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$attr = ['countryCode' => config('country.icode')];
								$fullUrlLocation = lurl(trans('routes.v-search', $attr), $attr);
								$locationParams = [
									'l'  => $city->id,
									'r'  => '',
									'c'  => (isset($cat)) ? $cat->tid : '',
									'sc' => (isset($subCat)) ? $subCat->tid : '',
								];
							?>
							<li>
								<?php if((isset($uriPathCityId) and $uriPathCityId == $city->id) or (request()->input('l')==$city->id)): ?>
									<strong>
										<a href="<?php echo qsurl($fullUrlLocation, array_merge(request()->except(['page'] + array_keys($locationParams)), $locationParams), null, false); ?>" title="<?php echo e($city->name); ?>">
											<?php echo e($city->name); ?>

										</a>
									</strong>
								<?php else: ?>
									<a href="<?php echo qsurl($fullUrlLocation, array_merge(request()->except(['page'] + array_keys($locationParams)), $locationParams), null, false); ?>" title="<?php echo e($city->name); ?>">
										<?php echo e($city->name); ?>

									</a>
								<?php endif; ?>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
				</ul>
			</div>

			<div style="clear:both"></div>
		</div>
	</aside>

</div>

<?php $__env->startSection('after_scripts'); ?>
    ##parent-placeholder-3bf5331b3a09ea3f1b5e16018984d82e8dc96b5f##
    <script>
        var baseUrl = '<?php echo e($fullUrlNoParams); ?>';
        
        $(document).ready(function ()
        {
            $('input[type=radio][name=postedDate]').click(function() {
                var postedQueryString = $('#postedQueryString').val();
				
                if (postedQueryString != '') {
                    postedQueryString = postedQueryString + '&';
                }
                postedQueryString = postedQueryString + 'postedDate=' + $(this).val();
                
                var searchUrl = baseUrl + '?' + postedQueryString;
				redirect(searchUrl);
            });
        });
    </script>
<?php $__env->stopSection(); ?>