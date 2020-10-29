<?php if(isset($customFields) and $customFields->count() > 0): ?>
	<form id="cfForm" role="form" class="form" action="<?php echo e($fullUrlNoParams); ?>" method="GET">
		<?php echo csrf_field(); ?>

		<?php
		$clearAll = '';
		$firstFieldFound = false;
		?>
		<?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(in_array($field->type, ['file', 'text', 'textarea'])) continue; ?>
			<?php
			// Fields parameters
			$fieldId = 'cf.' . $field->tid;
			$fieldName = 'cf[' . $field->tid . ']';
			$fieldOld = 'cf.' . $field->tid;
			
			// Get the default value
			$defaulValue = (request()->filled($fieldOld)) ? request()->input($fieldOld) : $field->default;
			
			// Field Query String
			$fieldQueryString = '<input type="hidden" id="cf' . $field->tid . 'QueryString" value="' . httpBuildQuery(request()->except(['page', $fieldId])) . '">';
			
			// Clear All link
			if (request()->filled('cf')) {
				if (!$firstFieldFound) {
					$clearTitle = t('Clear all the :category\'s filters', ['category' => $cat->name]);
					$clearAll = '<a href="' . qsurl($fullUrlNoParams, request()->except(['page', 'cf']), null, false) . '" title="' . $clearTitle . '">
									<span class="small" style="float: right;">' . t('Clear all') . '</span>
								</a>';
					$firstFieldFound = true;
				} else {
					$clearAll = '';
				}
			}
			?>
			
			<?php if($field->type == 'checkbox'): ?>
				
				<!-- checkbox -->
				<div class="block-title has-arrow sidebar-header">
					<h5><strong><a href="#"><?php echo e($field->name); ?></a></strong> <?php echo $clearAll; ?></h5>
				</div>
				<div class="block-content list-filter">
					<div class="filter-content">
						<div class="form-check">
							<input id="<?php echo e($fieldId); ?>"
								   name="<?php echo e($fieldName); ?>"
								   value="1"
								   type="checkbox"
								   class="form-check-input"
									<?php echo e(($defaulValue=='1') ? 'checked="checked"' : ''); ?>

							>
							<label class="form-check-label" for="<?php echo e($fieldId); ?>">
								<?php echo e($field->name); ?>

							</label>
						</div>
					</div>
				</div>
				<?php echo $fieldQueryString; ?>

				<div style="clear:both"></div>
			
			<?php endif; ?>
			<?php if($field->type == 'checkbox_multiple'): ?>
				
				<?php if($field->options->count() > 0): ?>
					<!-- checkbox_multiple -->
					<div class="block-title has-arrow sidebar-header">
						<h5><strong><a href="#"><?php echo e($field->name); ?></a></strong> <?php echo $clearAll; ?></h5>
					</div>
					<div class="block-content list-filter">
						<div class="filter-content">
							<?php $__currentLoopData = $field->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
								// Get the default value
								$defaulValue = (request()->filled($fieldOld . '.' . $option->tid))
									? request()->input($fieldOld . '.' . $option->tid)
									: (
										(is_array($field->default) && isset($field->default[$option->tid]) && isset($field->default[$option->tid]->value))
											? $field->default[$option->tid]->value
											: $field->default
									);
								
								// Field Query String
								$fieldQueryString = '<input type="hidden" id="cf' . $field->tid . $option->tid . 'QueryString"
									value="' . httpBuildQuery(request()->except(['page', $fieldId . '.' . $option->tid])) . '">';
								?>
								<div class="form-check">
									<input id="<?php echo e($fieldId . '.' . $option->tid); ?>"
										   name="<?php echo e($fieldName . '[' . $option->tid . ']'); ?>"
										   value="<?php echo e($option->tid); ?>"
										   type="checkbox"
										   class="form-check-input"
											<?php echo e(($defaulValue==$option->tid) ? 'checked="checked"' : ''); ?>

									>
									<label class="form-check-label" for="<?php echo e($fieldId . '.' . $option->tid); ?>">
										<?php echo e($option->value); ?>

									</label>
								</div>
								<?php echo $fieldQueryString; ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<div style="clear:both"></div>
				<?php endif; ?>
			
			<?php endif; ?>
			<?php if($field->type == 'radio'): ?>
				
				<?php if($field->options->count() > 0): ?>
					<!-- radio -->
					<div class="block-title has-arrow sidebar-header">
						<h5><strong><a href="#"><?php echo e($field->name); ?></a></strong> <?php echo $clearAll; ?></h5>
					</div>
					<div class="block-content list-filter">
						<div class="filter-content">
							<?php $__currentLoopData = $field->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="form-check">
									<input id="<?php echo e($fieldId); ?>"
										   name="<?php echo e($fieldName); ?>"
										   value="<?php echo e($option->tid); ?>"
										   type="radio"
										   class="form-check-input"
											<?php echo e(($defaulValue==$option->tid) ? 'checked="checked"' : ''); ?>

									>
									<label class="form-check-label" for="<?php echo e($fieldId); ?>">
										<?php echo e($option->value); ?>

									</label>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<?php echo $fieldQueryString; ?>

					<div style="clear:both"></div>
				<?php endif; ?>
				
			<?php endif; ?>
			<?php if($field->type == 'select'): ?>
			
				<!-- select -->
				<div class="block-title has-arrow sidebar-header">
					<h5><strong><a href="#"><?php echo e($field->name); ?></a></strong> <?php echo $clearAll; ?></h5>
				</div>
				<div class="block-content list-filter">
					<div class="filter-content">
						<?php
							$select2Type = ($field->options->count() <= 10) ? 'selecter' : 'sselecter';
						?>
						<select id="<?php echo e($fieldId); ?>" name="<?php echo e($fieldName); ?>" class="form-control <?php echo e($select2Type); ?>">
							<option value=""
									<?php if(old($fieldOld)=='' or old($fieldOld)==0): ?>
										selected="selected"
									<?php endif; ?>
							>
								<?php echo e(t('Select')); ?>

							</option>
							<?php if($field->options->count() > 0): ?>
								<?php $__currentLoopData = $field->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($option->tid); ?>"
											<?php if($defaulValue==$option->tid): ?>
												selected="selected"
											<?php endif; ?>
									>
										<?php echo e($option->value); ?>

									</option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</select>
					</div>
				</div>
				<?php echo $fieldQueryString; ?>

				<div style="clear:both"></div>
			
			<?php endif; ?>
			
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</form>
	<div style="clear:both"></div>
<?php endif; ?>

<?php $__env->startSection('after_scripts'); ?>
	##parent-placeholder-3bf5331b3a09ea3f1b5e16018984d82e8dc96b5f##
	<script>
		$(document).ready(function ()
		{
			/* Select */
			$('#cfForm').find('select').change(function() {
				/* Get full field's ID */
				var fullFieldId = $(this).attr('id');
				
				/* Get full field's ID without dots */
				var jsFullFieldId = fullFieldId.split('.').join('');
				
				/* Get real field's ID */
				var tmp = fullFieldId.split('.');
				if (typeof tmp[1] !== 'undefined') {
					var fieldId = tmp[1];
				} else {
					return false;
				}
				
				/* Get saved QueryString */
				var fieldQueryString = $('#' + jsFullFieldId + 'QueryString').val();
				
				/* Add the field's value to the QueryString */
				if (fieldQueryString != '') {
					fieldQueryString = fieldQueryString + '&';
				}
				fieldQueryString = fieldQueryString + 'cf['+fieldId+']=' + $(this).val();
				
				/* Redirect to the new search URL */
				var searchUrl = baseUrl + '?' + fieldQueryString;
				redirect(searchUrl);
			});
			
			/* Radio & Checkbox */
			$('#cfForm').find('input[type=radio], input[type=checkbox]').click(function() {
				/* Get full field's ID */
				var fullFieldId = $(this).attr('id');
				
				/* Get full field's ID without dots */
				var jsFullFieldId = fullFieldId.split('.').join('');
				
				/* Get real field's ID */
				var tmp = fullFieldId.split('.');
				if (typeof tmp[1] !== 'undefined') {
					var fieldId = tmp[1];
					if (typeof tmp[2] !== 'undefined') {
						var fieldOptionId = tmp[2];
					}
				} else {
					return false;
				}
				
				/* Get saved QueryString */
				var fieldQueryString = $('#' + jsFullFieldId + 'QueryString').val();
				
				/* Check if field is checked */
				if ($(this).prop('checked') == true) {
					/* Add the field's value to the QueryString */
					if (fieldQueryString != '') {
						fieldQueryString = fieldQueryString + '&';
					}
					if (typeof fieldOptionId !== 'undefined') {
						fieldQueryString = fieldQueryString + 'cf[' + fieldId + '][' + fieldOptionId + ']=' + rawurlencode($(this).val());
					} else {
						fieldQueryString = fieldQueryString + 'cf[' + fieldId + ']=' + $(this).val();
					}
				}
				
				/* Redirect to the new search URL */
				var searchUrl = baseUrl + '?' + fieldQueryString;
				redirect(searchUrl);
			});
		});
	</script>
<?php $__env->stopSection(); ?>