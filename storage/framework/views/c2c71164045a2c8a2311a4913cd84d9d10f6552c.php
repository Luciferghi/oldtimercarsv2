<?php
// Default Map's values
$map = [
    'show' 				=> false,
    'backgroundColor' 	=> 'transparent',
    'border' 			=> '#c7c5c1',
    'hoverBorder' 		=> '#c7c5c1',
    'borderWidth' 		=> 4,
    'color' 			=> '#f2f0eb',
    'hover' 			=> '#4682B4',
    'width' 			=> '300px',
    'height' 			=> '300px',
];

// Blue Theme values
if (config('app.skin') == 'skin-blue') {
    $map = [
        'show' 				=> false,
        'backgroundColor' 	=> 'transparent',
        'border' 			=> '#4682B4',
        'hoverBorder' 		=> '#4682B4',
        'borderWidth' 		=> 4,
        'color' 			=> '#d5e3ef',
        'hover' 			=> '#4682B4',
        'width' 			=> '300px',
        'height' 			=> '300px',
    ];
}

// Green Theme values
if (config('app.skin') == 'skin-green') {
    $map = [
        'show' 				=> false,
        'backgroundColor' 	=> 'transparent',
        'border' 			=> '#228B22',
        'hoverBorder' 		=> '#228B22',
        'borderWidth' 		=> 4,
        'color' 			=> '#cae7ca',
        'hover' 			=> '#228B22',
        'width' 			=> '300px',
        'height' 			=> '300px',
    ];
}

// Red Theme values
if (config('app.skin') == 'skin-red') {
    $map = [
        'show' 				=> false,
        'backgroundColor' 	=> 'transparent',
        'border' 			=> '#fa2320',
        'hoverBorder' 		=> '#fa2320',
        'borderWidth' 		=> 4,
        'color' 			=> '#f0d9d8',
        'hover' 			=> '#fa2320',
        'width' 			=> '300px',
        'height' 			=> '300px',
    ];
}

// Yellow Theme values
if (config('app.skin') == 'skin-yellow') {
    $map = [
        'show' 				=> false,
        'backgroundColor' 	=> 'transparent',
        'border' 			=> '#ffd005',
        'hoverBorder' 		=> '#ffd005',
        'borderWidth' 		=> 4,
        'color' 			=> '#fcf8e3',
        'hover' 			=> '#2ecc71',
        'width' 			=> '300px',
        'height' 			=> '300px',
    ];
}

// Get Admin Map's values
if (isset($citiesOptions)) {
    if (file_exists(config('larapen.core.maps.path') . config('country.icode') . '.svg')) {
        if (isset($citiesOptions['show_map']) and $citiesOptions['show_map'] == '1') {
            $map['show'] = true;
        }
    }
    if (isset($citiesOptions['map_background_color']) and !empty($citiesOptions['map_background_color'])) {
        $map['backgroundColor'] = $citiesOptions['map_background_color'];
    }
    if (isset($citiesOptions['map_border']) and !empty($citiesOptions['map_border'])) {
        $map['border'] = $citiesOptions['map_border'];
    }
    if (isset($citiesOptions['map_hover_border']) and !empty($citiesOptions['map_hover_border'])) {
        $map['hoverBorder'] = $citiesOptions['map_hover_border'];
    }
    if (isset($citiesOptions['map_border_width']) and !empty($citiesOptions['map_border_width'])) {
        $map['borderWidth'] = strToInt($citiesOptions['map_border_width']);
    }
    if (isset($citiesOptions['map_color']) and !empty($citiesOptions['map_color'])) {
        $map['color'] = $citiesOptions['map_color'];
    }
    if (isset($citiesOptions['map_hover']) and !empty($citiesOptions['map_hover'])) {
        $map['hover'] = $citiesOptions['map_hover'];
    }
    if (isset($citiesOptions['map_width']) and !empty($citiesOptions['map_width'])) {
        $map['width'] = strToInt($citiesOptions['map_width']) . 'px';
    }
    if (isset($citiesOptions['map_height']) and !empty($citiesOptions['map_height'])) {
        $map['height'] = strToInt($citiesOptions['map_height']) . 'px';
    }
}
?>

<?php if($map['show']): ?>
	<?php if(!$loc['show']): ?>
		<div class="row">
			<div class="col-xl-12 col-md-12 col-sm-12">
				<h2 class="title-3 no-padding">
					<i class="icon-location-2"></i>&nbsp;<?php echo e(t('Choose a state or region')); ?>

				</h2>
			</div>
		</div>
	<?php endif; ?>
	<div class="<?php echo e($rightClassCol); ?> text-center">
		<div id="countryMap" class="page-sidebar col-thin-left no-padding" style="margin: auto;">&nbsp;</div>
	</div>
<?php endif; ?>

<?php $__env->startSection('after_scripts'); ?>
	##parent-placeholder-3bf5331b3a09ea3f1b5e16018984d82e8dc96b5f##
	<script src="<?php echo e(url('assets/plugins/twism/jquery.twism.js')); ?>"></script>
	<script>
		$(document).ready(function () {
			<?php if($map['show']): ?>
				$('#countryMap').css('cursor', 'pointer');
				$('#countryMap').twism("create",
				{
					map: "custom",
					customMap: '<?php echo e(config('larapen.core.maps.urlBase') . config('country.icode') . '.svg'); ?>',
					backgroundColor: '<?php echo e($map['backgroundColor']); ?>',
					border: '<?php echo e($map['border']); ?>',
					hoverBorder: '<?php echo e($map['hoverBorder']); ?>',
					borderWidth: <?php echo e($map['borderWidth']); ?>,
					color: '<?php echo e($map['color']); ?>',
					width: '<?php echo e($map['width']); ?>',
					height: '<?php echo e($map['height']); ?>',
					click: function(region) {
						if (typeof region == "undefined") {
							return false;
						}
						if (isBlankValue(region)) {
							return false;
						}
						region = rawurlencode(region);
						<?php $attr = ['countryCode' => config('country.icode')]; ?>
						var searchPage = '<?php echo e(lurl(trans('routes.v-search', $attr), $attr)); ?>';
						<?php if(config('settings.seo.multi_countries_urls')): ?>
							searchPage = searchPage + '?d=<?php echo e(config('country.code')); ?>&r=' + region;
						<?php else: ?>
							searchPage = searchPage + '?r=' + region;
						<?php endif; ?>
						redirect(searchPage);
					},
					hover: function(regionId) {
						if (typeof regionId == "undefined") {
							return false;
						}
						var selectedIdObj = document.getElementById(regionId);
						if (typeof selectedIdObj == "undefined") {
							return false;
						}
						selectedIdObj.style.fill = '<?php echo e($map['hover']); ?>';
						return;
					},
					unhover: function(regionId) {
						if (typeof regionId == "undefined") {
							return false;
						}
						var selectedIdObj = document.getElementById(regionId);
						if (typeof selectedIdObj == "undefined") {
							return false;
						}
						selectedIdObj.style.fill = '<?php echo e($map['color']); ?>';
						return;
					}
				});
			<?php endif; ?>
		});
	</script>
<?php $__env->stopSection(); ?>