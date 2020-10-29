<?php if(auth()->check()): ?>
	<?php
	// Get plugins admin menu
	$pluginsMenu = '';
	$plugins = plugin_installed_list();
	if (!empty($plugins)) {
	    foreach($plugins as $plugin) {
	        if (method_exists($plugin->class, 'getAdminMenu')) {
            	$pluginsMenu .= call_user_func($plugin->class . '::getAdminMenu');
            }
		}
	}
	?>
    <style>
        #adminSidebar ul li span {
            text-transform: capitalize;
        }
    </style>
	<!-- Left side column. contains the sidebar -->
	<aside class="main-sidebar" id="adminSidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo e(Gravatar::fallback(url('images/user.jpg'))->get(auth()->user()->email)); ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo e(auth()->user()->name); ?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> <?php echo e(trans('admin::messages.Online')); ?></a>
				</div>
			</div>

			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header"><?php echo e(trans('admin::messages.administration')); ?></li>
				<!-- ================================================ -->
				<!-- ==== Recommended place for admin menu items ==== -->
				<!-- ================================================ -->
				<li><a href="<?php echo e(admin_url('dashboard')); ?>"><i class="fa fa-dashboard"></i> <span><?php echo e(trans('admin::messages.dashboard')); ?></span></a></li>
				
				<?php if(
					auth()->user()->can('list-post') ||
					auth()->user()->can('list-category') ||
					auth()->user()->can('list-picture') ||
					auth()->user()->can('list-post-type') ||
					auth()->user()->can('list-field') ||
					userHasSuperAdminPermissions()
				): ?>
				<li class="treeview">
					<a href="#"><i class="fa fa-table"></i><span><?php echo e(trans('admin::messages.ads')); ?></span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<?php if(auth()->user()->can('list-post') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('posts')); ?>"><i class="fa fa-table"></i> <span><?php echo e(trans('admin::messages.list')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-category') || userHasSuperAdminPermissions()): ?>
                        <li><a href="<?php echo e(admin_url('categories')); ?>"><i class="fa fa-folder"></i> <span><?php echo e(trans('admin::messages.categories')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-picture') || userHasSuperAdminPermissions()): ?>
                        <li><a href="<?php echo e(admin_url('pictures')); ?>"><i class="fa fa-picture-o"></i> <span><?php echo e(trans('admin::messages.pictures')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-post-type') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('p_types')); ?>"><i class="fa fa-cog"></i> <span><?php echo e(trans('admin::messages.ad types')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-field') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('custom_fields')); ?>"><i class="fa fa-list-alt"></i> <span><?php echo e(trans('admin::messages.custom fields')); ?></span></a></li>
						<?php endif; ?>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(
					auth()->user()->can('list-user') ||
					auth()->user()->can('list-role') ||
					auth()->user()->can('list-permission') ||
					auth()->user()->can('list-gender') ||
					userHasSuperAdminPermissions()
				): ?>
				<li class="treeview">
					<a href="#"><i class="fa fa-group"></i> <span><?php echo e(trans('admin::messages.users')); ?></span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<?php if(auth()->user()->can('list-user') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('users')); ?>"><i class="fa fa-user"></i> <span><?php echo e(trans('admin::messages.list')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-role') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('roles')); ?>"><i class="fa fa-group"></i> <span><?php echo e(trans('admin::messages.roles')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-permission') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('permissions')); ?>"><i class="fa fa-key"></i> <span><?php echo e(trans('admin::messages.permissions')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-gender') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('genders')); ?>"><i class="fa fa-language"></i> <span><?php echo e(trans('admin::messages.titles')); ?></span></a></li>
						<?php endif; ?>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(auth()->user()->can('list-payment') || userHasSuperAdminPermissions()): ?>
				<li><a href="<?php echo e(admin_url('payments')); ?>"><i class="fa fa-usd"></i> <span><?php echo e(trans('admin::messages.payments')); ?></span></a></li>
				<?php endif; ?>
				<?php if(auth()->user()->can('list-page') || userHasSuperAdminPermissions()): ?>
				<li><a href="<?php echo e(admin_url('pages')); ?>"><i class="fa fa-clone"></i> <span><?php echo e(trans('admin::messages.pages')); ?></span></a></li>
				<?php endif; ?>
				<?php echo $pluginsMenu; ?>

				
				<!-- ======================================= -->
				<?php if(
					auth()->user()->can('list-setting') ||
					auth()->user()->can('list-home-section') ||
					auth()->user()->can('list-language') ||
					auth()->user()->can('list-meta-tag') ||
					auth()->user()->can('list-package') ||
					auth()->user()->can('list-payment-method') ||
					auth()->user()->can('list-advertising') ||
					auth()->user()->can('list-country') ||
					auth()->user()->can('list-currency') ||
					auth()->user()->can('list-time-zone') ||
					auth()->user()->can('list-blacklist') ||
					auth()->user()->can('list-report-type') ||
					userHasSuperAdminPermissions()
				): ?>
				<li class="header"><?php echo e(trans('admin::messages.configuration')); ?></li>
				<li class="treeview">
					<a href="#"><i class="fa fa-cog"></i> <span><?php echo e(trans('admin::messages.setup')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<?php if(auth()->user()->can('list-setting') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('settings')); ?>"><i class="fa fa-cog"></i> <span><?php echo e(trans('admin::messages.general settings')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-home-section') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('homepage')); ?>"><i class="fa fa-home"></i> <span><?php echo e(trans('admin::messages.homepage')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-language') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('languages')); ?>"><i class="fa fa-language"></i> <span><?php echo e(trans('admin::messages.languages')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-meta-tag') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('meta_tags')); ?>"><i class="fa fa-bookmark-o"></i> <span><?php echo e(trans('admin::messages.meta tags')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-package') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('packages')); ?>"><i class="fa fa-pie-chart"></i> <span><?php echo e(trans('admin::messages.packages')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-payment-method') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('payment_methods')); ?>"><i class="fa fa-credit-card"></i> <span><?php echo e(trans('admin::messages.payment methods')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-advertising') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('advertisings')); ?>"><i class="fa fa-life-ring"></i> <span><?php echo e(trans('admin::messages.advertising')); ?></span></a></li>
						<?php endif; ?>
						<?php if(
							auth()->user()->can('list-country') ||
							auth()->user()->can('list-currency') ||
							auth()->user()->can('list-time-zone') ||
							userHasSuperAdminPermissions()
						): ?>
						<li class="treeview">
							<a href="#"><i class="fa fa-globe"></i> <span><?php echo e(trans('admin::messages.international')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
								<?php if(auth()->user()->can('list-country') || userHasSuperAdminPermissions()): ?>
								<li><a href="<?php echo e(admin_url('countries')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(trans('admin::messages.countries')); ?></span></a></li>
								<?php endif; ?>
								<?php if(auth()->user()->can('list-currency') || userHasSuperAdminPermissions()): ?>
								<li><a href="<?php echo e(admin_url('currencies')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(trans('admin::messages.currencies')); ?></span></a></li>
								<?php endif; ?>
								<?php if(auth()->user()->can('list-time-zone') || userHasSuperAdminPermissions()): ?>
								<li><a href="<?php echo e(admin_url('time_zones')); ?>"><i class="fa fa-circle-o"></i> <span><?php echo e(trans('admin::messages.time zones')); ?></span></a></li>
								<?php endif; ?>
							</ul>
						</li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-blacklist') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('blacklists')); ?>"><i class="fa fa-ban"></i> <span><?php echo e(trans('admin::messages.blacklist')); ?></span></a></li>
						<?php endif; ?>
						<?php if(auth()->user()->can('list-report-type') || userHasSuperAdminPermissions()): ?>
						<li><a href="<?php echo e(admin_url('report_types')); ?>"><i class="fa fa-language"></i> <span><?php echo e(trans('admin::messages.report types')); ?></span></a></li>
						<?php endif; ?>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if(auth()->user()->can('list-plugin') || userHasSuperAdminPermissions()): ?>
				<li><a href="<?php echo e(admin_url('plugins')); ?>"><i class="fa fa-cogs"></i> <span><?php echo e(trans('admin::messages.plugins')); ?></span></a></li>
				<?php endif; ?>
				<?php if(auth()->user()->can('clear-cache') || userHasSuperAdminPermissions()): ?>
				<li><a href="<?php echo e(admin_url('actions/clear_cache')); ?>"><i class="fa fa-refresh"></i> <span><?php echo e(trans('admin::messages.clear cache')); ?></span></a></li>
				<?php endif; ?>
				<?php if(auth()->user()->can('list-backup') || userHasSuperAdminPermissions()): ?>
				<li><a href="<?php echo e(admin_url('backups')); ?>"><i class="fa fa-hdd-o"></i> <span><?php echo e(trans('admin::messages.backups')); ?></span></a></li>
				<?php endif; ?>
				
				<?php if(
					auth()->user()->can('maintenance-up') ||
					auth()->user()->can('maintenance-down') ||
					userHasSuperAdminPermissions()
				): ?>
				<?php if(app()->isDownForMaintenance()): ?>
					<?php if(auth()->user()->can('maintenance-up') || userHasSuperAdminPermissions()): ?>
					<li>
						<a href="<?php echo e(admin_url('actions/maintenance_up')); ?>" data-toggle="tooltip" title="<?php echo e(trans('admin::messages.Leave Maintenance Mode')); ?>">
							<i class="fa fa-hdd-o"></i> <span><?php echo e(trans('admin::messages.Live Mode')); ?></span>
						</a>
					</li>
					<?php endif; ?>
				<?php else: ?>
					<?php if(auth()->user()->can('maintenance-down') || userHasSuperAdminPermissions()): ?>
					<li>
						<a href="#" data-toggle="modal" data-target="#maintenanceMode" title="<?php echo e(trans('admin::messages.Put in Maintenance Mode')); ?>">
							<i class="fa fa-hdd-o"></i> <span><?php echo e(trans('admin::messages.Maintenance')); ?></span>
						</a>
					</li>
					<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
			
				<!-- ======================================= -->
				<li class="header"><?php echo e(trans('admin::messages.user_panel')); ?></li>
				<li><a href="<?php echo e(admin_url('account')); ?>"><i class="fa fa-sign-out"></i> <span><?php echo e(trans('admin::messages.my account')); ?></span></a></li>
				<li><a href="<?php echo e(admin_url('logout')); ?>"><i class="fa fa-sign-out"></i> <span><?php echo e(trans('admin::messages.logout')); ?></span></a></li>
			</ul>

		</section>
		<!-- /.sidebar -->
	</aside>
<?php endif; ?>
