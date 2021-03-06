<?php
// Phone
$phone = TextToImage::make($post->phone, config('larapen.core.textToImage'));
$phoneLink = 'tel:' . $post->phone;
$phoneLinkAttr = '';
if (!auth()->check()) {
	if (config('settings.single.guests_can_contact_ads_authors') != '1') {
		$phone = t('Click to see');
		$phoneLink = '#quickLogin';
		$phoneLinkAttr = 'data-toggle="modal"';
	}
}

// Contact Seller URL
$contactSellerURL = '#contactUser';
if (!auth()->check()) {
	if (config('settings.single.guests_can_contact_ads_authors') != '1') {
		$contactSellerURL = '#quickLogin';
	}
}
?>

<?php $__env->startSection('content'); ?>
	<?php echo csrf_field(); ?>

	<input type="hidden" id="post_id" value="<?php echo e($post->id); ?>">
	
	<?php if(Session::has('flash_notification')): ?>
		<?php echo $__env->make('common.spacer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php $paddingTopExists = true; ?>
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>
		<?php Session::forget('flash_notification.message'); ?>
	<?php endif; ?>
	
	<div class="main-container">
		
		<?php if (\App\Models\Advertising::where('slug', 'top')->count() > 0): ?>
			<?php echo $__env->make('layouts.inc.advertising.top', ['paddingTopExists' => (isset($paddingTopExists)) ? $paddingTopExists : false], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php
			$paddingTopExists = false;
		endif;
		?>
		<?php echo $__env->make('common.spacer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<nav aria-label="breadcrumb" role="navigation" class="pull-left">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo e(lurl('/')); ?>"><i class="icon-home fa"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo e(lurl('/')); ?>"><?php echo e(config('country.name')); ?></a></li>
							<?php if(!empty($post->category->parent)): ?>
								<li class="breadcrumb-item">
									<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $post->category->parent->slug]; ?>
									<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>">
										<?php echo e($post->category->parent->name); ?>

									</a>
								</li>
								<?php if($post->category->parent->id != $post->category->id): ?>
									<li class="breadcrumb-item">
										<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $post->category->parent->slug, 'subCatSlug' => $post->category->slug]; ?>
										<a href="<?php echo e(lurl(trans('routes.v-search-subCat', $attr), $attr)); ?>">
											<?php echo e($post->category->name); ?>

										</a>
									</li>
								<?php endif; ?>
							<?php else: ?>
								<li class="breadcrumb-item">
									<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $post->category->slug]; ?>
									<a href="<?php echo e(lurl(trans('routes.v-search-cat', $attr), $attr)); ?>">
										<?php echo e($post->category->name); ?>

									</a>
								</li>
							<?php endif; ?>
							<li class="breadcrumb-item active" aria-current="page"><?php echo e(\Illuminate\Support\Str::limit($post->title, 70)); ?></li>
						</ol>
					</nav>
					
					<div class="pull-right backtolist">
						<a href="<?php echo e(rawurldecode(URL::previous())); ?>"><i class="fa fa-angle-double-left"></i> <?php echo e(t('Back to Results')); ?></a>
					</div>
				
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-lg-9 page-content col-thin-right">
					<div class="inner inner-box ads-details-wrapper pb-0">
						<h2 class="enable-long-words">
							<strong>
								<?php $attr = ['slug' => slugify($post->title), 'id' => $post->id]; ?>
								<a href="<?php echo e(lurl($post->uri, $attr)); ?>" title="<?php echo e($post->title); ?>">
									<?php echo e($post->title); ?>

                                </a>
                            </strong>
							<small class="label label-default adlistingtype"><?php echo e($post->postType->name); ?></small>
							<?php if($post->featured==1 and !empty($post->latestPayment)): ?>
								<?php if(isset($post->latestPayment->package) and !empty($post->latestPayment->package)): ?>
									<i class="icon-ok-circled tooltipHere" style="color: <?php echo e($post->latestPayment->package->ribbon); ?>;" title="" data-placement="right"
									   data-toggle="tooltip" data-original-title="<?php echo e($post->latestPayment->package->short_name); ?>"></i>
								<?php endif; ?>
                            <?php endif; ?>
						</h2>
						<span class="info-row">
							<span class="date"><i class="icon-clock"> </i> <?php echo e($post->created_at_ta); ?> </span> -&nbsp;
							<span class="category"><?php echo e((!empty($post->category->parent)) ? $post->category->parent->name : $post->category->name); ?></span> -&nbsp;
							<span class="item-location"><i class="fas fa-map-marker-alt"></i> <?php echo e($post->city->name); ?> </span> -&nbsp;
							<span class="category">
								<i class="icon-eye-3"></i>&nbsp;
								<?php echo e(\App\Helpers\Number::short($post->visits)); ?> <?php echo e(trans_choice('global.count_views', getPlural($post->visits))); ?>

							</span>
						</span>
						
						<div class="posts-image">
							<?php $titleSlug = \Illuminate\Support\Str::slug($post->title); ?>
							<?php if(!in_array($post->category->type, ['not-salable'])): ?>
								<h1 class="pricetag">
									<?php if($post->price > 0): ?>
										<?php echo \App\Helpers\Number::money($post->price); ?>

									<?php else: ?>
										<?php echo \App\Helpers\Number::money(' --'); ?>

									<?php endif; ?>
								</h1>
							<?php endif; ?>
							<?php if(count($post->pictures) > 0): ?>
								<ul class="bxslider">
									<?php $__currentLoopData = $post->pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><img src="<?php echo e(resize($image->filename, 'big')); ?>" alt="<?php echo e($titleSlug . '-big-' . $key); ?>"></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<div class="product-view-thumb-wrapper">
									<ul id="bx-pager" class="product-view-thumb">
									<?php $__currentLoopData = $post->pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<a class="thumb-item-link" data-slide-index="<?php echo e($key); ?>" href="">
												<img src="<?php echo e(resize($image->filename, 'small')); ?>" alt="<?php echo e($titleSlug . '-small-' . $key); ?>">
											</a>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							<?php else: ?>
								<ul class="bxslider">
									<li><img src="<?php echo e(resize(config('larapen.core.picture.default'), 'big')); ?>" alt="img"></li>
								</ul>
								<div class="product-view-thumb-wrapper">
									<ul id="bx-pager" class="product-view-thumb">
										<li>
											<a class="thumb-item-link" data-slide-index="0" href="">
												<img src="<?php echo e(resize(config('larapen.core.picture.default'), 'small')); ?>" alt="img">
											</a>
										</li>
									</ul>
								</div>
							<?php endif; ?>
						</div>
						<!--posts-image-->
						
						
						<?php if(config('plugins.reviews.installed')): ?>
							<?php if(view()->exists('reviews::ratings-single')): ?>
								<?php echo $__env->make('reviews::ratings-single', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endif; ?>
						<?php endif; ?>
						

						<div class="ads-details">
							<ul class="nav nav-tabs">
								<li class="nav-item active">
									<a class="nav-link" href="#tab-details" data-toggle="tab"><h4><?php echo e(t('Ad Details')); ?></h4></a>
								</li>
								<?php if(config('plugins.reviews.installed')): ?>
									<li class="nav-item">
										<a class="nav-link" href="#tab-<?php echo e(config('plugins.reviews.name')); ?>" data-toggle="tab">
											<h4>
												<?php echo e(trans('reviews::messages.Reviews')); ?>

												<?php if(isset($rvPost) and !empty($rvPost)): ?>
												(<?php echo e($rvPost->rating_count); ?>)
												<?php endif; ?>
											</h4>
										</a>
									</li>
								<?php endif; ?>
							</ul>
							
							<!-- Tab panes -->
							<div class="tab-content p-3 mb-3">
								<div class="tab-pane active" id="tab-details">
									<div class="row">
										<div class="ads-details-info col-md-12 col-sm-12 col-xs-12 enable-long-words from-wysiwyg">
											
											<div class="row">
												<!-- Location -->
												<div class="detail-line-lite col-md-6 col-sm-6 col-xs-6">
													<div>
														<span><i class="fas fa-map-marker-alt"></i> <?php echo e(t('Location')); ?>: </span>
														<span>
															<?php $attr = ['countryCode' => config('country.icode'), 'city' => slugify($post->city->name), 'id' => $post->city->id]; ?>
															<a href="<?php echo lurl(trans('routes.v-search-city', $attr), $attr); ?>">
																<?php echo e($post->city->name); ?>

															</a>
														</span>
													</div>
												</div>
												
												<?php if(!in_array($post->category->type, ['not-salable'])): ?>
													<!-- Price / Salary -->
													<div class="detail-line-lite col-md-6 col-sm-6 col-xs-6">
														<div>
															<span>
																<?php echo e((!in_array($post->category->type, ['job-offer', 'job-search'])) ? t('Price') : t('Salary')); ?>:
															</span>
															<span>
																<?php if($post->price > 0): ?>
																	<?php echo \App\Helpers\Number::money($post->price); ?>

																<?php else: ?>
																	<?php echo \App\Helpers\Number::money(' --'); ?>

																<?php endif; ?>
																<?php if($post->negotiable == 1): ?>
																	<small class="label badge-success"> <?php echo e(t('Negotiable')); ?></small>
																<?php endif; ?>
															</span>
														</div>
													</div>
												<?php endif; ?>
											</div>
											<hr>
											
											<!-- Description -->
											<div class="row">
												<div class="col-12 detail-line-content">
													<?php echo transformDescription($post->description); ?>

												</div>
											</div>
											
											<!-- Custom Fields -->
											<?php echo $__env->make('post.inc.fields-values', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
										
											<!-- Tags -->
											<?php if(!empty($post->tags)): ?>
												<?php $tags = array_map('trim', explode(',', $post->tags)); ?>
												<?php if(!empty($tags)): ?>
													<div class="row">
														<div class="tags col-12">
															<h4><i class="icon-tag"></i> <?php echo e(t('Tags')); ?>:</h4>
															<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<?php $attr = ['countryCode' => config('country.icode'), 'tag' => $iTag]; ?>
																<a href="<?php echo e(lurl(trans('routes.v-search-tag', $attr), $attr)); ?>">
																	<?php echo e($iTag); ?>

																</a>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</div>
													</div>
												<?php endif; ?>
											<?php endif; ?>
											
											<!-- Actions -->
											<div class="row detail-line-action text-center">
													<div class="col-4">
													<?php if(auth()->check()): ?>
														<?php if(auth()->user()->id == $post->user_id): ?>
															<a href="<?php echo e(lurl('posts/' . $post->id . '/edit')); ?>">
																<i class="icon-pencil-circled tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Edit')); ?>"></i>
															</a>
														<?php else: ?>
															<?php if($post->email != ''): ?>
																<a data-toggle="modal" href="<?php echo e($contactSellerURL); ?>">
																	<i class="icon-mail-2 tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Send a message')); ?>"></i>
																</a>
															<?php else: ?>
																<i class="icon-mail-2" style="color: #dadada"></i>
															<?php endif; ?>
														<?php endif; ?>
													<?php else: ?>
														<?php if($post->email != ''): ?>
															<a data-toggle="modal" href="<?php echo e($contactSellerURL); ?>">
																<i class="icon-mail-2 tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Send a message')); ?>"></i>
															</a>
														<?php else: ?>
															<i class="icon-mail-2" style="color: #dadada"></i>
														<?php endif; ?>
													<?php endif; ?>
													</div>
													<div class="col-4">
														<a class="make-favorite" id="<?php echo e($post->id); ?>" href="javascript:void(0)">
															<?php if(auth()->check()): ?>
																<?php if(\App\Models\SavedPost::where('user_id', auth()->user()->id)->where('post_id', $post->id)->count() > 0): ?>
																	<i class="fa fa-heart tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Remove favorite')); ?>"></i>
																<?php else: ?>
																	<i class="far fa-heart" class="tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Save ad')); ?>"></i>
																<?php endif; ?>
															<?php else: ?>
																<i class="far fa-heart" class="tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Save ad')); ?>"></i>
															<?php endif; ?>
														</a>
													</div>
													<div class="col-4">
														<a href="<?php echo e(lurl('posts/' . $post->id . '/report')); ?>">
															<i class="fa icon-info-circled-alt tooltipHere" data-toggle="tooltip" data-original-title="<?php echo e(t('Report abuse')); ?>"></i>
														</a>
													</div>
											</div>
										</div>
										
										<br>&nbsp;<br>
									</div>
								</div>
								
								<?php if(config('plugins.reviews.installed')): ?>
									<?php if(view()->exists('reviews::comments')): ?>
										<?php echo $__env->make('reviews::comments', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<!-- /.tab content -->
									
							<div class="content-footer text-left">
								<?php if(auth()->check()): ?>
									<?php if(auth()->user()->id == $post->user_id): ?>
										<a class="btn btn-default" href="<?php echo e(editPostURL($post->id)); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo e(t('Edit')); ?></a>
									<?php else: ?>
										<?php if($post->email != ''): ?>
											<a class="btn btn-default" data-toggle="modal" href="<?php echo e($contactSellerURL); ?>"><i class="icon-mail-2"></i> <?php echo e(t('Send a message')); ?> </a>
										<?php endif; ?>
									<?php endif; ?>
								<?php else: ?>
									<?php if($post->email != ''): ?>
										<a class="btn btn-default" data-toggle="modal" href="<?php echo e($contactSellerURL); ?>"><i class="icon-mail-2"></i> <?php echo e(t('Send a message')); ?> </a>
									<?php endif; ?>
								<?php endif; ?>
								<?php if($post->phone_hidden != 1 and !empty($post->phone)): ?>
									<a href="<?php echo e($phoneLink); ?>" <?php echo $phoneLinkAttr; ?> class="btn btn-success showphone">
										<i class="icon-phone-1"></i>
										<?php echo $phone; ?>

									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!--/.ads-details-wrapper-->
				</div>
				<!--/.page-content-->

				<div class="col-lg-3 page-sidebar-right">
					<aside>
						<div class="card card-user-info sidebar-card">
							<?php if(auth()->check() and auth()->user()->getAuthIdentifier() == $post->user_id): ?>
								<div class="card-header"><?php echo e(t('Manage Ad')); ?></div>
							<?php else: ?>
								<div class="block-cell user">
									<div class="cell-media">
										<?php if(!empty($userPhoto)): ?>
											<img src="<?php echo e($userPhoto); ?>" alt="<?php echo e($post->contact_name); ?>">
										<?php else: ?>
											<img src="<?php echo e(url('images/user.jpg')); ?>" alt="<?php echo e($post->contact_name); ?>">
										<?php endif; ?>
									</div>
									<div class="cell-content">
										<h5 class="title"><?php echo e(t('Posted by')); ?></h5>
										<span class="name">
											<?php if(isset($user) and !empty($user)): ?>
												<?php $attr = ['countryCode' => config('country.icode'), 'id' => $user->id]; ?>
												<a href="<?php echo e(lurl(trans('routes.v-search-user', $attr), $attr)); ?>">
													<?php echo e($post->contact_name); ?>

												</a>
											<?php else: ?>
												<?php echo e($post->contact_name); ?>

											<?php endif; ?>
										</span>
										
										<?php if(config('plugins.reviews.installed')): ?>
											<?php if(view()->exists('reviews::ratings-user')): ?>
												<?php echo $__env->make('reviews::ratings-user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php endif; ?>
										<?php endif; ?>
										
									</div>
								</div>
							<?php endif; ?>
							
							<div class="card-content">
								<?php $evActionStyle = 'style="border-top: 0;"'; ?>
								<?php if(!auth()->check() or (auth()->check() and auth()->user()->getAuthIdentifier() != $post->user_id)): ?>
									<div class="card-body text-left">
										<div class="grid-col">
											<div class="col from">
												<i class="fas fa-map-marker-alt"></i>
												<span><?php echo e(t('Location')); ?></span>
											</div>
											<div class="col to">
												<span>
													<?php $attr = ['countryCode' => config('country.icode'), 'city' => slugify($post->city->name), 'id' => $post->city->id]; ?>
													<a href="<?php echo lurl(trans('routes.v-search-city', $attr), $attr); ?>">
														<?php echo e($post->city->name); ?>

													</a>
												</span>
											</div>
										</div>
										<?php if(isset($user) and !empty($user) and !is_null($user->created_at_ta)): ?>
										<div class="grid-col">
											<div class="col from">
												<i class="fas fa-user"></i>
												<span><?php echo e(t('Joined')); ?></span>
											</div>
											<div class="col to">
												<span><?php echo e($user->created_at_ta); ?></span>
											</div>
										</div>
										<?php endif; ?>
									</div>
									<?php $evActionStyle = 'style="border-top: 1px solid #ddd;"'; ?>
								<?php endif; ?>
								
								<div class="ev-action" <?php echo $evActionStyle; ?>>
									<?php if(auth()->check()): ?>
										<?php if(auth()->user()->id == $post->user_id): ?>
											<a href="<?php echo e(editPostURL($post->id)); ?>" class="btn btn-default btn-block">
												<i class="fa fa-pencil-square-o"></i> <?php echo e(t('Update the Details')); ?>

											</a>
											<?php if(config('settings.single.publication_form_type') == '1'): ?>
												<a href="<?php echo e(lurl('posts/' . $post->id . '/photos')); ?>" class="btn btn-default btn-block">
													<i class="icon-camera-1"></i> <?php echo e(t('Update Photos')); ?>

												</a>
												<?php if(isset($countPackages) and isset($countPaymentMethods) and $countPackages > 0 and $countPaymentMethods > 0): ?>
													<a href="<?php echo e(lurl('posts/' . $post->id . '/payment')); ?>" class="btn btn-success btn-block">
														<i class="icon-ok-circled2"></i> <?php echo e(t('Make It Premium')); ?>

													</a>
												<?php endif; ?>
											<?php endif; ?>
										<?php else: ?>
											<?php if($post->email != ''): ?>
												<a href="<?php echo e($contactSellerURL); ?>" data-toggle="modal" class="btn btn-default btn-block">
													<i class="icon-mail-2"></i> <?php echo e(t('Send a message')); ?>

												</a>
											<?php endif; ?>
											<?php if($post->phone_hidden != 1 and !empty($post->phone)): ?>
												<a href="<?php echo e($phoneLink); ?>" <?php echo $phoneLinkAttr; ?> class="btn btn-success btn-block showphone">
													<i class="icon-phone-1"></i>
													<?php echo $phone; ?>

												</a>
											<?php endif; ?>
										<?php endif; ?>
									<?php else: ?>
										<?php if($post->email != ''): ?>
											<a href="<?php echo e($contactSellerURL); ?>" data-toggle="modal" class="btn btn-default btn-block">
												<i class="icon-mail-2"></i> <?php echo e(t('Send a message')); ?>

											</a>
										<?php endif; ?>
										<?php if($post->phone_hidden != 1 and !empty($post->phone)): ?>
											<a href="<?php echo e($phoneLink); ?>" <?php echo $phoneLinkAttr; ?> class="btn btn-success btn-block showphone">
												<i class="icon-phone-1"></i>
												<?php echo $phone; ?>

											</a>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
						
						<?php if(config('settings.single.show_post_on_googlemap')): ?>
							<div class="card sidebar-card">
								<div class="card-header"><?php echo e(t('Location\'s Map')); ?></div>
								<div class="card-content">
									<div class="card-body text-left p-0">
										<div class="ads-googlemaps">
											<iframe id="googleMaps" width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						
						<?php if(isVerifiedPost($post)): ?>
							<?php echo $__env->make('layouts.inc.social.horizontal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php endif; ?>
						
						<div class="card sidebar-card">
							<div class="card-header"><?php echo e(t('Safety Tips for Buyers')); ?></div>
							<div class="card-content">
								<div class="card-body text-left">
									<ul class="list-check">
										<li> <?php echo e(t('Meet seller at a public place')); ?> </li>
										<li> <?php echo e(t('Check the item before you buy')); ?> </li>
										<li> <?php echo e(t('Pay only after collecting the item')); ?> </li>
									</ul>
                                    <?php $tipsLinkAttributes = getUrlPageByType('tips'); ?>
                                    <?php if(!\Illuminate\Support\Str::contains($tipsLinkAttributes, 'href="#"') and !\Illuminate\Support\Str::contains($tipsLinkAttributes, 'href=""')): ?>
									<p>
										<a class="pull-right" <?php echo $tipsLinkAttributes; ?>>
                                            <?php echo e(t('Know more')); ?>

                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </p>
                                    <?php endif; ?>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>

		</div>
		
		<?php echo $__env->make('home.inc.featured', ['firstSection' => false], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('layouts.inc.advertising.bottom', ['firstSection' => false], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(isVerifiedPost($post)): ?>
			<?php echo $__env->make('layouts.inc.tools.facebook-comments', ['firstSection' => false], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
		
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal_message'); ?>
	<?php if(auth()->check() or config('settings.single.guests_can_contact_ads_authors')=='1'): ?>
		<?php echo $__env->make('post.inc.compose-message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
	<!-- bxSlider CSS file -->
	<?php if(config('lang.direction') == 'rtl'): ?>
		<link href="<?php echo e(url('assets/plugins/bxslider/jquery.bxslider.rtl.css')); ?>" rel="stylesheet"/>
	<?php else: ?>
		<link href="<?php echo e(url('assets/plugins/bxslider/jquery.bxslider.css')); ?>" rel="stylesheet"/>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <?php if(config('services.googlemaps.key')): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(config('services.googlemaps.key')); ?>" type="text/javascript"></script>
    <?php endif; ?>

	<!-- bxSlider Javascript file -->
	<script src="<?php echo e(url('assets/plugins/bxslider/jquery.bxslider.min.js')); ?>"></script>
    
	<script>
		/* Favorites Translation */
        var lang = {
            labelSavePostSave: "<?php echo t('Save ad'); ?>",
            labelSavePostRemove: "<?php echo t('Remove favorite'); ?>",
            loginToSavePost: "<?php echo t('Please log in to save the Ads.'); ?>",
            loginToSaveSearch: "<?php echo t('Please log in to save your search.'); ?>",
            confirmationSavePost: "<?php echo t('Post saved in favorites successfully !'); ?>",
            confirmationRemoveSavePost: "<?php echo t('Post deleted from favorites successfully !'); ?>",
            confirmationSaveSearch: "<?php echo t('Search saved successfully !'); ?>",
            confirmationRemoveSaveSearch: "<?php echo t('Search deleted successfully !'); ?>"
        };
		
		$(document).ready(function () {
			/* bxSlider - Main Images */
			$('.bxslider').bxSlider({
				speed: 1000,
				pagerCustom: '#bx-pager',
				adaptiveHeight: true,
				onSlideAfter: function ($slideElement, oldIndex, newIndex) {
					<?php if(!userBrowser('Chrome')): ?>
						$('#bx-pager li:not(.bx-clone)').eq(newIndex).find('a.thumb-item-link').addClass('active');
					<?php endif; ?>
				}
			});
			
			/* bxSlider - Thumbnails */
			<?php if(userBrowser('Chrome')): ?>
				$('#bx-pager').addClass('m-3');
				$('#bx-pager .thumb-item-link').unwrap();
			<?php else: ?>
				var thumbSlider = $('.product-view-thumb').bxSlider(bxSliderSettings());
				$(window).on('resize', function() {
					thumbSlider.reloadSlider(bxSliderSettings());
				});
			<?php endif; ?>
			
			<?php if(config('settings.single.show_post_on_googlemap')): ?>
				/* Google Maps */
				getGoogleMaps(
				'<?php echo e(config('services.googlemaps.key')); ?>',
				'<?php echo e((isset($post->city) and !empty($post->city)) ? addslashes($post->city->name) . ',' . config('country.name') : config('country.name')); ?>',
				'<?php echo e(config('app.locale')); ?>'
				);
			<?php endif; ?>
            
			/* Keep the current tab active with Twitter Bootstrap after a page reload */
            /* For bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line */
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                /* save the latest tab; use cookies if you like 'em better: */
                localStorage.setItem('lastTab', $(this).attr('href'));
            });
            /* Go to the latest tab, if it exists: */
            var lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
                $('[href="' + lastTab + '"]').tab('show');
            }
		});
		
		/* bxSlider - Initiates Responsive Carousel */
		function bxSliderSettings()
		{
			var smSettings = {
				slideWidth: 65,
				minSlides: 1,
				maxSlides: 4,
				slideMargin: 5,
				adaptiveHeight: true,
				pager: false
			};
			var mdSettings = {
				slideWidth: 100,
				minSlides: 1,
				maxSlides: 4,
				slideMargin: 5,
				adaptiveHeight: true,
				pager: false
			};
			var lgSettings = {
				slideWidth: 100,
				minSlides: 3,
				maxSlides: 6,
				pager: false,
				slideMargin: 10,
				adaptiveHeight: true
			};
			
			if ($(window).width() <= 640) {
				return smSettings;
			} else if ($(window).width() > 640 && $(window).width() < 768) {
				return mdSettings;
			} else {
				return lgSettings;
			}
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>