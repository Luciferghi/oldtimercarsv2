<?php
if (isset($title)) {
    $title = strip_tags($title);
}
?>
<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <title>
      <?php echo isset($title) ? $title . ' :: ' . config('app.name').' Admin' : config('app.name').' Admin'; ?>

    </title>

    <?php echo $__env->yieldContent('before_styles'); ?>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/admin/pnotify/pnotify.custom.min.css')); ?>">

    <!-- Admin Global CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/admin/style.css') . vTime()); ?>">

    <?php echo $__env->yieldContent('after_styles'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition <?php echo e(config('larapen.admin.skin')); ?> sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo e(url('')); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php echo config('larapen.admin.logo_mini'); ?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
              <strong><?php echo strtoupper(\Illuminate\Support\Str::limit(config('app.name'), 15, '.')); ?></strong>
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo e(trans('admin::messages.toggle_navigation')); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <?php echo $__env->make('admin::inc.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </nav>
      </header>

      <!-- =============================================== -->

      <?php echo $__env->make('admin::inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <?php echo $__env->yieldContent('header'); ?>

        <!-- Main content -->
        <section class="content">

          <?php echo $__env->yieldContent('content'); ?>

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <?php if(config('larapen.admin.show_powered_by')): ?>
            <div class="pull-right hidden-xs">
                <?php if(config('settings.footer.powered_by_info')): ?>
                    <?php echo e(trans('admin::messages.powered_by')); ?> <?php echo config('settings.footer.powered_by_info'); ?>

                <?php else: ?>
					<?php echo e(trans('admin::messages.powered_by')); ?> <a target="_blank" href="http://www.bedigit.com">Bedigit</a>.
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php echo e(trans('admin::messages.Version')); ?> <?php echo e(config('app.version')); ?>

      </footer>
    </div>
    <!-- ./wrapper -->


    <?php echo $__env->yieldContent('before_scripts'); ?>

	<script>
		var siteUrl = '<?php echo url('/'); ?>';
	</script>

    <!-- jQuery 2.2.0 -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo e(asset('vendor/adminlte')); ?>/plugins/jQuery/jquery-2.2.0.min.js"><\/script>')</script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo e(asset('vendor/adminlte')); ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('vendor/adminlte')); ?>/plugins/pace/pace.min.js"></script>
    <script src="<?php echo e(asset('vendor/adminlte')); ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo e(asset('vendor/adminlte')); ?>/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo e(asset('vendor/adminlte')); ?>/dist/js/app.min.js"></script>

    <script src="<?php echo e(asset('vendor/admin/script.js')); ?>"></script>

    <!-- page script -->
    <script type="text/javascript">
        /* To make Pace works on Ajax calls */
        $(document).ajaxStart(function() { Pace.restart(); });
        /* Ajax calls should always have the CSRF token attached to them, otherwise they won't work */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /* Set active state on menu element */
        var current_url = "<?php echo e(url(Route::current()->uri())); ?>";
        $("ul.sidebar-menu li a").each(function() {
            if ($(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')))
            {
                $(this).parents('li').addClass('active');
            }
        });
    </script>
    <script>
        $(document).ready(function()
        {
            /* Send an ajax update request */
            $(document).on('click', '.ajax-request', function(e)
            {
                e.preventDefault(); /* prevents the submit or reload */
                var confirmation = confirm("<?php echo trans('admin::messages.Are you sure you want to perform this action?'); ?>");

                if (confirmation) {
                    saveAjaxRequest(siteUrl, this);
                }
            });
        });

        function saveAjaxRequest(siteUrl, el)
        {
        	if (isDemo()) {
				return false;
			}
			
            var $self = $(this); /* magic here! */

            /* Get database info */
            var _token = $('input[name=_token]').val();
            var dataTable = $(el).data('table');
            var dataField = $(el).data('field');
            var dataId = $(el).data('id');
            var dataLineId = $(el).data('line-id');
            var dataValue = $(el).data('value');

            /* Remove dot (.) from var (referring to the PHP var) */
            dataLineId = dataLineId.split('.').join("");


            $.ajax({
                method: 'POST',
                url: siteUrl + '/<?php echo admin_uri(); ?>/ajax/' + dataTable + '/' + dataField + '',
                context: this,
                data: {
                    'primaryKey': dataId,
                    '_token': _token
                }
            }).done(function(data) {
				/* Check 'status' */
                if (data.status != 1) {
                    return false;
                }

                /* Decoration */
                if (data.table == 'countries' && dataField == 'active')
                {
                    if (!data.resImport) {
						new PNotify({
							text: "<?php echo e(trans('admin::messages.Error - You can\'t install this country.')); ?>",
							type: "error"
						});
						
                        return false;
                    }

                    if (data.isDefaultCountry == 1) {
						new PNotify({
							text: "<?php echo e(trans('admin::messages.You can not disable the default country')); ?>",
							type: "warning"
						});
						
                        return false;
                    }

                    /* Country case */
                    if (data.fieldValue == 1) {
                        $('#' + dataLineId).removeClass('fa fa-toggle-off').addClass('fa fa-toggle-on');
                        $('#install' + dataId).removeClass('btn-default').addClass('btn-success').empty().html('<i class="fa fa-download"></i> <?php echo trans('admin::messages.Installed'); ?>');
                    } else {
                        $('#' + dataLineId).removeClass('fa fa-toggle-on').addClass('fa fa-toggle-off');
                        $('#install' + dataId).removeClass('btn-success').addClass('btn-default').empty().html('<i class="fa fa-download"></i> <?php echo trans('admin::messages.Install'); ?>');
                    }
                }
                else
                {
                    /* All others cases */
                    if (data.fieldValue == 1) {
                        $('#' + dataLineId).removeClass('fa fa-toggle-off').addClass('fa fa-toggle-on').blur();
                    } else {
                        $('#' + dataLineId).removeClass('fa fa-toggle-on').addClass('fa fa-toggle-off').blur();
                    }
                }

                return false;
            }).fail(function(xhr, textStatus, errorThrown) {
                /*
                console.log('FAILURE: ' + textStatus);
                console.log(xhr);
                */
	
				/* Show an alert with the result */
				/* console.log(xhr.responseText); */
				if (typeof xhr.responseText !== 'undefined') {
					if (xhr.responseText.indexOf("<?php echo e(trans('admin::messages.unauthorized')); ?>") >= 0) {
						new PNotify({
							text: xhr.responseText,
							type: "error"
						});
			
						return false;
					}
				}
	
				/* Show an alert with the standard message */
				new PNotify({
					text: xhr.responseText,
					type: "error"
				});

                return false;
            });

            return false;
        }

		function isDemo()
		{
			<?php
				$varJs = isDemo() ? 'var demoMode = true;' : 'var demoMode = false;';
				echo $varJs . "\n";
			?>
			var msg = 'This feature has been turned off in demo mode.';
			
			if (demoMode) {
				new PNotify({title: 'Information', text: msg, type: "info"});
				return true;
			}
	
			return false;
		}
    </script>

    <?php echo $__env->make('admin::inc.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin::inc.maintenance', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<script>
		$(document).ready(function () {
			<?php if(isset($errors) and $errors->any()): ?>
				<?php if($errors->any() and old('maintenanceForm')=='1'): ?>
					$('#maintenanceMode').modal();
				<?php endif; ?>
			<?php endif; ?>
		});
	</script>

    <?php echo $__env->yieldContent('after_scripts'); ?>

</body>
</html>
