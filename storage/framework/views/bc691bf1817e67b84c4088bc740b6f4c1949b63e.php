<?php $__env->startSection('header'); ?>
    <section class="content-header">
        <h1>
            <span class="text-capitalize"><?php echo $xPanel->entity_name_plural; ?></span>
            <small><?php echo e(trans('admin::messages.all')); ?> <span><?php echo $xPanel->entity_name_plural; ?></span> <?php echo e(trans('admin::messages.in_the_database')); ?>.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(admin_url()); ?>"><?php echo e(trans('admin::messages.dashboard')); ?></a></li>
            <li><a href="<?php echo e(url($xPanel->route)); ?>" class="text-capitalize"><?php echo $xPanel->entity_name_plural; ?></a></li>
            <li class="active"><?php echo e(trans('admin::messages.list')); ?></li>
        </ol>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content">

    <!-- Default box -->
    <div class="row">

        <!-- THE ACTUAL CONTENT -->
        <div class="col-md-12">
            <div class="box box-primary">
					
				<?php if(isTranlatableModel($xPanel->model)): ?>
					<div class="box-header with-border">
						<div class="callout">
							<h4><i class="fa fa-question-circle"></i> <?php echo e(trans('admin::messages.Help')); ?></h4>
							
							<p><?php echo trans('admin::messages.help_translation_list_entries'); ?></p>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="box-header <?php echo e($xPanel->hasAccess('create')?'with-border':''); ?>">
					<?php echo $__env->make('admin::panel.inc.button_stack', ['stack' => 'top'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<div id="datatable_button_stack" class="pull-right text-right"></div>
				</div>

				<div class="box-body">

					
					<?php if($xPanel->filtersEnabled()): ?>
						<?php echo $__env->make('admin::panel.inc.filters_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
					
					<form id="bulkActionForm" action="<?php echo e(url($xPanel->getRoute() . '/bulk_delete')); ?>" method="POST">
						<?php echo csrf_field(); ?>

						
						<table id="crudTable" class="table table-bordered table-striped display dt-responsive nowrap" width="100%">
							<thead>
							<tr>
								<?php if($xPanel->details_row): ?>
									<th data-orderable="false"></th> <!-- expand/minimize button column -->
								<?php endif; ?>
	
								
								<?php $__currentLoopData = $xPanel->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($column['type'] == 'checkbox'): ?>
									<th <?php echo e(isset($column['orderable']) ? 'data-orderable=' .var_export($column['orderable'], true) : ''); ?>

										class="dt-checkboxes-cell dt-checkboxes-select-all sorting_disabled"
										tabindex="0"
										aria-controls="massSelectAll"
										rowspan="1"
										colspan="1"
										style="width: 14px; text-align: center; padding-right: 10px;"
										data-col="0"
										aria-label=""
									>
										<input type="checkbox" id="massSelectAll" name="massSelectAll">
									</th>
									<?php else: ?>
									<th <?php echo e(isset($column['orderable']) ? 'data-orderable=' .var_export($column['orderable'], true) : ''); ?>>
										<?php echo $column['label']; ?>

									</th>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
								<?php if( $xPanel->buttons->where('stack', 'line')->count() ): ?>
									<th data-orderable="false"><?php echo e(trans('admin::messages.actions')); ?></th>
								<?php endif; ?>
							</tr>
							</thead>
	
							<tbody>
							</tbody>
	
							<tfoot>
							<tr>
								<?php if($xPanel->details_row): ?>
									<th></th> <!-- expand/minimize button column -->
								<?php endif; ?>
	
								
								<?php $__currentLoopData = $xPanel->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<th><?php echo e($column['label']); ?></th>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
								<?php if( $xPanel->buttons->where('stack', 'line')->count() ): ?>
									<th><?php echo e(trans('admin::messages.actions')); ?></th>
								<?php endif; ?>
							</tr>
							</tfoot>
						</table>
						
					</form>

				</div><!-- /.box-body -->

				<?php echo $__env->make('admin::panel.inc.button_stack', ['stack' => 'bottom'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div><!-- /.box -->
        </div>

    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
    <!-- DATA TABLES -->
    <link href="<?php echo e(asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.css')); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo e(asset('vendor/adminlte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    <?php echo $__env->yieldPushContent('crud_list_styles'); ?>
    
    <style>
		<?php if($xPanel->hasButton('bulk_delete_btn')): ?>
		/* tr > td:first-child, */
		table.dataTable > tbody > tr:not(.no-padding) > td:first-child {
			width: 30px;
			white-space: nowrap;
			text-align: center;
        }
		<?php endif; ?>
		
		/* Fix the 'Actions' column size */
		/* tr > td:last-child, */
		table.dataTable > tbody > tr:not(.no-padding) > td:last-child,
		table:not(.dataTable) > tbody > tr > td:last-child {
			width: 10px;
			white-space: nowrap;
		}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <!-- DATA TABLES SCRIPT -->
    <script src="<?php echo e(asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js')); ?>" type="text/javascript"></script>

    <?php if(isset($xPanel->export_buttons) and $xPanel->export_buttons): ?>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" type="text/javascript"></script>
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" type="text/javascript"></script>
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js" type="text/javascript"></script>
    <?php endif; ?>

    <script src="<?php echo e(asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('vendor/adminlte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {

            <?php if($xPanel->export_buttons): ?>
            var dtButtons = function(buttons){
                    var extended = [];
                    for(var i = 0; i < buttons.length; i++){
                        var item = {
                            extend: buttons[i],
                            exportOptions: {
                                columns: [':visible']
                            }
                        };
                        switch(buttons[i]){
                            case 'pdfHtml5':
                                item.orientation = 'landscape';
                                break;
                        }
                        extended.push(item);
                    }
                    return extended;
                }
            <?php endif; ?>

            var table = $("#crudTable").DataTable({
                    "pageLength": <?php echo e($xPanel->getDefaultPageLength()); ?>,
					"lengthMenu": [[10, 25, 50, 100, 250, 500], [10, 25, 50, 100, 250, 500]],
					/* Disable initial sort */
					"aaSorting": [],
                    "language": {
                        "emptyTable":     "<?php echo e(trans('admin::messages.emptyTable')); ?>",
                        "info":           "<?php echo e(trans('admin::messages.info')); ?>",
                        "infoEmpty":      "<?php echo e(trans('admin::messages.infoEmpty')); ?>",
                        "infoFiltered":   "<?php echo e(trans('admin::messages.infoFiltered')); ?>",
                        "infoPostFix":    "<?php echo e(trans('admin::messages.infoPostFix')); ?>",
                        "thousands":      "<?php echo e(trans('admin::messages.thousands')); ?>",
                        "lengthMenu":     "<?php echo e(trans('admin::messages.lengthMenu')); ?>",
                        "loadingRecords": "<?php echo e(trans('admin::messages.loadingRecords')); ?>",
                        "processing":     "<?php echo e(trans('admin::messages.processing')); ?>",
                        "search":         "<?php echo e(trans('admin::messages.search')); ?>",
                        "zeroRecords":    "<?php echo e(trans('admin::messages.zeroRecords')); ?>",
                        "paginate": {
                            "first":      "<?php echo e(trans('admin::messages.paginate.first')); ?>",
                            "last":       "<?php echo e(trans('admin::messages.paginate.last')); ?>",
                            "next":       "<?php echo e(trans('admin::messages.paginate.next')); ?>",
                            "previous":   "<?php echo e(trans('admin::messages.paginate.previous')); ?>"
                        },
                        "aria": {
                            "sortAscending":  "<?php echo e(trans('admin::messages.aria.sortAscending')); ?>",
                            "sortDescending": "<?php echo e(trans('admin::messages.aria.sortDescending')); ?>"
                        }
                    },
					responsive: true,

                    <?php if($xPanel->ajax_table): ?>
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "<?php echo e(url($xPanel->route.'/search').'?'.Request::getQueryString()); ?>",
                        "type": "POST"
                    },
                    <?php endif; ?>
				
					<?php if($xPanel->hasButton('bulk_delete_btn')): ?>
					/* Mass Select All */
					'columnDefs': [{
						'targets': [0],
						'orderable': false
					}],
					<?php endif; ?>

                    <?php if($xPanel->export_buttons): ?>
                    // show the export datatable buttons
                    dom: '<"p-l-0 col-md-6"l>B<"p-r-0 col-md-6"f>rt<"col-md-6 p-l-0"i><"col-md-6 p-r-0"p>',
                    buttons: dtButtons([
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                        'print',
                        'colvis'
                    ]),
                    <?php endif; ?>
                });

            <?php if($xPanel->export_buttons): ?>
            // move the datatable buttons in the top-right corner and make them smaller
            table.buttons().each(function(button) {
                if (button.node.className.indexOf('buttons-columnVisibility') == -1)
                {
                    button.node.className = button.node.className + " btn-sm";
                }
            });
            $(".dt-buttons").appendTo($('#datatable_button_stack' ));
            <?php endif; ?>

            $.ajaxPrefilter(function(options, originalOptions, xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-XSRF-TOKEN', token);
                }
            });

            // make the delete button work in the first result page
            register_delete_button_action();

            // make the delete button work on subsequent result pages
            $('#crudTable').on('draw.dt', function () {
                register_delete_button_action();

                <?php if($xPanel->details_row): ?>
                 register_details_row_button_action();
                <?php endif; ?>
            }).dataTable();

            function register_delete_button_action() {
                $("[data-button-type=delete]").unbind('click');
                // CRUD Delete
                // ask for confirmation before deleting an item
                $("[data-button-type=delete]").click(function(e) {
                    e.preventDefault();
                    var delete_button = $(this);
                    var delete_url = $(this).attr('href');

                    if (confirm("<?php echo e(trans('admin::messages.delete_confirm')); ?>") == true) {
						if (isDemo()) {
							// Delete the row from the table
							delete_button.parentsUntil('tr').parent().remove();
							return false;
						}
						
                        $.ajax({
                            url: delete_url,
                            type: 'DELETE',
                            success: function(result) {
                                // Show an alert with the result
                                new PNotify({
                                    title: "<?php echo e(trans('admin::messages.delete_confirmation_title')); ?>",
                                    text: "<?php echo e(trans('admin::messages.delete_confirmation_message')); ?>",
                                    type: "success"
                                });
                                // Delete the row from the table
                                delete_button.parentsUntil('tr').parent().remove();
                            },
                            error: function(result) {
								/* Show an alert with the result */
								/* console.log(result.responseText); */
								if (typeof result.responseText !== 'undefined') {
									if (result.responseText.indexOf("<?php echo e(trans('admin::messages.unauthorized')); ?>") >= 0) {
										new PNotify({
											title: "<?php echo e(trans('admin::messages.delete_confirmation_not_title')); ?>",
											text: result.responseText,
											type: "error"
										});
										
										return false;
									}
								}
								
								/* Show an alert with the standard message */
								new PNotify({
									title: "<?php echo e(trans('admin::messages.delete_confirmation_not_title')); ?>",
									text: "<?php echo e(trans('admin::messages.delete_confirmation_not_message')); ?>",
									type: "warning"
								});
                            }
                        });
						
                    } else {
                        new PNotify({
                            title: "<?php echo e(trans('admin::messages.delete_confirmation_not_deleted_title')); ?>",
                            text: "<?php echo e(trans('admin::messages.delete_confirmation_not_deleted_message')); ?>",
                            type: "info"
                        });
                    }
                });
            }
	
	
			/* Mass Select All */
			$('body').on('change', '#massSelectAll', function() {
				var rows, checked, colIndex;
				rows = $('#crudTable').find('tbody tr');
				checked = $(this).prop('checked');
				colIndex = <?php echo e((isTranlatableModel($xPanel->model)) ? 1 : 0); ?>;
				$.each(rows, function() {
					var checkbox = $($(this).find('td').eq(colIndex)).find('input').prop('checked', checked);
				});
			});
			
			/* Bulk Items Deletion */
			$('#bulkDeleteBtn').click(function(e) {
				e.preventDefault();
				
				var atLeastOneItemIsSelected = $('input[name="entryId[]"]:checked').length > 0;
				
				if (atLeastOneItemIsSelected) {
					if (confirm("<?php echo e(trans('admin::messages.Are you sure you want to delete the selected items?')); ?>") == true) {
						if (isDemo()) {
							return false;
						}
						$('#bulkActionForm').submit();
					}
				} else {
					new PNotify({
						title: "<?php echo e(trans('admin::messages.delete_confirmation_not_deleted_title')); ?>",
						text: "<?php echo e(trans('admin::messages.Please select at least one item below.')); ?>",
						type: "warning"
					});
				}
				
				return false;
			});


            <?php if($xPanel->details_row): ?>
            function register_details_row_button_action() {
                // Add event listener for opening and closing details
                $('#crudTable tbody').on('click', 'td .details-row-button', function () {
                    var tr = $(this).closest('tr');
                    var btn = $(this);
                    var row = table.row( tr );

                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        $(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
                        $('div.table_row_slider', row.child()).slideUp( function () {
                            row.child.hide();
                            tr.removeClass('shown');
                        } );
                    }
                    else {
                        // Open this row
                        $(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                        // Get the details with ajax
                        $.ajax({
                            url: '<?php echo e(Request::url()); ?>/'+btn.data('entry-id')+'/details',
                            type: 'GET',
                            // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                            // data: {param1: 'value1'},
                        })
                            .done(function(data) {
                                // console.log("-- success getting table extra details row with AJAX");
                                row.child("<div class='table_row_slider'>" + data + "</div>", 'no-padding').show();
                                tr.addClass('shown');
                                $('div.table_row_slider', row.child()).slideDown();
                                register_delete_button_action();
                            })
                            .fail(function(data) {
                                // console.log("-- error getting table extra details row with AJAX");
                                row.child("<div class='table_row_slider'><?php echo e(trans('admin::messages.details_row_loading_error')); ?></div>").show();
                                tr.addClass('shown');
                                $('div.table_row_slider', row.child()).slideDown();
                            })
                            .always(function(data) {
                                // console.log("-- complete getting table extra details row with AJAX");
                            });
                    }
                } );
            }

            register_details_row_button_action();
            <?php endif; ?>

        });
    </script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    <?php echo $__env->yieldPushContent('crud_list_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>