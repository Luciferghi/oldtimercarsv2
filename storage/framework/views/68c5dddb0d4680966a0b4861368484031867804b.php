<?php
// Fix: 404 error page don't know language and country objects.
$countryCode = 'us'; /* @fixme - Issue only in multi-countries mode. Get the real default country. */
$searchUrl = url(config('app.locale') . '/' . trans('routes.v-search', ['countryCode' => $countryCode]));
?>
<div class="h-spacer"></div>
<div class="container">
	<div class="intro rounded-bottom">
		<div class="dtable hw100">
			<div class="dtable-cell hw100">
				<div class="container text-center">
					
					<div class="search-row fadeInUp">
						<form id="seach" name="search" action="<?php echo e($searchUrl); ?>" method="GET">
							<div class="row m-0">
								<div class="col-sm-5 col-xs-12 search-col relative">
									<i class="icon-docs icon-append"></i>
									<input type="text" name="q" class="form-control has-icon" placeholder="<?php echo e(t('What?')); ?>" value="">
								</div>
								
								<div class="col-sm-5 col-xs-12 search-col relative locationicon">
									<i class="icon-location-2 icon-append"></i>
									<input type="hidden" id="lSearch" name="l" value="">
									<input type="text" id="locSearch" name="location" class="form-control locinput input-rel searchtag-input has-icon"
										   placeholder="<?php echo e(t('Where?')); ?>" value="">
								</div>
								
								<div class="col-sm-2 col-xs-12 search-col">
									<button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i><strong><?php echo e(t('Find')); ?></strong>
									</button>
								</div>
								<?php echo csrf_field(); ?>

							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
